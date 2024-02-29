<?php 
include_once 'header.php';
require '../helpers/init_conn_db.php';

if(isset($_POST['del_airlines']) && isset($_SESSION['adminId'])) {
    $plane_id = $_POST['Id_pl'];
    
    // Vérifier si l'avion est utilisé pour un vol
    $sql_check_flight = 'SELECT COUNT(*) FROM Flight WHERE airplane_id=?';
    $stmt_check_flight = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt_check_flight, $sql_check_flight)) {
        header('Location: ../index.php?error=sqlerror');
        exit();            
    }
    
    mysqli_stmt_bind_param($stmt_check_flight, 'i', $plane_id);
    mysqli_stmt_execute($stmt_check_flight);
    mysqli_stmt_store_result($stmt_check_flight);
    
    mysqli_stmt_bind_result($stmt_check_flight, $flight_count);
    mysqli_stmt_fetch($stmt_check_flight);
    
    // Afficher les avions avec les vols associés
    echo "<div>";
    echo "<h2>Plane List</h2>";
    echo "<ul>";
    
    $sql = 'SELECT * FROM plane ORDER BY Id_pl ASC';
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);                
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>";
        echo "ID: " . $row['Id_pl'] . ", Autonomie: " . $row['autonomie'] . ", Nbr places: " . $row['Nbr_place_tot'];
        
        if($flight_count > 0) {
            echo "<span style='color: red;'> (Cet avion est utilisé pour des vols en cours)</span>";
        } else {
            echo "<form action='list_airlines.php' method='post'>";
            echo "<input type='hidden' name='Id_pl' value='" . $row['Id_pl'] . "'>";
            echo "<button type='submit' name='del_airlines'>Delete</button>";
            echo "</form>";
        }
        
        echo "</li>";
    }
    
    echo "</ul>";
    echo "</div>";
}

include_once 'footer.php';
?>