<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Erreur</title>
    <link href="../public/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-danger">
            <h2>Une erreur est survenue</h2>
            <p><?= htmlspecialchars($errorMessage ?? 'Erreur inconnue') ?></p>
            <a href="ListesController.php" class="btn btn-primary">Retour à la liste</a>
        </div>
    </div>
</body>
</html>