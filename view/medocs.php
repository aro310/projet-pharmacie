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
    
    <style>
        :root {
            --pharma-blue: #3399ff;
            --pharma-green: #00ff99;
            --pharma-purple: #9966cc;
            --bg-dark: #0a0a1a;
            --text-light: #ffffff;
            --text-muted: rgba(255, 255, 255, 0.7);
            --transition-speed: 0.4s;
        }
        
        body {
            min-height: 100vh;
            background: radial-gradient(ellipse at bottom, var(--bg-dark) 0%, #000000 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-light);
            overflow-x: hidden;
            position: relative;
            padding-bottom: 2rem;
        }

        /* Effet de pluie */
        .rain {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .drop {
            position: absolute;
            width: 1px;
            height: 30px;
            background: linear-gradient(to bottom, transparent, var(--pharma-blue));
            animation: rain linear infinite;
            opacity: 0.6;
        }

        @keyframes rain {
            to {
                transform: translateY(100vh);
            }
        }

        /* Conteneur principal */
        .main-container {
            position: relative;
            z-index: 1;
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 20px;
            animation: fadeIn 1s ease-out;
        }

        /* En-tête */
        .page-header {
            text-align: center;
            margin-bottom: 2.5rem;
            padding: 1.5rem;
            background: rgba(10, 10, 30, 0.6);
            border-radius: 15px;
            border: 1px solid rgba(51, 153, 255, 0.3);
            box-shadow: 0 0 20px rgba(51, 153, 255, 0.2);
            backdrop-filter: blur(5px);
        }

        .page-header h1 {
            color: var(--pharma-green);
            font-weight: 600;
            text-shadow: 0 0 10px rgba(0, 255, 153, 0.5);
            margin-bottom: 0.5rem;
        }

        /* Tableau stylisé */
        .medicament-table {
            width: 100%;
            background: rgba(10, 10, 30, 0.8);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 0 25px rgba(51, 153, 255, 0.3);
            border: 1px solid rgba(51, 153, 255, 0.3);
            backdrop-filter: blur(10px);
            margin-bottom: 2rem;
        }

        .medicament-table thead {
            background: linear-gradient(135deg, rgba(51, 153, 255, 0.3), rgba(0, 255, 153, 0.2));
            border-bottom: 2px solid var(--pharma-blue);
        }

        .medicament-table th {
            color: var(--pharma-green);
            font-weight: 600;
            padding: 1.2rem 1.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-align: left;
        }

        .medicament-table td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(51, 153, 255, 0.1);
            color: var(--text-light);
            vertical-align: middle;
        }

        .medicament-table tbody tr {
            transition: all var(--transition-speed) ease;
        }

        .medicament-table tbody tr:hover {
            background: rgba(51, 153, 255, 0.1);
            transform: translateX(5px);
        }

        .medicament-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Message d'erreur */
        .error-message {
            background: rgba(255, 0, 0, 0.2);
            border: 1px solid rgba(255, 0, 0, 0.3);
            color: var(--text-light);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            backdrop-filter: blur(5px);
            animation: fadeIn 0.5s ease-out;
        }

        /* Message vide */
        .empty-message {
            text-align: center;
            color: var(--text-muted);
            padding: 2rem;
            font-style: italic;
        }

        /* Boutons d'action */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-neon {
            background: linear-gradient(135deg, var(--pharma-blue), var(--pharma-purple));
            border: none;
            color: var(--bg-dark);
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            transition: all var(--transition-speed) ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(51, 153, 255, 0.5);
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-neon:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 25px rgba(102, 51, 204, 0.6);
            color: var(--text-light);
        }

        .btn-neon i {
            font-size: 1.1rem;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .medicament-table {
                display: block;
                overflow-x: auto;
            }
            
            .page-header {
                padding: 1rem;
            }
            
            .page-header h1 {
                font-size: 1.8rem;
            }
        }
    </style>
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
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Actions</th>
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
                                <td><?php echo htmlspecialchars($medicament['id'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($medicament['nom'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($medicament['description'] ?? ''); ?></td>
                                <td>
                                <form action="DetailMedicamentController.php" method="get">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($medicament['id']) ?>">
                                    <button type="submit" class="btn-neon btn-sm">
                                        <i class="bi bi-pencil-square"></i> Détail
                                    </button>
                                </form>
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