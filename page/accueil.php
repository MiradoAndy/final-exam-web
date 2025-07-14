<?php
include("../inc/connexion.php");
include("../inc/function.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Accueil - Filtrer les objets</title>
    <link href="../assets/css/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <script src="../assets/css/js/bootstrap.bundle.min.js"></script>
    <div class="container my-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Accueil</h2>
            <a href="../inc/deconnexion.php" class="btn btn-outline-danger">Déconnexion</a>
        </div>

        <form action="accueil_filtre.php" method="post" class="row g-3 align-items-center">
            <div class="col-auto">
                <select name="categorie" class="form-select">
                    <option value="">Toutes les catégories</option>
                    <?php
                    $cats = liste_categorie();
                    while ($cat = mysqli_fetch_assoc($cats)) {
                        echo "<option value='" . htmlspecialchars($cat['id_categorie']) . "'>" . htmlspecialchars($cat['nom_categorie']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Filtrer</button>
            </div>
        </form>

    </div>

</body>
</html>
