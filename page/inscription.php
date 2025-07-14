<?php
include("../inc/connexion.php");
include("../inc/function.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Inscription</title>
    <link href="../assets/css/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <script src="../assets/css/js/bootstrap.bundle.min.js"></script>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <form action="traitement1.php" method="post" class="border rounded p-4 shadow" style="min-width: 320px; max-width: 400px; width: 100%;">
            <h1 class="mb-4 text-center">Inscription</h1>

            <?php
            if (isset($_GET['erreur'])) {
                if ($_GET['erreur'] == 1) {
                    echo '<div class="alert alert-danger" role="alert">Veuillez remplir tous les champs.</div>';
                } elseif ($_GET['erreur'] == 2) {
                    echo '<div class="alert alert-danger" role="alert">L\'email est déjà utilisé.</div>';
                }
            }
            ?>

            <div class="mb-3">
                <input type="text" name="nom" class="form-control" placeholder="Nom" required />
            </div>

            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required />
            </div>

            <div class="mb-3">
                <input type="date" name="date" class="form-control" placeholder="Date de naissance" required />
            </div>

            <div class="mb-3">
                <input type="text" name="ville" class="form-control" placeholder="Votre ville" required />
            </div>

            <div class="mb-3">
                <select name="genre" class="form-select" required>
                    <option value="" disabled selected>Choisir le genre</option>
                    <option value="Homme">Homme</option>
                    <option value="Femme">Femme</option>
                    <option value="Autre">Autre</option>
                </select>
            </div>

            <div class="mb-3">
                <input type="password" name="mdp" class="form-control" placeholder="Mot de passe" required />
            </div>

            <button type="submit" class="btn btn-success w-100">Valider</button>
        </form>
    </div>

</body>

</html>
