<?php
include("../inc/connexion.php");
include("../inc/function.php");

if (!isset($_GET['id'])) {
    header("Location: accueil.php");
    exit;
}

$id_objet = intval($_GET['id']);
$historique = get_historique_emprunts($id_objet);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche de l’objet</title>
    <link href="../assets/css/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<script src="../assets/css/js/bootstrap.bundle.min.js"></script>

<div class="container my-4">
    <a href="accueil.php" class="btn btn-secondary mb-3">← Retour</a>

    <?php if ($objet): ?>
        <div class="row">
            <div class="col-md-6">
                <img src="../uploads/<?= htmlspecialchars($objet['image']) ?>" class="img-fluid rounded shadow-sm mb-3" alt="Image principale">
                
                <div class="d-flex flex-wrap gap-2">
                    <?php foreach ($images as $img): ?>
                        <img src="../uploads/<?= htmlspecialchars($img['image']) ?>" class="img-thumbnail" style="width: 100px; height: auto;">
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-6">
                <h3><?= htmlspecialchars($objet['nom_objet']) ?></h3>
                <p><strong>Catégorie :</strong> <?= htmlspecialchars($objet['nom_categorie']) ?></p>
                <p><strong>Description :</strong> <?= htmlspecialchars($objet['description']) ?></p>
                <p><strong>Retour prévu :</strong> <?= $objet['date_retour'] ?? 'Disponible' ?></p>
            </div>
        </div>

        <hr>
        <h5>Historique des emprunts</h5>
        <?php if ($historique && mysqli_num_rows($historique) > 0): ?>
            <ul class="list-group">
                <?php while ($h = mysqli_fetch_assoc($historique)): ?>
                    <li class="list-group-item">
                        Emprunté par <strong><?= htmlspecialchars($h['nom_emprunteur']) ?></strong>
                        du <em><?= $h['date_debut'] ?></em> au <em><?= $h['date_fin'] ?></em>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>Aucun emprunt enregistré.</p>
        <?php endif; ?>

    <?php else: ?>
        <div class="alert alert-warning">Objet non trouvé.</div>
    <?php endif; ?>
</div>

</body>
</html>
