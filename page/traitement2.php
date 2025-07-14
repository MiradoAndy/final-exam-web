<?php
    include("../inc/connexion.php");
    include('../inc/function.php');
    
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    if (empty($email) || empty($mdp)) {
        header("Location:login.php?erreur=1"); 
        exit();
    }

    $verification = login($email, $mdp);

    if ($verification != 0 && mysqli_num_rows($verification) === 1) {
        header('Location:accueil.php');
        exit();
    } else {
        header("Location:login.php?erreur=2"); 
        exit();
    }

?>