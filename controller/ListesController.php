<?php

error_reporting(E_ALL);
ini_set('display_errors', 0);
session_start();

require_once __DIR__.'/../model/Liste.php';
require_once __DIR__.'/../config/database.php';

class ListesController {
    private $medicamentModel;

    public function __construct() {
        try {
            $db = new Database();
            $pdo = $db->getConnection();
            $this->medicamentModel = new Liste($pdo);
        } catch(Exception $e) {
            die("Erreur: " . $e->getMessage());
        }
    }

    public function showMedicaments() {
        try {
            $medicaments = $this->medicamentModel->getAllMedicaments();
            
            // Transmettre les données à la vue
            $viewData = [
                'medicaments' => $medicaments,
                'title' => 'Liste des Médicaments'
            ];
            
            // Extraire les variables pour la vue
            extract($viewData);
            
            // Inclure la vue
            include __DIR__.'/../view/medocs.php';
            exit; // Important pour éviter toute exécution supplémentaire
        } catch(Exception $e) {
            die("Erreur: " . $e->getMessage());
        }
    }
}

// Instanciation et appel
$controller = new ListesController();
$controller->showMedicaments();
?>