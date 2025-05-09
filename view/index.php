<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de médicaments | Pharmacie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #0d6efd;
            --hover-color: #e9f0fd;
        }
        
        body {
            background-color: #f8f9fa;
        }
        
        .search-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .search-header {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        #search {
            padding: 12px 20px;
            border-radius: 50px;
            border: 2px solid #dee2e6;
            transition: all 0.3s;
        }
        
        #search:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        
        #resultats {
            max-height: 300px;
            overflow-y: auto;
            margin-top: 0.5rem;
            border-radius: 8px;
        }
        
        .clickable-item {
            cursor: pointer;
            transition: all 0.2s;
            padding: 12px 20px;
            border-left: 3px solid transparent;
        }
        
        .clickable-item:hover {
            background-color: var(--hover-color);
            border-left-color: var(--primary-color);
        }
        
        .med-name {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .med-desc {
            font-size: 0.9rem;
            color: #6c757d;
        }
        
        .no-results {
            color: #6c757d;
            text-align: center;
            padding: 1rem;
        }
        
        /* Scrollbar personnalisée */
        #resultats::-webkit-scrollbar {
            width: 8px;
        }
        
        #resultats::-webkit-scrollbar-thumb {
            background-color: #ced4da;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="search-container">
        <div class="search-header">
            <h2><i class="bi bi-search-heart"></i> Recherche de médicaments</h2>
            <p class="text-muted">Trouvez vos médicaments en quelques lettres</p>
        </div>
        
        <div class="position-relative">
            <input type="text" 
                   id="search" 
                   class="form-control" 
                   placeholder="Exemple: Doliprane, Aspirine..." 
                   aria-label="Rechercher un médicament">
            <div id="resultats" class="list-group"></div>
        </div>
    </div>

    <!-- Chargement des scripts en bas de page -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/script.js"></script>
</body>
</html>

