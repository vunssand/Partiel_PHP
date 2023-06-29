<?php
require_once 'connexion.php';

// Vérifie si la requête est bien de type POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Vérifie si l'ID de l'employé est présent dans la requête POST
    if (!isset($_POST['id'])) {

        echo "ID de l'employé manquant.";
        exit;

    }

    // Récupération de l'ID de l'employé à supprimer
    $employee_id = $_POST['id'];

    // Préparation de la requête
    $requete = "DELETE FROM Employee WHERE id = ?";

    // Préparation de la déclaration
    $statement = mysqli_prepare($con, $requete);

    // Bind du paramètre (ID de l'employé)
    mysqli_stmt_bind_param($statement, "i", $employee_id);

    // Exécution
    if (mysqli_stmt_execute($statement)) {

        echo "Employé supprimé avec succès.";

    } else {

        echo "Erreur lors de la suppression de l'employé : " . mysqli_error($con);

    }

    // Fermeture du statement
    mysqli_stmt_close($statement);

} else {
    echo "Mauvais type de requête : la suppression se fait avec une requête POST";
}

// Fermeture de la connexion
mysqli_close($con);
?>

