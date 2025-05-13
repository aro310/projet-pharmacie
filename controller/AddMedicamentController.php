<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
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
                $prix = intval($_POST['prix'] ?? 0);
                
                // Validation des champs obligatoires
                if (empty($nom)) {
                    throw new Exception("Le nom est obligatoire");
                }
    
                if ($prix <= 0) {
                    throw new Exception("Le prix doit être un nombre positif");
                }
    
                // Gestion de l'upload de la photo
                $photoPath = null;
                if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = __DIR__.'/../../uploads/';
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
    
                    // Validation du fichier
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
                    $detectedType = finfo_file($fileInfo, $_FILES['photo']['tmp_name']);
                    finfo_close($fileInfo);
    
                    if (!in_array($detectedType, $allowedTypes)) {
                        throw new Exception("Seuls les fichiers JPEG, PNG et GIF sont autorisés");
                    }
    
                    // Générer un nom de fichier unique
                    $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                    $filename = uniqid('med_', true).'.'.$extension;
                    $photoPath = $uploadDir.$filename;
    
                    if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
                        throw new Exception("Erreur lors de l'enregistrement du fichier");
                    }
    
                    // Ne stocker que le chemin relatif dans la BDD
                    $photoPath = 'uploads/'.$filename;
                }
    
                if ($this->medicamentModel->addMedicament($nom, $description, $prix, $photoPath)) {
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
        
        include __DIR__.'/../view/add_medicament.php';
    }
}

$controller = new AddMedicamentController();
$controller->handleRequest();