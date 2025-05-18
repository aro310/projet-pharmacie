<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | Gestion Pharmacie</title>
    
    <!-- Framework Bootstrap 5 (CSS + Icônes) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="../public/css/login.css">
</head>
<body>
    <!-- Effet de pluie -->
    <div class="rain" id="rain"></div>

    <div class="container">
        <div class="login-container">
            <div class="login-box animate__animated animate__fadeIn">
                <!-- En-tête avec logo thématique -->
                <div class="logo">
                    <i class="bi bi-capsule-pill"></i>
                    <h2>Gestion Pharmacie</h2>
                    <p class="text-muted">Connectez-vous à votre espace</p>
                </div>
                
                <!-- Affichage des erreurs -->
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        Identifiants incorrects
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <!-- Formulaire de connexion -->
                <form action="../controller/AuthController.php" method="post">
                    <div class="form-group">
                        <input type="text" 
                               class="form-control" 
                               id="username" 
                               name="username" 
                               required
                               placeholder="Nom d'utilisateur">
                        <i class="bi bi-person-fill input-icon"></i>
                    </div>
                    
                    <div class="form-group">
                        <input type="password" 
                               class="form-control" 
                               id="password" 
                               name="password" 
                               required
                               placeholder="Mot de passe">
                        <i class="bi bi-lock-fill input-icon"></i>
                    </div>
                    
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-pharma">
                            <i class="bi bi-box-arrow-in-right"></i> Connexion
                        </button>
                    </div>
                </form>
                <div class="register-link mt-4 text-center">
                    <p class="text-muted mb-2">Pas encore de compte?</p>
                    <a href="register.php" class="btn btn-outline-pharma">
                        <i class="bi bi-person-plus"></i> S'inscrire
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Framework jQuery (pour animations et interactions) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Framework Bootstrap 5 JS (pour composants interactifs) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Création des gouttes de pluie
            function createRain() {
                const rainContainer = $('#rain');
                const dropCount = 100;
                
                for (let i = 0; i < dropCount; i++) {
                    const drop = $('<div class="drop"></div>');
                    drop.css({
                        left: Math.random() * 100 + 'vw',
                        animationDuration: (Math.random() * 1 + 0.5) + 's',
                        animationDelay: (Math.random() * 2) + 's',
                        height: (Math.random() * 20 + 10) + 'px',
                        opacity: Math.random() * 0.4 + 0.2
                    });
                    rainContainer.append(drop);
                }
            }
            
            createRain();
            
            // Animation d'entrée
            $('.login-box').hide().fadeIn(800);
            
            // Focus automatique sur le champ username
            $('#username').focus();
            
            // Validation basique côté client
            $('form').submit(function() {
                if ($('#username').val().trim() === '' || $('#password').val().trim() === '') {
                    alert('Veuillez remplir tous les champs');
                    return false;
                }
                return true;
            });
            
            // Effet de survol sur le bouton
            $('.btn-pharma').hover(
                function() {
                    $(this).css('transform', 'translateY(-3px)');
                },
                function() {
                    $(this).css('transform', 'translateY(0)');
                }
            );
        });
    </script>
</body>
</html>