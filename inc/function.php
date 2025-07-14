<?php
function bdconnect()
{
    // $bdd = mysqli_connect('localhost', 'ETU004356', 'UTQVmBxb', 'db_s2_ETU004356');
    $bdd = mysqli_connect('localhost', 'root', '', 'base');
    return $bdd;
}

function insertion_inscription($nom,$email,$date,$ville,$genre,$mdp)
{
    
}

?>