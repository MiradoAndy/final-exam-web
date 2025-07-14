<?php
include("../inc/connexion.php");
include("../inc/function.php");

$where = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categorie']) && $_POST['categorie'] !== "") {
    $id_cat = intval($_POST['categorie']);
    $where = "WHERE o.id_categorie = $id_cat";
}

$result = filtre_objet_par_categorie($where);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Accueil - Objets</title>
    <link href="../assets/css/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <script src="../assets/css/js/bootstrap.bundle.min.js"></script>

    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Accueil</h2>
            <a href="../inc/deconnexion.php" class="btn btn-outline-danger">Déconnexion</a>
        </div>

        <form action="" method="post" class="row g-3 align-items-center mb-4">
            <div class="col-md-6">
                <select name="categorie" class="form-select">
                    <option value="">Toutes les catégories</option>
                    <?php
                    $cats = liste_categorie();
                    while ($cat = mysqli_fetch_assoc($cats)) {
                        $selected = (isset($id_cat) && $id_cat == $cat['id_categorie']) ? "selected" : "";
                        echo "<option value='" . htmlspecialchars($cat['id_categorie']) . "' $selected>" . htmlspecialchars($cat['nom_categorie']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-auto">
                <button type="submit" class="btn btn-primary">Filtrer</button>
            </div>
        </form>

        <h4 class="mb-3">Résultats</h4>

        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <?php if (!empty($row['image'])): ?>
                                <img src="../assets/image/<?= htmlspecialchars($row['image']) ?>" class="card-img-top" alt="Image de l'objet">
                            <?php else: ?>
                                <img src="../assets/image/default.jpg" class="card-img-top" alt="Image par défaut">
                            <?php endif; ?>

                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row['nom_objet']) ?></h5>
                                <p class="card-text">
                                    <strong>Catégorie :</strong> <?= htmlspecialchars($row['nom_categorie']) ?><br>
                                    <strong>Retour prévu :</strong> <?= !empty($row['date_retour']) ? htmlspecialchars($row['date_retour']) : 'Disponible' ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">Aucun objet trouvé.</div>
        <?php endif; ?>
    </div>
</body>
</html>
