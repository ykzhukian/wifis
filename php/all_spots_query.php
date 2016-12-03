<!--This file is used to get all the spots latitude and longitude from database and assign them to the javascript 
    arrays, which are used to create the map markers by using the map initialize function(js function) in map.php-->
<?php 
    // link to database
    include 'mySQL.php';
    try {
        $result = $pdo->query('SELECT * FROM spots');

    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
    // declare the arrays
    $name_array = array();
    $address_array = array();
    $suburb_array = array();
    $latitude_array = array(); 
    $longitude_array = array();

    $count = 0;
    // assign the data to php arrays
    foreach ($result as $spot) {
        $name_array[$count] = $spot['Name'];
        $address_array[$count] = $spot['Address'];
        $suburb_array[$count] = $spot['Suburb'];
        $latitude_array[$count] = $spot['Latitude'];
        $longitude_array[$count] = $spot['Longitude'];
        $count++;
    }
?>
<!--Assign them to the javascript variables so that they can be used by js in map creating functions-->
<script>
    // assgin the data from php arrays to js arrays
    var name_array = new Array();
    name_array = <?php echo json_encode($name_array); ?>;
    var address_array = new Array();
    address_array = <?php echo json_encode($address_array); ?>;
    var suburb_array = new Array();
    suburb_array = <?php echo json_encode($suburb_array); ?>;
    var latitude_array = new Array();
    latitude_array = <?php echo json_encode($latitude_array); ?>;
    var longitude_array = new Array();
    longitude_array = <?php echo json_encode($longitude_array); ?>;
</script>