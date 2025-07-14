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
        <a href="nbrretourne.php" class="btn btn-outline-primary">Nombre de produit retournés</a><br>


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
                                <a href="fiche_objet.php?id=<?= $row['id_objet'] ?>">
                                    <img src="../assets/image/<?= htmlspecialchars($row['image']) ?>" class="card-img-top" alt="Image de l'objet">
                                </a>
                            <?php else: ?>
                                <a href="fiche_objet.php?id=<?= $row['id_objet'] ?>">
                                    <img src="../assets/image/default.jpg" class="card-img-top" alt="Image par défaut">
                                </a>
                            <?php endif; ?>

                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row['nom_objet']) ?></h5>
                                <p class="card-text">
                                    <strong>Catégorie :</strong> <?= htmlspecialchars($row['nom_categorie']) ?><br>
                                    <strong>Retour prévu :</strong> <?= !empty($row['date_retour']) ? htmlspecialchars($row['date_retour']) : 'Disponible' ?>
                                </p>

                                <form action="traitement3.php" method="post" enctype="multipart/form-data">
                                    <input type="file" name="fichier" id="fichier" required><br><br>
                                    <input type="hidden" name="id_objet" value="<?= htmlspecialchars($row['id_objet']) ?>">
                                    <button type="submit" class="btn btn-primary">Uploader</button>
                                </form>

                                <?php if (empty($row['date_retour'])): ?>
                                    <input type="hidden" name="id_objet" value="<?= htmlspecialchars($row['id_objet']) ?>">

                                    <label for="nb_jours_<?= $row['id_objet'] ?>" class="form-label">Nombre de jours :</label>
                                    <select name="nb_jours" id="nb_jours_<?= $row['id_objet'] ?>" class="form-select" onchange="calculerDateRetour(this, <?= $row['id_objet'] ?>)">
                                        <?php for ($i = 1; $i <= 30; $i++): ?>
                                            <option value="<?= $i ?>"><?= $i ?> jour<?= $i > 1 ? 's' : '' ?></option>
                                        <?php endfor; ?>
                                    </select>

                                    <p class="mt-2 text-muted" id="dispo_<?= $row['id_objet'] ?>"></p>

                                    <button type="submit" class="btn btn-success mt-2">Emprunter</button>
                                <?php endif; ?>




                                <?php if (!empty($row['date_retour'])): ?>
                                    <input type="hidden" name="id_objet" value="<?= htmlspecialchars($row['id_objet']) ?>"><br>

                                    <select name="etat" class="form-select">
                                        <option value="">Etat du produit</option>
                                        <option value="1">ok</option>
                                        <option value="2">abime</option>
                                    </select>

                                    <p class="mt-2 text-muted" id="dispo_<?= $row['id_objet'] ?>"></p>

                                    <button type="submit" class="btn btn-success mt-2">Retourner</button>
                                <?php endif; ?>
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