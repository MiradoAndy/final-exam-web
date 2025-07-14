<?php
function bdconnect()
{
    // $bdd = mysqli_connect('localhost', 'ETU004356', 'UTQVmBxb', 'db_s2_ETU004356');
    $bdd = mysqli_connect('localhost', 'root', '', 'base');
    return $bdd;
}

function insertion_inscription($nom,$date,$genre,$email,$ville,$mdp)
{
    $query = "INSERT INTO membre (nom , date_naissance ,genre , email , ville , mdp ) 
            VALUES ('$nom' , '$date' , '$genre' , '$email' , '$ville' ,'$mdp')";
    $resultat = mysqli_query(bdconnect(), $query);
    if (!$resultat) {
        return false;
    } else {
        return true;
    }
}

function verification_email_existant ($email){
$queryCheck = "SELECT * FROM membre WHERE email = '$email'";
$resultCheck = mysqli_query(bdconnect(), $queryCheck);

if (mysqli_num_rows($resultCheck) > 0) {
    return true; 
} else {
    return false; 
}
}

function login($email, $mdp)
{
    $query = "select * from membre where email='$email' and mdp='$mdp'";
    $resultat = mysqli_query(bdconnect(),$query);
    if (!$resultat) {
        return 0;
    }
    else {
        return $resultat;
    }
}

function liste_objet()
{
    $query = "SELECT o.nom_objet, c.nom_categorie, e.date_retour
        FROM objet o
        JOIN categorie_objet c ON o.id_categorie = c.id_categorie
        JOIN emprunt e ON o.id_objet = e.id_objet 
        AND e.date_retour IS NULL";
    $resultat = mysqli_query(bdconnect(), $query);
    if (!$resultat) {
        return 0;
    } else {
        return $resultat;
    }
}

function liste_categorie()
{
    $query = "SELECT * FROM categorie_objet";
    $resultat = mysqli_query(bdconnect(), $query);
    if (!$resultat) {
        return 0;
    } else {
        return $resultat;
    }
}

function filtre_objet_par_categorie($where = "")
{
    $query = "SELECT o.nom_objet, o.id_objet, c.nom_categorie, e.date_retour
              FROM objet o
              JOIN categorie_objet c ON o.id_categorie = c.id_categorie
              LEFT JOIN emprunt e ON o.id_objet = e.id_objet
              $where";
    return mysqli_query(bdconnect(), $query);
}

function upload_image($id,$file)
{
    $query = "update images_objet set nom_image = '$file' where id_objet = $id";
    $resultat = mysqli_query(bdconnect(), $query);
    if (!$resultat) {
        return 0;
    } else {
        return $resultat;
    }
}








// function get_objet_par_id($id) {
//     global $connexion;
//     $sql = "SELECT o.*, c.nom_categorie FROM objet o
//             JOIN categorie c ON o.id_categorie = c.id_categorie
//             WHERE o.id_objet = ?";
//     $stmt = mysqli_prepare($connexion, $sql);
//     mysqli_stmt_bind_param($stmt, "i", $id);
//     mysqli_stmt_execute($stmt);
//     return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
// }

// function get_images_supplementaires($id) {
//     global $connexion;
//     $sql = "SELECT image FROM image_objet WHERE id_objet = ?";
//     $stmt = mysqli_prepare($connexion, $sql);
//     mysqli_stmt_bind_param($stmt, "i", $id);
//     mysqli_stmt_execute($stmt);
//     return mysqli_stmt_get_result($stmt);
// }

function get_historique_emprunts($id) {
    $query = "SELECT e.nom AS nom_membre, h.date_emprunt, h.date_retour
            FROM  emprunt h
            JOIN membre e ON e.id_membre = h.id_membre
            WHERE h.id_objet = '$id'
            ORDER BY h.date_emprunt DESC";
   $resultat = mysqli_query(bdconnect(), $query);
   return $resultat;
}


?>