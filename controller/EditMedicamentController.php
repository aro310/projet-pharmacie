<?php

require_once __DIR__.'/../model/Liste.php';
require_once __DIR__.'/../config/database.php';

try {
    // Validation de l'ID
    if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
        throw new Exception("ID invalide ou manquant");
    }
    $id = (int)$_GET['id'];

    // Connexion DB
    $db = new Database();
    $pdo = $db->getConnection();
    $model = new Liste($pdo);

    // Récupération du médicament
    $medicament = $model->getMedicamentById($id);
    if (!$medicament) {
        throw new Exception("Médicament introuvable");
    }

    // Traitement du formulaire
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = trim($_POST['nom']);
        $description = trim($_POST['description']);
        $prix = (float)$_POST['prix'];
        $photoPath = $medicament['photo']; // Conserve l'ancienne photo par défaut
        $removePhoto = isset($_POST['remove_photo']) && $_POST['remove_photo'] === '1';

        // Validation
        if (empty($nom)) {
            throw new Exception("Le nom est obligatoire");
        }

        // Gestion de la suppression de photo
        if ($removePhoto) {
            $uploadDir = __DIR__.'/../../uploads/';
            if (!empty($medicament['photo']) && file_exists($uploadDir.basename($medicament['photo']))) {
                unlink($uploadDir.basename($medicament['photo']));
                $photoPath = null; // Ou une valeur par défaut comme 'default.jpg'
            }
        }
        // Gestion de l'upload de nouvelle photo
        elseif (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__.'/../../uploads/';
            
            // Validation du type
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
            $detectedType = finfo_file($fileInfo, $_FILES['photo']['tmp_name']);
            finfo_close($fileInfo);

            if (!in_array($detectedType, $allowedTypes)) {
                throw new Exception("Seuls les formats JPG, PNG et GIF sont autorisés");
            }

            // Suppression ancienne photo si elle existe
            if (!empty($medicament['photo']) && file_exists($uploadDir.basename($medicament['photo']))) {
                unlink($uploadDir.basename($medicament['photo']));
            }

            // Nouveau nom de fichier
            $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
            $filename = uniqid('med_', true).'.'.$extension;
            $photoPath = 'uploads/'.$filename;

            // Déplacement du fichier
            if (!move_uploaded_file($_FILES['photo']['tmp_name'], __DIR__.'/../../'.$photoPath)) {
                throw new Exception("Erreur lors de l'enregistrement de la photo");
            }
        }

        // Mise à jour en base
        $query = "UPDATE medicaments SET nom = :nom, description = :description, prix = :prix, photo = :photo WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':nom' => $nom,
            ':description' => $description,
            ':prix' => $prix,
            ':photo' => $photoPath,
            ':id' => $id
        ]);

        $_SESSION['success'] = "Médicament mis à jour avec succès";
        header("Location: DetailMedicamentController.php?id=$id");
        exit;
    }

    // Affichage du formulaire
    include __DIR__.'/../view/edit_medicament.php';

} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    header("Location: EditMedicamentController.php?id=$id");
    exit;
}