<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log'); 

class Liste {
    private $db;

    public function __construct($db) {
        $this->db = $db;
        // Activez les exceptions PDO
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function addMedicament($nom, $description) {
        try {
            $query = "INSERT INTO medicaments (nom, description) VALUES (:nom, :description)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':description', $description);
            return $stmt->execute();
        } catch(PDOException $e) {
            die("Erreur d'insertion: " . $e->getMessage());
        }
    }
    

    public function getAllMedicaments() {
        try {
            $query = "SELECT * FROM medicaments"; 
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if(empty($result)) {
                throw new Exception("Aucun médicament trouvé dans la base de données");
            }
            
            return $result;
        } catch(PDOException $e) {
            throw new Exception("Erreur de base de données: " . $e->getMessage());
        }
    }

    public function getMedicamentById($id) {
        $query = "SELECT * FROM medicaments WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne false si aucun résultat
    }
}
?>