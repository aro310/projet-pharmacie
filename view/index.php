<?php
session_start();
/*if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}*/
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord - Pharmacie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <!-- Effet de pluie néon -->
    <div class="raindrops" id="raindrops"></div>

    <!-- Sidebar toggle button -->
    <button class="sidebar-toggle animate__animated animate__fadeIn" id="sidebarToggle">
        <i class="bi bi-list"></i>
    </button>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block sidebar animate__animated animate__fadeInLeft">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="http://localhost/Pharmacie/controller/ListesController.php" data-bs-toggle="collapse">
                                <i class="bi bi-speedometer2"></i> Tableau de bord
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/Pharmacie/controller/ListesController.php" id="showMedicaments">
                                <i class="bi bi-capsule"></i> Médicaments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-people"></i> Clients
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="login.php" method="post">
                                <button type="submit" class="nav-link btn btn-link">
                                    <i class="bi bi-box-arrow-right"></i> Déconnexion
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 animate__animated animate__fadeIn">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom border-neon">
                    <h1 class="h2">Gestion de pharmacie</h1>
                </div>

                <!-- Section recherche moderne -->
                <div class="search-container">
                    <div class="search-header">
                        <h2><i class="bi bi-search-heart"></i> Recherche de médicaments</h2>
                        <p class="text-muted">Trouvez vos médicaments en quelques lettres</p>
                    </div>
                    
                    <div class="position-relative">
                        <input type="text" 
                               id="searchDashboard" 
                               class="form-control" 
                               placeholder="Exemple: Doliprane, Aspirine..." 
                               aria-label="Rechercher un médicament">
                        <div id="medicamentsList" class="list-group"></div>
                    </div>
                </div>


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function() {
        // Créer des gouttes de pluie néon
        const raindropsContainer = document.getElementById('raindrops');
        for (let i = 0; i < 50; i++) {
            const raindrop = document.createElement('div');
            raindrop.classList.add('raindrop');
            raindrop.style.left = Math.random() * 100 + 'vw';
            raindrop.style.animationDuration = (Math.random() * 1 + 0.5) + 's';
            raindrop.style.animationDelay = (Math.random() * 2) + 's';
            raindrop.style.opacity = Math.random() * 0.4 + 0.2;
            raindrop.style.height = (Math.random() * 20 + 10) + 'px';
            raindropsContainer.appendChild(raindrop);
        }

        // Gestion du sidebar
        const sidebar = $('.sidebar');
        const sidebarToggle = $('#sidebarToggle');
        const mainContent = $('main');
        
        // Au clic sur le bouton hamburger
        sidebarToggle.click(function(e) {
            e.stopPropagation(); // Empêche la propagation du clic
            toggleSidebar();
        });
        
        // Fonction pour basculer le sidebar
        function toggleSidebar() {
            sidebar.toggleClass('show');
            mainContent.toggleClass('collapsed');
            sidebarToggle.find('i').toggleClass('bi-list bi-x');
            
            // Animation du bouton
            if (sidebar.hasClass('show')) {
                sidebarToggle.css('left', 'calc(var(--sidebar-width) + 20px)');
            } else {
                sidebarToggle.css('left', '20px');
            }
        }
        
        // Fermer le sidebar si on clique à l'extérieur (sur mobile)
        $(document).click(function(e) {
            if ($(window).width() <= 768) {
                if (!$(e.target).closest('.sidebar').length && 
                    !$(e.target).is('#sidebarToggle') && 
                    sidebar.hasClass('show')) {
                    toggleSidebar();
                }
            }
        });

        // Empêcher la fermeture quand on clique dans le sidebar
        $('.sidebar').click(function(e) {
            e.stopPropagation();
        });

        // Set animation delays for list items
        function setAnimationOrder() {
            $('.list-group-item').each(function(index) {
                $(this).css('--animation-order', index);
            });
        }

        // Toggle active links
        $('.sidebar .nav-link[data-bs-toggle="collapse"]').click(function(e) {
            e.preventDefault();
            $(this).toggleClass('collapsed');
        });

        // Rechercher un médicament
        $('#searchDashboard').on('input', function() {
            const terme = $(this).val().trim();
            if (terme.length > 0) {
                $.get('../controller/MedicamentController.php', { search: terme }, function(data) {
                    $('#medicamentsList').empty();
                    if (data.length > 0) {
                        data.forEach(med => {
                            $('#medicamentsList').append(`
                                <div class="clickable-item list-group-item">
                                    <div class="med-name">${med.nom}</div>
                                    <div class="med-desc">${med.description || 'Aucune description'}</div>
                                    <div class="small text-muted mt-1">
                                        Prix: ${med.prix} € - Stock: ${med.stock}
                                    </div>
                                </div>
                            `);
                        });
                        setAnimationOrder();
                    } else {
                        $('#medicamentsList').html('<div class="no-results">Aucun médicament trouvé</div>');
                    }
                }, 'json');
            } else {
                $('#medicamentsList').empty();
            }
        });

        // Enregistrer
        $('#saveMedicament').click(function() {
            const formData = $('#medicamentForm').serialize();
            $.post('../controller/MedicamentController.php', formData, function(response) {
                if (response.success) {
                    $('#medicamentModal').modal('hide');
                    // Show success animation
                    $('.search-container').addClass('animate__animated animate__tada');
                    setTimeout(() => {
                        $('.search-container').removeClass('animate__animated animate__tada');
                    }, 1000);
                    $('#searchDashboard').trigger('input'); // Recharge les résultats
                }
            }, 'json');
        });
    });
    </script>
</body>
</html>

