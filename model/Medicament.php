<?php
class Medicament {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function rechercher($terme) {
        $stmt = $this->conn->prepare("SELECT * FROM medicaments WHERE nom LIKE ?");
        $terme = "%" . $terme . "%";
        $stmt->execute([$terme]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
