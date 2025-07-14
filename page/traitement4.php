<?php
session_start();
include("../inc/connexion.php");

// Vérifie que l'utilisateur est connecté
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_objet'], $_POST['nb_jours'])) {
    $id_objet = intval($_POST['id_objet']);
    $id_membre = intval($_SESSION['id_membre']);
    $nb_jours = intval($_POST['nb_jours']);

    // Calcul des dates
    $date_emprunt = date('Y-m-d');
    $date_retour = date('Y-m-d', strtotime("+$nb_jours days"));

    // Insérer dans la table emprunt
    $sql = "INSERT INTO emprunt (id_objet, id_membre, date_emprunt, date_retour) 
            VALUES ($id_objet, $id_membre, '$date_emprunt', '$date_retour')";

    if (mysqli_query($conn, $sql)) {
        header("Location: accueil.php?success=1");
        exit();
    } else {
        echo "Erreur lors de l'enregistrement de l'emprunt : " . mysqli_error($conn);
    }
} else {
    echo "Données manquantes.";
}
?>
