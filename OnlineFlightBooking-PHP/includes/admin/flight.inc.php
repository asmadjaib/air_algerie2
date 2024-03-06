<?php 
session_start();
require '../../helpers/init_conn_db.php';

if(isset($_POST['flight_but']) && isset($_SESSION['adminId'])) {
    // Récupérer l'ID admin à partir de la session
    $admin_id = $_SESSION['adminId'];

    $source_date = $_POST['source_date'];
    $source_time = $_POST['source_time'];
    $dest_date = $_POST['dest_date'];
    $dest_time = $_POST['dest_time'];
    $dep_city = $_POST['dep_city'];
    $arr_city = $_POST['arr_city'];
    $price = $_POST['price'];
    $id_plane = $_POST['plane'];

    // Vérification des erreurs et validations des données
    if ($dep_city === $arr_city || $arr_city === 'To' || $arr_city === 'From') {
        header('Location: ../../admin/flight.php?error=same');
        exit();
    }

    $dep_date_time = $source_date . ' ' . $source_time;
    $arr_date_time = $dest_date . ' ' . $dest_time;

    if (strtotime($arr_date_time) <= strtotime($dep_date_time)) {
        header('Location: ../../admin/flight.php?error=destless');
        exit();
    }

    // Récupération de la vitesse de l'avion à partir de la base de données
    $sql_speed = "SELECT vitesse FROM plane WHERE Id_plane = ?";
    $stmt_speed = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt_speed, $sql_speed)) {
        header('Location: ../../admin/flight.php?error=sqlerr');
        exit();
    }
    mysqli_stmt_bind_param($stmt_speed, 'i', $id_plane);
    mysqli_stmt_execute($stmt_speed);
    $result_speed = mysqli_stmt_get_result($stmt_speed);
    $row_speed = mysqli_fetch_assoc($result_speed);
    $speed = $row_speed['vitesse'];
    mysqli_stmt_close($stmt_speed);

    // Récupération des coordonnées de latitude et de longitude des villes de départ et d'arrivée
    $dep_coordinates = getCoordinates($dep_city);
    $arr_coordinates = getCoordinates($arr_city);

    if ($dep_coordinates && $arr_coordinates) {
        $dep_lat = $dep_coordinates['latitude'];
        $dep_lon = $dep_coordinates['longitude'];
        $arr_lat = $arr_coordinates['latitude'];
        $arr_lon = $arr_coordinates['longitude'];

        // Calcul de la distance entre les deux villes
        $distance = calculateDistance($dep_lat, $dep_lon, $arr_lat, $arr_lon);

        // Calcul de la durée du vol en fonction de la distance et de la vitesse
        $flight_duration_hours = floor($distance / $speed); // Partie entière des heures
        $flight_duration_minutes = round((($distance / $speed) - $flight_duration_hours) * 60); // Partie entière des minutes
        $flight_duration = $flight_duration_hours . 'h / ' . $flight_duration_minutes . ' min';

        // Insertion des données dans la base de données
        $sql_insert = "INSERT INTO flight (admin_id, departure, arrivale, source, Destination, duration, Price, id_plane, distance)
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt_insert = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt_insert, $sql_insert)) {
            header('Location: ../../admin/flight.php?error=sqlerr');
            exit();
        }
        mysqli_stmt_bind_param($stmt_insert, 'isssssddi', $admin_id, $dep_date_time, $arr_date_time, $dep_city, $arr_city, $flight_duration, $price, $id_plane, $distance);

        mysqli_stmt_execute($stmt_insert);
        mysqli_stmt_close($stmt_insert);
        mysqli_close($conn);

        header('Location: ../../admin/list_flight.php?flight=success');
        exit();
    } else {
        // Gérer le cas où les coordonnées ne sont pas disponibles pour les villes sélectionnées
        header('Location: ../../admin/flight.php?error=coorderr');
        exit();
    }
} else {
    header('Location: ../../index.php');
    exit();
}

// Fonction pour récupérer les coordonnées de latitude et de longitude d'une ville depuis la base de données
function getCoordinates($city) {
    global $conn;
    $sql = "SELECT * FROM cities WHERE city = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return false;
    }
    mysqli_stmt_bind_param($stmt, 's', $city);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        return array(
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude']
        );
    } else {
        return false;
    }
}

// Fonction pour calculer la distance entre deux points géographiques en utilisant la formule haversine
function calculateDistance($dep_lat, $dep_lon, $arr_lat, $arr_lon) {
    $earth_radius = 6371; // Rayon moyen de la Terre en kilomètres

    // Conversion des degrés en radians
    $dep_lat_rad = deg2rad($dep_lat);
    $dep_lon_rad = deg2rad($dep_lon);
    $arr_lat_rad = deg2rad($arr_lat);
    $arr_lon_rad = deg2rad($arr_lon);

    // Calcul des écarts angulaires des longitudes et latitudes
    $delta_lat = $arr_lat_rad - $dep_lat_rad;
    $delta_lon = $arr_lon_rad - $dep_lon_rad;

    // Calcul de la distance en utilisant la formule haversine
    $a = sin($delta_lat / 2) * sin($delta_lat / 2) + cos($dep_lat_rad) * cos($arr_lat_rad) * sin($delta_lon / 2) * sin($delta_lon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $distance = $earth_radius * $c;

    return round($distance, 2); // Retourne la distance arrondie à deux décimales
}
?>
