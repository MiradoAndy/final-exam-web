<?php
include("../inc/connexion.php");
include("../inc/function.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
    <div class="container">

        <form action="traitement2.php" method="post">
            <h1>Connexion</h1>

            <?php
            if (isset($_GET['erreur'])) {
                if ($_GET['erreur'] == 1) {
                    echo "<p class='erreur'>Veuillez remplir tous les champs.</p>";
                } elseif ($_GET['erreur'] == 2) {
                    echo "<p class='erreur'>Email ou mot de passe incorrect.</p>";
                }
            }
            ?>
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="mdp" placeholder="Mot de passe">
            <input type="submit" value="Se connecter">
        </form>
    </div>
</body>

</html>