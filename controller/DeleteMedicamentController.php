<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once __DIR__.'/../model/Liste.php';
require_once __DIR__.'/../config/database.php';

try {
    // Validation de l'ID
    if (!isset($_POST['id']) || !ctype_digit($_POST['id'])) {
        throw new Exception("ID invalide ou manquant");
    }
    $id = (int)$_POST['id'];

    // Connexion DB
    $db = new Database();
    $pdo = $db->getConnection();
    $model = new Liste($pdo);

    // Suppression du médicament
    $query = "DELETE FROM medicaments WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Médicament supprimé avec succès";
    } else {
        throw new Exception("Erreur lors de la suppression");
    }

    header("Location: ListesController.php");
    exit;

} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    header("Location: ListesController.php");
    exit;
}