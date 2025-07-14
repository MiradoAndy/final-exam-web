<?php
include("../inc/connexion.php");
include("../inc/function.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fichier'])) {
    $id_objet = intval($_POST["id_objet"]);
    $uploadDir = "../assets/image/";
    $maxSize = 200 * 1024 * 1024; // 200 Mo
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'application/pdf'];

    $file = $_FILES['fichier'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        die('Erreur lors de l’upload du fichier.');
    }

    if ($file['size'] > $maxSize) {
        die('Le fichier est trop volumineux.');
    }

    // Vérifie le type MIME
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mime, $allowedMimeTypes)) {
        die('Type de fichier non autorisé : ' . $mime);
    }

    // Renommer proprement le fichier
    $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = $originalName . '_' . uniqid() . '.' . $extension;

    // Déplacer le fichier
    if (!move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
        die('Échec du déplacement du fichier.');
    }

    // Enregistrer dans la base
    $publication = upload_image($id_objet, $newName);
    if ($publication) {
        header('Location: accueil.php');
        exit;
    } else {
        die('Erreur base de données.');
    }
} else {
    die('Aucun fichier reçu.');
}
?>
