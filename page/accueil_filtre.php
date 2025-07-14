<?php
include("../inc/connexion.php");
include("../inc/function.php");

$where = "";
if (isset($_POST['categorie']) && $_POST['categorie'] !== "") {
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
    <title>Résultat du filtre</title>
    <link href="../assets/css/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <script src="../assets/css/js/bootstrap.bundle.min.js"></script>
    <div class="container my-4">

        <div class=" d-flex justify-content-between align-items-center mb-3">
            <a href="accueil.php" class="btn btn-secondary me-2">Retour</a>
            <a href="../inc/deconnexion.php" class="btn btn-outline-danger">Déconnexion</a>
        </div>

        <h2 class="mb-4">Liste des objets filtrés</h2>

        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Objet</th>
                    <th>Catégorie</th>
                    <th>Retour prévu</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nom_objet']) ?></td>
                            <td><?= htmlspecialchars($row['nom_categorie']) ?></td>
                            <td><?= !empty($row['date_retour']) ? htmlspecialchars($row['date_retour']) : 'Disponible' ?></td>
                        </tr>
                    <?php } ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">Aucun objet trouvé</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
