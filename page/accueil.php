<?php
include("../inc/connexion.php");
include("../inc/function.php");
$result = liste_objet();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
    <table border="1">
  <tr>
    <th>Objet</th>
    <th>Catégorie</th>
    <th>Retour prévu</th>
  </tr>

  <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?= $row['nom_objet'] ?></td>
      <td><?= $row['nom_categorie'] ?></td>
      <td><?= $row['date_retour'] ?? 'Disponible' ?></td>
    </tr>
  <?php } ?>
</table>
</body>
</html>