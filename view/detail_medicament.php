<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Médicament #<?= $medicament['id'] ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .card { border: 1px solid #ddd; border-radius: 5px; max-width: 600px; margin: 0 auto; }
        .card-header { background: #f5f5f5; padding: 15px; border-bottom: 1px solid #ddd; }
        .card-body { padding: 20px; }
        .row { display: flex; margin-bottom: 10px; }
        .col { flex: 1; padding: 5px; }
        .btn { display: inline-block; padding: 8px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h2>Détails du médicament #<?= htmlspecialchars($medicament['id']) ?></h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col"><strong>Nom:</strong></div>
                <div class="col"><?= htmlspecialchars($medicament['nom']) ?></div>
            </div>
            <div class="row">
                <div class="col"><strong>Description:</strong></div>
                <div class="col"><?= htmlspecialchars($medicament['description']) ?></div>
            </div>
            <div style="margin-top: 20px;">
                <a href="ListesController.php" class="btn">Retour à la liste</a>
            </div>
        </div>
    </div>
</body>
</html>