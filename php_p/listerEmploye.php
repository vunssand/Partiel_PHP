<?php
require_once 'connexion.php';

// Vérifie si la requête est bien de type POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Vérification de la présence de l'ID
    if (empty($_POST['id'])) {
        echo "L'ID de l'employé est requis.";
        exit;
    }

    // Récupération de l'ID de l'employé
    $id = $_POST['id'];

    // Préparation de la requête
    $requete = "SELECT * FROM Employee WHERE id = ?";

    // Préparation de la déclaration
    $statement = mysqli_prepare($con, $requete);

    // Bind du paramètre
    mysqli_stmt_bind_param($statement, "i", $id);

    // Exécution
    if (mysqli_stmt_execute($statement)) {
        // Récupération des résultats
        $result = mysqli_stmt_get_result($statement);

        // Vérification si un employé a été trouvé
        if (mysqli_num_rows($result) > 0) {

            $employee = mysqli_fetch_assoc($result);
            echo "ID : " . $employee['id'] . "<br>";
            echo "Nom : " . $employee['name'] . "<br>";
            echo "Email : " . $employee['email'] . "<br>";
            echo "Âge : " . $employee['age'] . "<br>";
            echo "Désignation : " . $employee['designation'] . "<br>";
            echo "Date de création : " . $employee['created'] . "<br>";

        } else {

            echo "Aucun employé trouvé avec cet ID.";

        }
    } else {

        echo "Erreur lors de la récupération de l'employé : " . mysqli_error($con);

    }

    // Fermeture du statement
    mysqli_stmt_close($statement);

} else {

    echo "Mauvais type de requête : la récupération se fait avec une requête POST";

}

// Fermeture de la connexion
mysqli_close($con);
?>
