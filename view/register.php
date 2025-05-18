<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | Gestion Pharmacie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="../public/css/login.css">
</head>
<body>
    <div class="rain" id="rain"></div>

    <div class="container">
        <div class="login-container">
            <div class="login-box animate__animated animate__fadeIn">
                <div class="logo">
                    <i class="bi bi-capsule-pill"></i>
                    <h2>Créer un compte</h2>
                    <p class="text-muted">Rejoignez notre système de gestion</p>
                </div>
                
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <?= htmlspecialchars($_GET['error']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <form action="../controller/RegisterController.php" method="post">
                    <div class="form-group">
                        <input type="text" 
                               class="form-control" 
                               name="username" 
                               required
                               placeholder="Nom d'utilisateur">
                        <i class="bi bi-person-fill input-icon"></i>
                    </div>
                    
                    <div class="form-group">
                        <input type="password" 
                               class="form-control" 
                               name="password" 
                               required
                               placeholder="Mot de passe">
                        <i class="bi bi-lock-fill input-icon"></i>
                    </div>
                    
                    <div class="form-group">
                        <input type="password" 
                               class="form-control" 
                               name="confirm_password" 
                               required
                               placeholder="Confirmez le mot de passe">
                        <i class="bi bi-lock-fill input-icon"></i>
                    </div>
                    
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-pharma">
                            <i class="bi bi-person-plus"></i> S'inscrire
                        </button>
                    </div>
                </form>
                
                <div class="login-link mt-4 text-center">
                    <p class="text-muted mb-2">Déjà un compte?</p>
                    <a href="login.php" class="btn btn-outline-pharma">
                        <i class="bi bi-box-arrow-in-right"></i> Se connecter
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Création des gouttes de pluie (même script que login.php)
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
        });
    </script>
</body>
</html>