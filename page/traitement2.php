<?php
    $bdd = mysqli_connect('localhost', 'root', '', 'base');
    session_start();
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    if (empty($email) || empty($mdp)) {
        header("Location:login.php?erreur=1"); 
        exit();
    }

    $query = sprintf("select idMembre,Nom from membres where Email='$email' and Motdepasse='$mdp'");
    $resultat = mysqli_query($bdd,$query);

    if ($resultat && mysqli_num_rows($resultat) === 1) {
        $x = mysqli_fetch_assoc($resultat);
        $_SESSION['id'] = $x['idMembre'];
        $_SESSION['Nom'] = $x['Nom'];
        header('Location:accueil.php');
        exit();
    } else {
        header("Location:login.php?erreur=2"); 
        exit();
    }

?>