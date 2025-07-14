<?php
$nb_jours = $_POST['nb_jours'];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nb_jours'])) {
    $nb_jours = intval($_POST['nb_jours']);
    echo "L'utilisateur a choisi $nb_jours jour(s)";
} else {
    echo "Aucune valeur reçue.";
}

?>