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
    return true; // Email already exists
} else {
    return false; // Email does not exist
}
}

?>