<?php
require_once 'config/database.php';
$db = new Database();
$pdo = $db->getConnection();

// Testez une requête simple
$result = $pdo->query("SHOW TABLES LIKE 'medicaments'")->fetch();
var_dump($result); // Doit retourner la table "medicaments"

// Testez la requête des médicaments
$medicaments = $pdo->query("SELECT * FROM medicaments")->fetchAll(PDO::FETCH_ASSOC);
echo "<pre>";
print_r($medicaments); // Doit afficher vos 3 médicaments
echo "</pre>";