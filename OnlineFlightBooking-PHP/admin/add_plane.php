<?php include_once 'header.php'; ?>

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
                <h1 class="text-secondary text-center">ADD PLANE DETAILS</h1>

                <form method="POST" class="text-center" action="../admin/plane.inc.php">
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="autonomy" class="col-sm-4 col-form-label">Autonomy</label>
                        <div class="col-sm-8">
                            <input type="number" name="autonomy" id="autonomy" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="seats" class="col-sm-4 col-form-label">Number of Seats</label>
                        <div class="col-sm-8">
                            <input type="number" name="seats" id="seats" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="availability" class="col-sm-4 col-form-label">Availability</label>
                        <div class="col-sm-8">
                            <select name="availability" id="availability" class="form-control" required>
                                <option value="Available">Available</option>
                                <option value="Unavailable">Unavailable</option>
                            </select>
                        </div>
                    </div>

                    <button name="plane_but" type="submit" class="btn btn-success mt-4 mx-auto d-block">
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
