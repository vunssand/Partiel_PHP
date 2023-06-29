<?php
require_once 'connexion.php';

// Vérifie si la requête est bien de type POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Vérification de la présence des paramètres
    if (empty($_POST['id']) || empty($_POST['name']) || empty($_POST['email']) || empty($_POST['age']) || empty($_POST['designation'])) {

        echo "Tous les paramètres (ID, name, email, age, designation) sont requis.";
        exit;
    }

    // Récupération des paramètres
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $designation = $_POST['designation'];

    // Préparation de la requête
    $requete = "UPDATE Employee SET name = ?, email = ?, age = ?, designation = ? WHERE id = ?";

    // Préparation de la déclaration
    $statement = mysqli_prepare($con, $requete);

    // Bind des paramètres
    mysqli_stmt_bind_param($statement, "ssisi", $name, $email, $age, $designation, $id);

    // Exécution
    if (mysqli_stmt_execute($statement)) {

        echo "Les informations de l'employé ont été mises à jour avec succès.";

    } else {

        echo "Erreur lors de la mise à jour des informations de l'employé : " . mysqli_error($con);

    }

    // Fermeture du statement
    mysqli_stmt_close($statement);

} else {

    echo "Mauvais type de requête : la modification se fait avec une requête POST";

}

// Fermeture de la connexion
mysqli_close($con);
?>
