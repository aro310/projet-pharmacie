<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log'); 

class Liste {
    private $db;

    public function __construct($db) {
        $this->db = $db;
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function addMedicament($nom, $description, $prix, $photoPath) {
        try {
            $query = "INSERT INTO medicaments (nom, description, prix, photo) VALUES (:nom, :description, :prix, :photo)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':prix', $prix, PDO::PARAM_INT);
            $stmt->bindParam(':photo', $photoPath);
            return $stmt->execute();
        } catch(PDOException $e) {
            throw new Exception("Erreur d'insertion: " . $e->getMessage());
        }
    }
    
    public function getAllMedicaments() {
        try {
            $query = "SELECT * FROM medicaments ORDER BY nom ASC"; 
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch(PDOException $e) {
            throw new Exception("Erreur de base de données: " . $e->getMessage());
        }
    }

    public function getMedicamentById($id) {
        $query = "SELECT * FROM medicaments WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}