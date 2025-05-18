<?php

class Liste {
    private $db;

    public function __construct($db) {
        $this->db = $db;
        // Affiche une erreur si une requête SQL échoue
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function addMedicament($nom, $description, $prix, $photoPath) {
        try {
            // Requête SQL pour insérer un médicament
            $query = "INSERT INTO medicaments (nom, description, prix, photo) VALUES (:nom, :description, :prix, :photo)";
            $stmt = $this->db->prepare($query); // Prépare la requête

            // Remplace les variables dans la requête (:nom, etc.)
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':prix', $prix, PDO::PARAM_INT); // prix = entier
            $stmt->bindParam(':photo', $photoPath);

            // Exécute la requête
            return $stmt->execute();
        } catch(PDOException $e) {
            // Si erreur, message personnalisé
            throw new Exception("Erreur d'insertion: " . $e->getMessage());
        }
    }
    
    public function getAllMedicaments() {
        try {
            // Récupère tous les médicaments, triés par nom
            $query = "SELECT * FROM medicaments ORDER BY nom ASC"; 
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            // fetchAll(PDO::FETCH_ASSOC) = retourne un tableau associatif
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch(PDOException $e) {
            throw new Exception("Erreur de base de données: " . $e->getMessage());
        }
    }

    public function getMedicamentById($id) {
        // Récupère 1 médicament selon son id
        $query = "SELECT * FROM medicaments WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT); // id = entier
        $stmt->execute();

        // fetch(PDO::FETCH_ASSOC) = retourne une seule ligne
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateMedicament($id, $nom, $description, $prix, $photoPath) {
        try {
            // Met à jour un médicament selon son id
            $query = "UPDATE medicaments SET 
                     nom = :nom, 
                     description = :description, 
                     prix = :prix, 
                     photo = :photo 
                     WHERE id = :id";
            
            $stmt = $this->db->prepare($query);

            // Remplace les variables dans la requête
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':prix', $prix, PDO::PARAM_STR); // prix = chaîne (on pourrait mettre PARAM_INT si toujours entier)
            $stmt->bindParam(':photo', $photoPath);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch(PDOException $e) {
            throw new Exception("Erreur de mise à jour: " . $e->getMessage());
        }
    }
}
