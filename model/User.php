<?php

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Debug: Afficher ce qui est récupéré de la BDD
        echo "<pre>User from DB: "; print_r($user); echo "</pre>";
        echo "Password provided: $password<br>";
        if ($user) {
            echo "Password hash in DB: ".$user['password']."<br>";
            echo "Verification result: ".password_verify($password, $user['password']);
        }
    
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function register($username, $password, $role = 'user') {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $hashed, $role]);
    }
}