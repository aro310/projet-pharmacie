<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Médicament #<?= $medicament['id'] ?></title>
    <link rel="stylesheet" href="../public/css/detail.css">
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h2>Détails du médicament #<?= htmlspecialchars($medicament['id']) ?></h2>
        </div>
        <div class="card-body">
            <div class="detail-row">
                <div class="detail-label">Nom:</div>
                <div class="detail-value"><?= htmlspecialchars($medicament['nom']) ?></div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Description:</div>
                <div class="detail-value"><?= htmlspecialchars($medicament['description']) ?></div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Prix:</div>
                <div class="detail-value">
                    <span class="price-tag"><?= number_format($medicament['prix'], 2) ?> €</span>
                </div>
            </div>
            
            <?php if (!empty($medicament['photo'])): ?>
                <div class="detail-row">
                    <div class="detail-label">Photo:</div>
                    <div class="detail-value">
                        <img src="/<?= htmlspecialchars($medicament['photo']) ?>" alt="<?= htmlspecialchars($medicament['nom']) ?>" class="medicament-image" style="max-width: 300px;">
                    </div>
                </div>
            <?php endif; ?>
            
            <div style="text-align: center;">
                <a href="ListesController.php" class="btn">Retour à la liste</a>
            </div>
        </div>
    </div>
</body>
</html>