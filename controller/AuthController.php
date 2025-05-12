<?php

session_start();
require_once '../config/database.php'; // contient Database
require_once '../model/User.php';      // contient la classe User

// Créer une instance de connexion à la base de données
$db = new Database();
$pdo = $db->getConnection(); // très important !

$stmt = $pdo->query("SELECT id, password FROM users");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if (!password_needs_rehash($row['password'], PASSWORD_DEFAULT)) {
        continue; // Déjà haché
    }
    
    $hashed = password_hash($row['password'], PASSWORD_DEFAULT);
    $update = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
    $update->execute([$hashed, $row['id']]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'], $_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $userModel = new User($pdo); // passe la connexion à la classe User
        $user = $userModel->login($username, $password);

        if ($user) {
            $_SESSION['user'] = $user;
            var_dump($_SESSION); 
            header("Location: ../view/index.php"); // Connexion réussie
            exit;
        } else {
            header("Location: ../view/login.php?error=1"); // Erreur login
            exit;
        }
    }
}
