<?php
class Database {
    // Infos pour se connecter à la base de données
    private $host = "localhost";
    private $db_name = "pharmacie_db";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        try {
            // Crée une nouvelle connexion PDO à MySQL
            // "mysql:host=...;dbname=...;charset=utf8" : chaîne de connexion
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name;charset=utf8", 
                                  $this->username, 
                                  $this->password);
            
            // Active le mode "exception" pour les erreurs
            // Cela permet d'afficher les erreurs si quelque chose ne va pas
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            // Affiche l'erreur si la connexion échoue
            echo "Erreur de connexion : " . $exception->getMessage();
        }

        // Retourne la connexion
        return $this->conn;
    }
}
