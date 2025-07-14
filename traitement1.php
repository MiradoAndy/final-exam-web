<?php
$bdd = mysqli_connect('localhost', 'root', '', 'base');
include('../inc/function.php');

$nom = $_POST['nom'];
$email = $_POST['email'];
$date = $_POST['date'];
$mdp = $_POST['mdp'];
$ville = $_POST['ville'];
$genre = $_POST['genre'];

$verification_email = verification_email_existant($email);
$insertion = insertion_inscription($nom, $date, $genre, $email, $ville , $mdp);

if (empty($nom) || empty($email) || empty($date) || empty($mdp) || empty($ville) || empty($genre)) {
    header("Location: inscription.php?erreur=1");
    exit();
}

if ($verification_email == true) {
    header("Location: inscription.php?erreur=2");
    exit();
}

if ($insertion == true) {
    header('Location: login.php');
    exit();
} else {
    echo "Erreur lors de l'insertion " ;
}
?>
