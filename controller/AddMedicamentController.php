<?php
// Doit être la PREMIÈRE ligne du fichier, sans espace avant
error_reporting(E_ALL);
ini_set('display_errors', 0); // Désactive l'affichage des erreurs (évite les headers déjà envoyés)
ini_set('log_errors', 1);
ini_set('error_log', __DIR__.'/../../error_log.txt');

require_once __DIR__.'/../model/Liste.php';
require_once __DIR__.'/../config/database.php';

class AddMedicamentController {
    private $medicamentModel;

    public function __construct() {
        $db = new Database();
        $pdo = $db->getConnection();
        $this->medicamentModel = new Liste($pdo);
    }

    public function handleRequest() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nom = trim(htmlspecialchars($_POST['nom'] ?? ''));
                $description = trim(htmlspecialchars($_POST['description'] ?? ''));
                
                if (empty($nom)) {
                    throw new Exception("Le nom est obligatoire");
                }

                if ($this->medicamentModel->addMedicament($nom, $description)) {
                    // Redirection avec paramètre pour forcer le rafraîchissement
                    header('Location: ListesController.php?refresh='.time());
                    exit;
                }
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            $_SESSION['error'] = $e->getMessage();
            header('Location: AddMedicamentController.php');
            exit;
        }
        
        // Affichage du formulaire SEULEMENT si méthode GET
        include __DIR__.'/../view/add_medicament.php';
    }
}

$controller = new AddMedicamentController();
$controller->handleRequest();