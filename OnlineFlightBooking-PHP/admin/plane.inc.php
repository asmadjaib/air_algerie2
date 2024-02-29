<?php
// ../includes/admin/plane.inc.php

// Inclure le fichier d'initialisation de la connexion à la base de données
require_once '../helpers/init_conn_db.php';

// Vérifie si le formulaire a été soumis
if (isset($_POST['plane_but'])) {
    // Récupérer les données du formulaire
    $name = $_POST['name'];
    $autonomy = $_POST['autonomy'];
    $seats = $_POST['seats'];
    $availability = $_POST['availability'];

    // Insérer les données dans la base de données
    $sql = "INSERT INTO plane (nom, autonomie, Nbr_place_tot, Disponibilite) VALUES ('$name', '$autonomy', '$seats', '$availability')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Redirection vers la page de liste des avions avec un message de succès si l'insertion a réussi
        header("Location: list_planes.php?success=1");
        exit();
    } else {
        // Redirection vers la page de liste des avions avec un message d'erreur si l'insertion a échoué
        header("Location: list_planes.php?error=sqlerr");
        exit();
    }
}
?>

