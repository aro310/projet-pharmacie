<?php
// Début du fichier - absolument RIEN avant cette ligne
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Médicament | PharmaSystem</title>
    <style>
        :root {
            --pharma-blue: #3399ff;
            --pharma-green: #00ff99;
            --pharma-purple: #9966cc;
            --bg-dark: #0a0a1a;
            --text-light: #ffffff;
            --text-muted: rgba(255, 255, 255, 0.7);
            --transition-speed: 0.4s;
            --error-color: #ff4d4d;
            --success-color: #4CAF50;
        }
        
        body {
            min-height: 100vh;
            background: radial-gradient(ellipse at bottom, var(--bg-dark) 0%, #000000 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-light);
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow-x: hidden;
        }
        
        .rain {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
        }
        
        .drop {
            position: absolute;
            width: 1px;
            background: linear-gradient(to bottom, transparent, var(--pharma-blue));
            animation: rain linear infinite;
        }

        @keyframes rain {
            to {
                transform: translateY(100vh);
            }
        }
        
        .form-container {
            max-width: 500px;
            width: 100%;
            margin: 20px;
            padding: 30px;
            background-color: rgba(10, 10, 26, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(51, 153, 255, 0.2);
            position: relative;
            z-index: 1;
            backdrop-filter: blur(5px);
            border: 1px solid var(--pharma-purple);
        }
        
        .form-container h1 {
            color: var(--pharma-green);
            text-align: center;
            margin-bottom: 25px;
            font-size: 28px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: var(--pharma-green);
            font-weight: 500;
        }
        
        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--pharma-purple);
            border-radius: 5px;
            background-color: rgba(0, 0, 0, 0.5);
            color: var(--text-light);
            font-size: 16px;
            transition: all var(--transition-speed);
        }
        
        input:focus, textarea:focus {
            outline: none;
            border-color: var(--pharma-blue);
            box-shadow: 0 0 0 2px rgba(51, 153, 255, 0.3);
        }
        
        textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        button {
            width: 100%;
            background: linear-gradient(135deg, var(--pharma-green), var(--pharma-blue));
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all var(--transition-speed);
            margin-top: 10px;
        }
        
        button:hover {
            background: linear-gradient(135deg, var(--pharma-blue), var(--pharma-green));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 255, 153, 0.3);
        }
        
        .error {
            color: var(--error-color);
            margin: 15px 0;
            padding: 10px;
            background-color: rgba(255, 77, 77, 0.1);
            border-left: 3px solid var(--error-color);
            border-radius: 0 3px 3px 0;
        }
        
        @media (max-width: 600px) {
            .form-container {
                padding: 20px;
            }
            
            .form-container h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="rain" id="rain"></div>

    <div class="form-container">
        <h1>Ajouter un Nouveau Médicament</h1>
        
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="error"><?= htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form method="POST" action="../controller/AddMedicamentController.php">
            <div class="form-group">
                <label for="nom">Nom du médicament:</label>
                <input type="text" id="nom" name="nom" required value="<?= htmlspecialchars($_POST['nom'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
            </div>
            
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4"><?= htmlspecialchars($_POST['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>
            
            <button type="submit">Ajouter le médicament</button>
        </form>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Création des gouttes de pluie
            function createRain() {
                const rainContainer = document.getElementById('rain');
                const dropCount = 100;
                
                for (let i = 0; i < dropCount; i++) {
                    const drop = document.createElement('div');
                    drop.className = 'drop';
                    
                    drop.style.left = Math.random() * 100 + 'vw';
                    drop.style.animationDuration = (Math.random() * 1 + 0.5) + 's';
                    drop.style.animationDelay = (Math.random() * 2) + 's';
                    drop.style.height = (Math.random() * 20 + 10) + 'px';
                    drop.style.opacity = Math.random() * 0.4 + 0.2;
                    
                    rainContainer.appendChild(drop);
                }
            }
            
            createRain();
        });
    </script>
</body>
</html>