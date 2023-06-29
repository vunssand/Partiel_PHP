<?php
require_once 'connexion.php';

// Vérifie si la requête est bien de type POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Récupération des données de POST
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $designation = $_POST['designation'];
    $created = date('Y-m-d H:i:s');

    // Validation des données
    $errors = array();

    if (empty($name)) {
        $errors[] = "Le nom est requis.";
    }

    if (empty($email)) {
        $errors[] = "L'email est requis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'email n'est pas valide.";
    }

    if (empty($age) || !is_numeric($age)) {
        $errors[] = "L'âge doit être un nombre valide.";
    }

    if (empty($designation)) {
        $errors[] = "La désignation est requise.";
    }

    // Si des erreurs sont présentes, les afficher
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        exit;
    }

    // Préparation de la requête
    $requete = "INSERT INTO Employee (name, email, age, designation, created) 
              VALUES (?, ?, ?, ?, ?)";

    // Préparation de la déclaration
    $statement = mysqli_prepare($con, $requete);

    // Bind des paramètres
    mysqli_stmt_bind_param($statement, "ssiss", $name, $email, $age, $designation, $created);

    // Execution
    if (mysqli_stmt_execute($statement)) {

        echo "Enregistrement réussi !";

    } else {

        echo "Erreur dans l'enregistrement de l'employé: " . mysqli_error($con);

    }

    // Fermeture du statement
    mysqli_stmt_close($statement);

} else {

    echo "Mauvais type de requête : l'enregistrement se fait avec une requête POST";
    
}

// Fermeture de la connexion
mysqli_close($con);
?>

