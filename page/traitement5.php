<?php
include("../inc/connexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_objet = intval($_POST['id_objet'] ?? 0);
    $etat = $_POST['etat'] ?? null;

    if ($id_objet && in_array($etat, ['ok', 'abime'])) {
        $sqlFind = "SELECT id_emprunt FROM emprunt WHERE id_objet = $id_objet AND date_retour IS NULL ORDER BY date_emprunt DESC LIMIT 1";
        $res = mysqli_query(bdconnect(), $sqlFind);
        $emprunt = mysqli_fetch_assoc($res);

        if ($emprunt) {
            $id_emprunt = $emprunt['id_emprunt'];
            $today = date('Y-m-d');

            $sqlUpdate = "
                UPDATE emprunt 
                SET date_retour = '$today', etat = '$etat'
                WHERE id_emprunt = $id_emprunt
            ";
            mysqli_query(bdconnect(), $sqlUpdate);

            header("Location: accueil.php?retour=success");
            exit;
        } else {
            echo "Aucun emprunt actif trouvé pour cet objet.";
        }
    } else {
        echo "Paramètres invalides.";
    }
} else {
    echo "Méthode non autorisée.";
}
?>
