<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Médicament #<?= $medicament['id'] ?></title>
    <link rel="stylesheet" href="../public/css/detail.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h2>Modifier médicament #<?= htmlspecialchars($medicament['id']) ?></h2>
        </div>
        <div class="card-body">
            <?php if (!empty($_SESSION['error'])): ?>
                <div class="error-message"><?= htmlspecialchars($_SESSION['error']) ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data" class="edit-form">
                <div class="detail-row">
                    <label for="nom" class="detail-label">Nom:</label>
                    <div class="detail-value">
                        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($medicament['nom']) ?>" required>
                    </div>
                </div>

                <div class="detail-row">
                    <label for="description" class="detail-label">Description:</label>
                    <div class="detail-value">
                        <textarea id="description" name="description" rows="4"><?= htmlspecialchars($medicament['description']) ?></textarea>
                    </div>
                </div>

                <div class="detail-row">
                    <label for="prix" class="detail-label">Prix (Ar):</label>
                    <div class="detail-value">
                        <input type="number" id="prix" name="prix" step="0.01" value="<?= htmlspecialchars($medicament['prix']) ?>" required>
                    </div>
                </div>

                <div class="detail-row">
                    <label for="photo" class="detail-label">Photo:</label>
                    <div class="detail-value">
                        <input type="file" id="photoInput" name="photo" accept="image/*" style="display: none;">
                        <?php if (!empty($medicament['photo'])): ?>
                            <div class="current-photo">
                                <img src="/<?= htmlspecialchars($medicament['photo']) ?>" 
                                    alt="Photo actuelle" 
                                    class="medicament-image"
                                    id="currentPhoto">
                                <div class="photo-actions">
                                    <button type="button" class="btn-replace" onclick="document.getElementById('photoInput').click()">
                                        <i class="bi bi-arrow-repeat"></i> Remplacer
                                    </button>
                                    <button type="button" class="btn-remove" id="removePhotoBtn">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </button>
                                    <input type="hidden" name="remove_photo" id="removePhotoFlag" value="0">
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="DetailMedicamentController.php?id=<?= $medicament['id'] ?>" class="btn btn-cancel">
                        <i class="bi bi-x-circle"></i> Annuler
                    </a>
                    <button type="submit" class="btn">
                        <i class="bi bi-check-circle"></i> Enregistrer
                    </button>
                </div>
            </form>
            <script>
                document.getElementById('removePhotoBtn').addEventListener('click', function() {
                    // Mettre le flag de suppression à 1
                    document.getElementById('removePhotoFlag').value = '1';
                    
                    // Cacher l'image actuelle
                    document.getElementById('currentPhoto').style.display = 'none';
                    
                    
                    
                    // Afficher un feedback visuel
                    this.innerHTML = '<i class="bi bi-check-circle"></i> Photo marquée pour suppression';
                    this.classList.add('btn-confirm');
                });
            </script>
        </div>
    </div>
</body>
</html>