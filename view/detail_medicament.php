<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Médicament #<?= $medicament['id'] ?></title>
    <style>
        :root {
            --pharma-blue: #3399ff;
            --pharma-green: #00ff99;
            --pharma-purple: #9966cc;
            --bg-dark: #0a0a1a;
            --text-light: #ffffff;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(ellipse at bottom, var(--bg-dark) 0%, #000000 100%);
            color: var(--text-light);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }
        
        .card {
            max-width: 800px;
            margin: 20px auto;
            background-color: rgba(10, 10, 26, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(51, 153, 255, 0.2);
            overflow: hidden;
            border: 1px solid var(--pharma-purple);
        }
        
        .card-header {
            background-color: rgba(0, 255, 153, 0.1);
            padding: 20px;
            border-bottom: 1px solid var(--pharma-purple);
        }
        
        .card-header h2 {
            color: var(--pharma-green);
            margin: 0;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .detail-row {
            display: flex;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px dashed rgba(153, 102, 204, 0.3);
        }
        
        .detail-label {
            flex: 1;
            font-weight: bold;
            color: var(--pharma-green);
        }
        
        .detail-value {
            flex: 3;
        }
        
        .medicament-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-top: 10px;
            border: 1px solid var(--pharma-blue);
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: linear-gradient(135deg, var(--pharma-green), var(--pharma-blue));
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            transition: all 0.3s;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 255, 153, 0.3);
        }
        
        .price-tag {
            font-size: 24px;
            color: var(--pharma-green);
            font-weight: bold;
        }
    </style>
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