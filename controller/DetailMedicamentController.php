<?php

// En-tête 
header('Content-Type: text/html; charset=UTF-8');

require_once __DIR__.'/../model/Liste.php';
require_once __DIR__.'/../config/database.php';

try {
    // Validation radicale de l'ID
    if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
        throw new Exception("ID invalide ou manquant");
    }

    $id = (int)$_GET['id'];
    
    // Connexion DB
    $db = new Database();
    $pdo = $db->getConnection();
    $model = new Liste($pdo);
    
    // Récupération des données
    $medicament = $model->getMedicamentById($id);
    
    if (!$medicament) {
        throw new Exception("Aucun médicament trouvé avec l'ID $id");
    }

    // Affichage de la vue
    include __DIR__.'/../view/detail_medicament.php';
    exit;

} catch (Exception $e) {
    // Page d'erreur minimaliste
    echo "<!DOCTYPE html><html><head><title>Erreur</title></head>";
    echo "<body><h1>Erreur</h1><p>".htmlspecialchars($e->getMessage())."</p>";
    echo "<pre>".print_r($medicament ?? null, true)."</pre>";
    echo "</body></html>";
    exit(1);
}
?>