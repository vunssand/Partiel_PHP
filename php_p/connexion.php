<?php

$bdd = "partiel_php";
$hote = "localhost";
$user = "root";
$mdp = "";

$con = mysqli_connect($hote, $user, $mdp, $bdd);

if(!$con){

    echo "Connexion à la base de données échouée";
    die();

} else {

    echo "Connexion réussie<br>";
}
?>