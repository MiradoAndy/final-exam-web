<?php
include("../inc/connexion.php");
include("../inc/function.php");

$queryTotal = "SELECT COUNT(*) AS total_retournes FROM emprunt WHERE date_retour IS NOT NULL";
$resTotal = mysqli_query(bdconnect(), $queryTotal);
$dataTotal = mysqli_fetch_assoc($resTotal);

$queryParEtat = "
    SELECT etat, COUNT(*) AS nombre
    FROM emprunt
    WHERE date_retour IS NOT NULL AND etat IS NOT NULL
    GROUP BY etat
";
$resEtat = mysqli_query(bdconnect(), $queryParEtat);

// $dataTotal = get_nbr_emprunt_retourne();
// $resEtat = nbr_retour_etat();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques de retour</title>
    <link href="../assets/css/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <div class="container my-5">
        <a href="accueil.php" class="btn btn-outline-primary">Nombre de produit retournés</a><br>
        <h2 class="mb-4">Statistiques des retours</h2>

        <div class="card p-4 mb-3 shadow-sm">
            <h4>Total des objets retournés : <?= $dataTotal['total_retournes'] ?></h4>
        </div>

        <div class="card p-4 shadow-sm">
            <h5>Détail par état :</h5>
            <ul class="list-group mt-3">
                <?php while ($row = mysqli_fetch_assoc($resEtat)): ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <?= ucfirst($row['etat']) ?>
                        <span class="badge bg-primary rounded-pill"><?= $row['nombre'] ?></span>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
</body>
</html>
