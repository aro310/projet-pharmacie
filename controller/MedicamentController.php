<?php
require_once "../config/database.php";
require_once "../model/Medicament.php";

// Très important : pas de "echo" avant le JSON
header('Content-Type: application/json'); // Optionnel mais recommandé

if (isset($_GET['search'])) {
    $database = new Database();
    $db = $database->getConnection();

    $med = new Medicament($db);
    $resultats = $med->rechercher($_GET['search']);

    echo json_encode($resultats);
    // ⚠️ Ne rien écrire ici après echo json_encode()
}

