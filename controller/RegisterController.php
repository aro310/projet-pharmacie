<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once __DIR__.'/../model/User.php';
require_once __DIR__.'/../config/database.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Méthode non autorisée');
    }

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Validation
    if (empty($username) || empty($password)) {
        throw new Exception('Tous les champs sont obligatoires');
    }

    if ($password !== $confirmPassword) {
        throw new Exception('Les mots de passe ne correspondent pas');
    }

    

    // Connexion DB et inscription
    $db = new Database();
    $userModel = new User($db->getConnection());

    if ($userModel->register($username, $password)) {
        $_SESSION['success'] = 'Inscription réussie! Vous pouvez maintenant vous connecter';
        header('Location: ../view/index.php');
    } else {
        throw new Exception("Erreur lors de l'inscription");
    }
} catch (Exception $e) {
    header('Location: register.php?error=' . urlencode($e->getMessage()));
    exit;
}