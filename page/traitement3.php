<?php
    include("../inc/connexion.php");
    include("../inc/function.php");

    $id_objet = $_POST["id_objet"];

    $uploadDir = "assets" . '/image/';
    $maxSize = 200 * 1024 * 1024; // 200 Mo
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'application/pdf'];
    // Vérifie si un fichier est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fichier'])) {
    $file = $_FILES['fichier'];
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $file = null;
        $publication = upload_image($id_objet,$file);

        if ($publication) {
            header('Location:accueil.php');
        }
    }
    // Vérifie la taille
    if ($file['size'] > $maxSize) {
    die('Le fichier est trop volumineux.');}
    // Vérifie le type MIME avec `finfo`
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    if (!in_array($mime, $allowedMimeTypes)) {
    die('Type de fichier non autorisé : ' . $mime);
    }
    // renommer le fichier
    $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = $originalName . '_' . uniqid() . '.' . $extension;
    // Déplace le fichier
    if (move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
        $sary = $newName;
    }
    }
    $publication = upload_image($id_objet,$sary);

    if ($publication) {
        header('Location:accueil.php');
    }
?>