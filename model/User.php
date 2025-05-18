<?php

class User {
    private $conn;

    public function __construct($db) {
        // Sauvegarde la connexion à la base de données
        $this->conn = $db;
    }

    public function login($username, $password) {
        // Cherche l'utilisateur dans la base avec ce nom
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // Récupère la ligne (ou null)

        // --- DEBUG uniquement, à supprimer plus tard ---
        echo "<pre>User from DB: "; print_r($user); echo "</pre>";
        echo "Password provided: $password<br>";
        if ($user) {
            echo "Password hash in DB: ".$user['password']."<br>";
            echo "Verification result: ".password_verify($password, $user['password']);
        }
        // -----------------------------------------------

        // Vérifie si le mot de passe est correct (comparé au hash)
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Connexion réussie
        }
        return false; // Échec
    }

    public function register($username, $password, $role = 'user') {
        // Transforme le mot de passe en hash sécurisé
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        // Enregistre le nouvel utilisateur avec son rôle
        $stmt = $this->conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $hashed, $role]);
    }
}
