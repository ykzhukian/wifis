<!--check if open this page directly, SESSION should be declared-->
<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        $_SESSION['user'] = "";
    }
    if (!isset($_SESSION['email'])) {
        $_SESSION['email'] = "Please login";
    }
    if (isset($_POST['search'])) {
        $_SESSION['search'] = $_POST['search'];
        $_SESSION['suburb'] = $_POST['suburb'];
    } else {
        // if user goes in this page by address directly without any POST keyword, it will header to home page
        header("location: index.php");
    }

?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Search Results</title>
    <!--link to the css-->
    <link rel="stylesheet" href="CSS/style.css" type="text/css" />
    <!--link to the js-->
    <script src="javascript/myjs.js"></script>
    <?php
        // if no matching results, declare null Longitude and Latitude
        $Longitude = null;
        $Latitude = null;
        include 'php/mySQL.php';
        // get the spots which contain the searching keyword
        $result1 = $pdo->query('SELECT * FROM spots WHERE Name LIKE "%'.$_POST['search'].'%" AND Suburb LIKE "%'.$_POST['suburb'].'%"');
        $count1 = 0;
        // assign the results into variable
        foreach($result1 as $spot) {
            if ($count1 == 0) {
                $Longitude = $spot['Longitude'];
                $Latitude = $spot['Latitude'];
            }
            $count1++;
    }
    ?>
</head>

<!--load the map when page's loading-->
<body onload="mapInitialize(<?php echo $Latitude; ?>, <?php echo $Longitude; ?>, 'results-map');">
    <!--link to header-->
    <?php include 'php/header.inc'; ?>
    <section id="results">
        <?php
            echo "<span id='title'> Searching results > ".$_POST['search']." in ".$_POST['suburb']."</span><br />";
            echo "<span id='notice'> Click Marker to show details</span>";
            // map div, show error when nothing has matched, else show the most matching result on the map
            echo "<div id='results-map'><br /><h1>Sorry, Nothing has been found!</h1></div>";
            // get the info of the matching results from database
            $result2 = $pdo->query('SELECT * FROM spots WHERE Name LIKE "%'.$_POST['search'].'%" AND Suburb LIKE "%'.$_POST['suburb'].'%"');
            foreach($result2 as $spot) {
                // create the list of searching results in separate divs
                echo "<div class='results-div'> ";
                echo "<img src='images/wifi.png' width='200px' class='spot_img'/>";
                echo "<a href='item.php?keyword=".$spot['Name']."' name='".$spot['Name']."'><p class='spotName' id='".$spot['Name']."'>";
                echo $spot['Name'];
                echo "</p></a>";
                echo "<p class='synopsis' id='synopsis1'>";
                echo "".$spot['Address']."";
                echo "</p>";
                echo "</div>";
            }
        ?>
    </section>
    <!--footer-->
    <?php include 'php/footer.inc'; ?>

</body>
<?php
    // some functions used in this page
    include "php/all_spots_query.php";
    include "php/map.php";
?>

</html>

