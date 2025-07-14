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

function filtre_objet_par_categorie($where)
{
    $query = "SELECT o.nom_objet, c.nom_categorie, e.date_retour
              FROM objet o
              JOIN categorie_objet c ON o.id_categorie = c.id_categorie
              LEFT JOIN emprunt e ON o.id_objet = e.id_objet AND e.date_retour IS NULL
              $where";
    return mysqli_query(bdconnect(), $query);
}

function upload_image($id,$file)
{
    $query = "INSERT INTO images_objet (id_objet, nom_image) VALUES ($id, $file)";
    $resultat = mysqli_query(bdconnect(), $query);
    if (!$resultat) {
        return 0;
    } else {
        return $resultat;
    }
}

?>