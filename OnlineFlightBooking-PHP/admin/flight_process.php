<?php
// Inclure le fichier d'initialisation de la connexion à la base de données
require_once '../helpers/init_conn_db.php';

// Vérifier si le formulaire a été soumis
if (isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $source_date = $_POST['source_date'];
    $source_time = $_POST['source_time'];
    $dest_date = $_POST['dest_date'];
    $dest_time = $_POST['dest_time'];
    $departure_city = $_POST['departure_city'];
    $arrival_city = $_POST['arrival_city'];
    $plane_id = $_POST['plane'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];

    // Insérer les données dans la base de données
    $sql = "INSERT INTO flight (admin_id, arrivale, departure, Destination, source, duration, Price, id_plane, status, issue) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, '', '')";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../flight.php?error=sqlerror");
        exit();
    } else {
        $admin_id = $_SESSION['adminId'];
        $arrival = $dest_date . ' ' . $dest_time . ':00';
        $departure = $source_date . ' ' . $source_time . ':00';
        mysqli_stmt_bind_param($stmt, "ssssssii", $admin_id, $arrival, $departure, $arrival_city, $departure_city, $duration, $price, $plane_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: ../flight.php?success=flightadded");
        exit();
    }
} else {
    header("Location: ../flight.php");
    exit();
}
?>
