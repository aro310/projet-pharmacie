<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Médicament #<?= $medicament['id'] ?></title>
    <link rel="stylesheet" href="../public/css/detail.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
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
                    <span class="price-tag"><?= number_format($medicament['prix'], 2) ?> Ar</span>
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
            
            <div class="action-buttons">
                <a href="ListesController.php" class="btn">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
                <a href="EditMedicamentController.php?id=<?= $medicament['id'] ?>" class="btn btn-edit">
                    <i class="bi bi-pencil-square"></i> Modifier
                </a>
            </div>
        </div>
    </div>
</body>
</html>