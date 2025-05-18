<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Médicaments | Gestion Pharmacie</title>
    
    <!-- Framework Bootstrap 5 (CSS + Icônes) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="../public/css/medocs.css">
</head>
<body>
    <!-- Effet de pluie -->
    <div class="rain" id="rain"></div>

    <div class="main-container">
        <header class="page-header animate__animated animate__fadeIn">
            <h1><i class="bi bi-capsule-pill"></i> Liste des Médicaments</h1>
            <p class="text-muted">Gestion complète du stock pharmaceutique</p>
        </header>
        
        <?php if(isset($error_message)): ?>
            <div class="error-message">
                <i class="bi bi-exclamation-triangle-fill"></i> <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
        
        <div class="table-responsive">
            <table class="medicament-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th >Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if (!isset($medicaments)) {
                        header("Location: ../controller/ListesController.php");
                        exit;
                    }
                 ?>
                    <?php if(!empty($medicaments)): ?>
                        <?php foreach ($medicaments as $medicament): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($medicament['nom'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($medicament['prix'] ?? ''); ?>&nbsp;Ar</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <form action="DetailMedicamentController.php" method="get" class="me-2">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($medicament['id']) ?>">
                                            <button type="submit" class="btn-neon btn-sm">
                                                <i class="bi bi-pencil-square"></i> Détail
                                            </button>
                                        </form>
                                        
                                        <form action="../controller/DeleteMedicamentController.php" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce médicament?');">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($medicament['id']) ?>">
                                            <button type="submit" class="btn-neon btn-sm">
                                                <i class="bi bi-trash"></i> Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="empty-message">Aucun médicament disponible</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="action-buttons">
            <form action="../view/add_medicament.php" method="post">
                <button class="btn-neon">
                    <i class="bi bi-plus-circle"></i> Ajouter un médicament
                </button>
            </form>
            <form action="../view/index.php" method="post">
                <button class="btn-neon">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </button>
            </form>
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
                const dropCount = 150;
                
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
            
            // Animation des lignes du tableau
            $('.medicament-table tbody tr').each(function(index) {
                $(this).delay(100 * index).fadeIn(300);
            });
            
            // Effet de survol sur les boutons
            $('.btn-neon').hover(
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