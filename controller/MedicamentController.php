<?php
require_once "../config/database.php";
require_once "../model/Medicament.php";

header('Content-Type: application/json'); 

if (isset($_GET['search'])) {
    $database = new Database();
    $db = $database->getConnection();

    $med = new Medicament($db);
    $resultats = $med->rechercher($_GET['search']);

    echo json_encode($resultats);
}

