<?php
class Medicament {
    private $conn;

    public function __construct($db) {
        // Sauvegarde la connexion à la base de données
        $this->conn = $db;
    }

    public function rechercher($terme) {
        // Prépare une requête pour chercher les médicaments dont le nom contient le terme
        $stmt = $this->conn->prepare("SELECT * FROM medicaments WHERE nom LIKE ?");

        // Ajoute les % pour dire "contient le mot" (ex: %aspirine%)
        $terme = "%" . $terme . "%";

        // Exécute la requête avec le mot recherché
        $stmt->execute([$terme]);

        // Retourne tous les résultats sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
