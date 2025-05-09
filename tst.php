<?php
require_once "config/database.php";
require_once "model/Medicament.php";

$database = new Database();
$db = $database->getConnection();

$med = new Medicament($db);
$resultats = $med->rechercher("para");

echo "<pre>";
print_r($resultats);
echo "</pre>";
