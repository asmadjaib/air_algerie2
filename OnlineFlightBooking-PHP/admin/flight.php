<?php include_once 'header.php'; ?>
<!-- log on to codeastro.com for more projects -->
<?php include_once 'footer.php'; ?>
<?php require '../helpers/init_conn_db.php'; ?>

<link rel="stylesheet" href="../assets/css/flight_form.css">
<link rel="stylesheet" href="../assets/css/form.css">

<?php if(isset($_SESSION['adminId'])) { ?>
<main>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <?php
            if(isset($_GET['error'])) {
                if($_GET['error'] === 'destless') {
                    echo "<script>alert('Dest. date/time is less than src.');</script>";
                } else if($_GET['error'] === 'sqlerr') {
                    echo "<script>alert('Database error');</script>";
                } else if($_GET['error'] === 'same') {
                    echo "<script>alert('Same city specified in source and destination');</script>";
                }
            }
            ?>
            <div class="bg-light form-out col-md-8">
                <h1 class="text-secondary text-center">ADD FLIGHT DETAILS</h1>

                <form method="POST" class="text-center" action="../includes/admin/flight.inc.php">
                    <div class="form-group row">
                        <label for="source_date" class="col-sm-4 col-form-label">Departure Date</label>
                        <div class="col-sm-8">
                            <input type="date" name="source_date" id="source_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="source_time" class="col-sm-4 col-form-label">Departure Time</label>
                        <div class="col-sm-8">
                            <input type="time" name="source_time" id="source_time" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dest_date" class="col-sm-4 col-form-label">Arrival Date</label>
                        <div class="col-sm-8">
                            <input type="date" name="dest_date" id="dest_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dest_time" class="col-sm-4 col-form-label">Arrival Time</label>
                        <div class="col-sm-8">
                            <input type="time" name="dest_time" id="dest_time" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dep_city" class="col-sm-4 col-form-label">Departure City</label>
                        <div class="col-sm-8">
                            <select name="dep_city" id="dep_city" class="form-control" required>
                                <option value="">Select Departure City</option>
                                <?php
                                $sql = "SELECT * FROM cities";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='".$row['city']."'>".$row['city']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="arr_city" class="col-sm-4 col-form-label">Arrival City</label>
                        <div class="col-sm-8">
                            <select name="arr_city" id="arr_city" class="form-control" required>
                                <option value="">Select Arrival City</option>
                                <?php
                                $sql = "SELECT * FROM cities";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='".$row['city']."'>".$row['city']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="plane" class="col-sm-4 col-form-label">Plane</label>
                        <div class="col-sm-8">
                            <select name="plane" id="plane" class="form-control" required>
                                <option value="">Select Plane</option>
                                <?php
                                $sql = "SELECT * FROM plane";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='".$row['Id_plane']."'>".$row['nom']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="duration" class="col-sm-4 col-form-label">Duration</label>
                        <div class="col-sm-8">
                            <input type="text" name="duration" id="duration" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-4 col-form-label">Price</label>
                        <div class="col-sm-8">
                            <input type="number" name="price" id="price" class="form-control" required>
                        </div>
                    </div>

                    <button name="flight_but" type="submit" class="btn btn-success mt-4 mx-auto d-block">
                        <i class="fa fa-lg fa-arrow-right mr-2"></i> Proceed
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>
<?php } ?>
<script>
    $(document).ready(function(){
        $('.form-control').focus(function(){
            $(this).prev('label').addClass('animate-label');
        });
        $('.form-control').blur(function(){
            if($(this).val() == ''){
                $(this).prev('label').removeClass('animate-label');
            }
        });
    });
</script>
<?php include_once 'footer.php'; ?>
