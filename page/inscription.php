<?php
include("../inc/connexion.php");
include("../inc/function.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="container">
        <h1>Inscription</h1>

        <?php
        if (isset($_GET['erreur'])) {
            if ($_GET['erreur'] == 1) {
                echo "<p class='erreur'>Veuillez remplir tous les champs.</p>";
            } elseif ($_GET['erreur'] == 2) {
                echo "<p class='erreur'>L'email est déjà utilisé.</p>";
            }
        }
        ?>

        <form action="traitement1.php" method="post">
            <input type="text" name="nom" placeholder="Nom">
            <input type="email" name="email" placeholder="Email">
            <input type="date" name="date" placeholder="Date de naissance">
            <input type="text" name="ville" placeholder="Votre ville">
            <select name="genre">
                <option value="Homme">homme</option>
                <option value="Femme">femme</option>
                <option value="Autre">autre</option>
            </select>
            <input type="password" name="mdp" placeholder="Mot de passe">
            <input type="submit" value="Valider">
        </form>
    </div>
</body>

</html>
