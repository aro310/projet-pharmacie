<?php
session_start();
/*if (isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}*/
?>
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
            overflow: hidden;
            position: relative;
        }

        /* Effet de pluie */
        .rain {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
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
        .login-container {
            position: relative;
            z-index: 1;
            max-width: 400px;
            margin: 5rem auto;
            animation: fadeIn 1s ease-out;
        }

        /* Boîte de connexion */
        .login-box {
            background: rgba(10, 10, 30, 0.8);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(51, 153, 255, 0.3),
                        0 0 50px rgba(0, 255, 153, 0.2);
            border: 1px solid rgba(51, 153, 255, 0.3);
            backdrop-filter: blur(10px);
            transition: all var(--transition-speed) ease;
        }

        .login-box:hover {
            box-shadow: 0 0 30px rgba(51, 153, 255, 0.5),
                        0 0 60px rgba(0, 255, 153, 0.3);
        }

        /* Logo */
        .logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo i {
            font-size: 3rem;
            color: var(--pharma-green);
            text-shadow: 0 0 15px var(--pharma-green);
            margin-bottom: 1rem;
            display: inline-block;
            animation: pulse 2s infinite alternate;
        }

        @keyframes pulse {
            from { transform: scale(1); }
            to { transform: scale(1.1); }
        }

        .logo h2 {
            color: var(--text-light);
            font-weight: 600;
            margin-bottom: 0.5rem;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        .logo p {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* Champs de formulaire */
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: var(--text-light);
            padding: 12px 15px;
            border-radius: 8px;
            transition: all var(--transition-speed) ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--pharma-blue);
            box-shadow: 0 0 0 0.25rem rgba(51, 153, 255, 0.25);
            color: var(--text-light);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        /* Bouton de connexion */
        .btn-pharma {
            background: linear-gradient(135deg, var(--pharma-blue), var(--pharma-green));
            border: none;
            color: var(--bg-dark);
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            transition: all var(--transition-speed) ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(51, 153, 255, 0.5);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-pharma:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 25px rgba(0, 255, 153, 0.6);
        }

        .btn-pharma::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to bottom right,
                rgba(255, 255, 255, 0.3),
                rgba(255, 255, 255, 0)
            );
            transform: rotate(30deg);
            transition: all 0.5s ease;
        }

        .btn-pharma:hover::after {
            left: 100%;
        }

        /* Alertes */
        .alert {
            border-radius: 8px;
            background: rgba(255, 0, 0, 0.2);
            border: 1px solid rgba(255, 0, 0, 0.3);
            color: var(--text-light);
            backdrop-filter: blur(5px);
        }

        /* Responsive */
        @media (max-width: 576px) {
            .login-container {
                margin: 2rem auto;
                padding: 0 15px;
            }
            
            .login-box {
                padding: 1.5rem;
            }
        }
    </style>
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