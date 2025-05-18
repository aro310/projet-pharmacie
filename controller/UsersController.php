<?php
session_start();
require_once __DIR__.'/../model/User.php';
require_once __DIR__.'/../config/database.php';

$db = new Database();
$userModel = new User($db->getConnection());

try {
    $users = $userModel->getAllUsers();
    include __DIR__.'/../view/users_list.php';
} catch (Exception $e) {
    $_SESSION['error'] = "Erreur: " . $e->getMessage();
    header("Location: DashboardController.php");
    exit;
}