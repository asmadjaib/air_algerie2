<?php include_once 'header.php'; ?>
<?php include_once 'footer.php'; ?>
<?php require '../helpers/init_conn_db.php';?>

<?php
if(isset($_POST['del_flight']) && isset($_SESSION['adminId'])) {
    $flight_id = $_POST['flight_id'];
    $sql = 'DELETE FROM flight WHERE flight_id=?';
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)) {
        header('Location: ../index.php?error=sqlerror');
        exit();
    } else {
        mysqli_stmt_bind_param($stmt,'i',$flight_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        echo("<script>alert('Vol supprimé avec succès');</script>");
        echo("<script>location.href = 'list_flight.php';</script>");
        exit();
    }
}
?>

<main>
    <?php if(isset($_SESSION['adminId'])) { ?>
        <div class="container-md mt-2">
            <h1 class="display-4 text-center text-secondary">Liste des vols</h1>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID du vol</th>
                        <th scope="col">Départ</th>
                        <th scope="col">Arrivée</th>
                        <th scope="col">Ville de départ</th>
                        <th scope="col">Ville d'arrivée</th>
                        <th scope="col">Durée</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Avion</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = 'SELECT f.*, p.nom AS plane_name FROM flight f LEFT JOIN plane p ON f.id_plane = p.Id_plane ORDER BY f.flight_id ASC';
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr class='text-center'>
                                <td>".$row['flight_id']."</td>
                                <td>".$row['departure']."</td>
                                <td>".$row['arrivale']."</td>
                                <td>".$row['source']."</td>
                                <td>".$row['Destination']."</td>
                                <td>".$row['duration']."</td>
                                <td>".$row['Price']."</td>
                                <td>".$row['plane_name']."</td>
                                <td>
                                    <form action='list_flight.php' method='post' onsubmit='return confirmDelete()'>
                                        <input type='hidden' name='flight_id' value='".$row['flight_id']."'>
                                        <button class='btn' type='submit' name='del_flight'>
                                            <i class='text-danger fa fa-trash'></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</main>

<script>
    function confirmDelete() {
        return confirm("Êtes-vous sûr de vouloir supprimer ce vol ?");
    }
</script>
