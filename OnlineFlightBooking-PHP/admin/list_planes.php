<?php include_once 'header.php'; ?>
<?php include_once 'footer.php'; ?>
<?php require '../helpers/init_conn_db.php';?>
<?php
if(isset($_POST['del_plane']) and isset($_SESSION['adminId'])) {
  $plane_id = $_POST['Id_plane'];
  $sql = 'DELETE FROM plane WHERE Id_plane=?';
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt,$sql)) {
      header('Location: ../index.php?error=sqlerror');
      exit();            
  } else {  
    mysqli_stmt_bind_param($stmt,'i',$plane_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    // header('Location: list_airlines.php');
    echo("<script>alert('Avion supprimé avec succès');</script>");
    echo("<script>location.href = 'list_planes.php';</script>");
    exit();
  }
}
?>
<main>
    <?php if(isset($_SESSION['adminId'])) { ?>
        <div class="container-md mt-2">
            <h1 class="display-4 text-center text-secondary">Plane LIST</h1>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Autonomy</th>
                        <th scope="col">Number of Seats</th>
                        <th scope="col">Availability</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = 'SELECT p.*, IFNULL(f.Id_plane, 0) AS used FROM plane p LEFT JOIN flight f ON p.Id_plane = f.Id_plane ORDER BY p.Id_plane ASC';
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $availability = $row['used'] ? 'Not Available' : 'Available';
                        echo "<tr class='text-center'>
                                <td>".$row['Id_plane']."</td>
                                <td>".$row['nom']."</td>
                                <td>".$row['autonomie']."</td>
                                <td>".$row['Nbr_place_tot']."</td>
                                <td>".$availability."</td>
                                <td>
                                    <form action='list_planes.php' method='post' onsubmit='return confirmDelete()'>
                                        <input type='hidden' name='Id_plane' value='".$row['Id_plane']."'>
                                        <button class='btn' type='submit' name='del_plane'>
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
        return confirm("Are you sure you want to delete this plane?");
    }
</script>
