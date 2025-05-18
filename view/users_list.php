<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Utilisateurs | Gestion Pharmacie</title>
    
    <!-- Bootstrap & Icônes -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="../public/css/users.css">
</head>
<body>
    <div class="rain" id="rain"></div>

    <div class="main-container">
        <header class="page-header animate__animated animate__fadeIn">
            <h1><i class="bi bi-people-fill"></i> Liste des Utilisateurs</h1>
            <p class="text-muted">Gestion des comptes utilisateurs</p>
        </header>

        <div class="table-responsive">
            <table class="medicament-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom d'utilisateur</th>
                        <th>Rôle</th>
                        <th>Date création</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['id']) ?></td>
                                <td><?= htmlspecialchars($user['username']) ?></td>
                                <td>
                                    <span class="badge bg-<?= $user['role'] === 'admin' ? 'danger' : 'primary' ?>">
                                        <?= htmlspecialchars($user['role']) ?>
                                    </span>
                                </td>
                                <td><?= date('d/m/Y H:i', strtotime($user['created_at'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="empty-message">Aucun utilisateur enregistré</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="action-buttons">
            <form action="../view/index.php" method="post">
                <button class="btn-neon">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </button>
            </form>
        </div>

    </div>

    <!-- JS Bootstrap + jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            // Pluie
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

            // Animation lignes tableau
            $('.medicament-table tbody tr').each(function(index) {
                $(this).delay(100 * index).fadeIn(300);
            });
        });
    </script>
</body>
</html>
