<?php
$bdd = mysqli_connect('localhost', 'root', '', 'base');

$nom = $_POST['nom'];
$email = $_POST['email'];
$date = $_POST['date'];
$mdp = $_POST['mdp'];

if (empty($nom) || empty($email) || empty($date) || empty($mdp)) {
    header("Location: inscription.php?erreur=1");
    exit();
}

$queryCheck = "SELECT * FROM Membres WHERE Email = '$email'";
$resultCheck = mysqli_query($bdd, $queryCheck);

if (mysqli_num_rows($resultCheck) > 0) {
    header("Location: inscription.php?erreur=2");
    exit();
}

$query = "INSERT INTO Membres (Nom, Email, Motdepasse, DateNaissance)
          VALUES ('$nom', '$email', '$mdp', '$date')";
$resultat = mysqli_query($bdd, $query);

if ($resultat) {
    header('Location: login.php');
    exit();
} else {
    echo "Erreur lors de l'insertion : " . mysqli_error($bdd);
}
?>
