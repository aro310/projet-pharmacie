<?php
require 'config/database.php';
$db = new Database();
$pdo = $db->getConnection();

echo "<h1>Test Connexion DB</h1>";
echo "<pre>";
var_dump($pdo);
echo "</pre>";

$test = $pdo->query("SELECT * FROM medicaments WHERE id = 1")->fetch();
echo "<h2>Test Requête</h2>";
echo "<pre>";
var_dump($test);
echo "</pre>";