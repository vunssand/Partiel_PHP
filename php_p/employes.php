<?php
require_once 'connexion.php';

//Création de la requête
$requete = "SELECT * FROM Employee";
$resultat = mysqli_query($con, $requete);

if(mysqli_num_rows($resultat) > 0){
    
    //Affichage des employés sous forme de liste HTML
    while($ligne = mysqli_fetch_assoc($resultat)){
        echo "<tr>";
        echo "<td>".$ligne['id']."</td>";
        echo "<td>".$ligne['name']."</td>";
        echo "<td>".$ligne['email']."</td>";
        echo "<td>".$ligne['age']."</td>";
        echo "<td>".$ligne['designation']."</td>";
        echo "<td>".$ligne['created']."</td>";
        echo "</tr>";
    }
    
} else {

    //Cas ou aucun employé n'est enregistré en base
    echo "Aucun employé n'a été trouvé.";
}

//fermeture de la connexion
mysqli_close($con);

?>







