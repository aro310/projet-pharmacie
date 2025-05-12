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
}
?>