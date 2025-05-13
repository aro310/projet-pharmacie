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
    <link rel="stylesheet" href="../public/css/addmedoc.css">
</head>
<body>
    <div class="rain" id="rain"></div>

    <div class="form-container">
        <h1>Ajouter un Nouveau Médicament</h1>
        
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="error"><?= htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form method="POST" action="../controller/AddMedicamentController.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nom">Nom du médicament:</label>
                <input type="text" id="nom" name="nom" required value="<?= htmlspecialchars($_POST['nom'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
            </div>
            
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4"><?= htmlspecialchars($_POST['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="prix">Prix (en €):</label>
                <input type="number" id="prix" name="prix" min="0" step="0.01" required value="<?= htmlspecialchars($_POST['prix'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
            </div>
            
            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" id="photo" name="photo" class="custom-file-input" accept="image/*" >
                <small>Formats acceptés: JPG, PNG, GIF (max 2MB)</small>
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