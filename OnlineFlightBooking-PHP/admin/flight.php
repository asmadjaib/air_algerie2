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
                    echo "<div class='alert alert-danger' role='alert'>Destination date/time is less than source.</div>";
                } else if($_GET['error'] === 'sqlerr') {
                    echo "<div class='alert alert-danger' role='alert'>Database error</div>";
                } else if($_GET['error'] === 'same') {
                    echo "<div class='alert alert-danger' role='alert'>Same city specified in source and destination</div>";
                } else if($_GET['error'] === 'autonomy') {
                    echo "<div class='alert alert-danger' role='alert'>The autonomy of the selected plane is insufficient for the distance to be traveled</div>";
                } else if($_GET['error'] === 'planeinflight') {
                    echo "<div class='alert alert-danger' role='alert'>The selected plane is already in flight at the scheduled departure time</div>";
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
                   <!-- <div class="form-group row">
                        <label for="duration" class="col-sm-4 col-form-label">Duration</label>
                        <div class="col-sm-8">
                            <input type="text" name="duration" id="duration" class="form-control" required>
                        </div>
                    </div>-->
                    <div class="form-group row">
                        <label for="price" class="col-sm-4 col-form-label">Price</label>
                        <div class="col-sm-8">
                            <input type="number" name="price" id="price" class="form-control" required>
                        </div>
                    </div>
                    <!-- Champ pour afficher la distance calculée
                    <div class="form-group row">
                        <label for="distance" class="col-sm-4 col-form-label">Distance (km)</label>
                        <div class="col-sm-8">
                            <input type="text" name="distance" id="distance" class="form-control" readonly>
                        </div> 
                    </div>-->

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

    // Fonction pour calculer la distance haversine entre deux points géographiques
    function calculateDistance(lat1, lon1, lat2, lon2) {
        const earthRadius = 6371; // Rayon de la Terre en kilomètres

        // Convertir les latitudes et longitudes en radians
        const dLat = toRadians(lat2 - lat1);
        const dLon = toRadians(lon2 - lon1);
        const lat1Rad = toRadians(lat1);
        const lat2Rad = toRadians(lat2);

        // Formule haversine pour calculer la distance
        const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                  Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(lat1Rad) * Math.cos(lat2Rad);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        // Distance en kilomètres
        const distance = earthRadius * c;
        return distance.toFixed(2); // Retourne la distance arrondie à deux décimales
    }

    // Lorsque les villes de départ et d'arrivée sont sélectionnées
    $('#dep_city, #arr_city').change(function() {
        const depCity = $('#dep_city').val();
        const arrCity = $('#arr_city').val();
        
        // Obtenez les coordonnées des villes sélectionnées
        const depCoordinates = getCoordinates(depCity);
        const arrCoordinates = getCoordinates(arrCity);
        
        // Si les coordonnées sont disponibles pour les deux villes
        if (depCoordinates && arrCoordinates) {
            const depLat = depCoordinates.lat;
            const depLon = depCoordinates.lon;
            const arrLat = arrCoordinates.lat;
            const arrLon = arrCoordinates.lon;
            
            // Calculez la distance entre les deux villes
            const distance = calculateDistance(depLat, depLon, arrLat, arrLon);
            
            // Mettez à jour le champ de formulaire avec la distance calculée
            $('#distance').val(distance + ' km');
        }
    });

    // Fonction pour convertir les degrés en radians
    function toRadians(degrees) {
        return degrees * Math.PI / 180;
    }
</script>

<?php include_once 'footer.php'; ?>
