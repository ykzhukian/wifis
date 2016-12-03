<!--check if open this page directly, SESSION should be declared-->
<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        $_SESSION['user'] = "";
    }
    if (!isset($_SESSION['email'])) {
        $_SESSION['email'] = "Please login";
    }
    if (isset($_GET['keyword'])) {
        $_SESSION['spotName'] = $_GET['keyword'];
    } else {
        // if user goes in this page by address directly without any POST keyword, it will header to home page
        header("location: index.php");
    }
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Item</title>
    <!--link to the css-->
    <link rel="stylesheet" href="CSS/style.css" type="text/css"/>
    <!--link to the js-->
    <script src="javascript/myjs.js"></script>
    <?php
        include 'php/map.php';
        // get keyword from previous page
        $spotName = $_SESSION['spotName'];
        $query = "SELECT * FROM spots WHERE Name LIKE '%".$spotName."%'";
        // get the average rate for this spot
        $average = "SELECT AVG(Rating) as average FROM reviews WHERE SpotName LIKE '%".$spotName."%'";
        $result = $pdo->query($query);
        $average_result = $pdo->query($average);
        // assign the values of this item to local variables
        foreach ($result as $spot) {
            $Name = $spot['Name'];
            $Address = $spot['Address'];
            $Suburb = $spot['Suburb'];
            $Latitude = $spot['Latitude'];
            $Longitude = $spot['Longitude'];
        }
        // assign the average rate to a local variable
        foreach ($average_result as $key) {
            $Average_rate = $key['average'];
        }
        // get the integer value of the average rate, to show this number of stars
        $Average_Int = round($Average_rate);
    ?>
</head>

<body onload="mapInitialize(<?php echo $Latitude; ?>, <?php echo $Longitude; ?>, 'map')">
    <!--header-->
    <?php include 'php/header.inc'; ?>
    <section id="item">
        <!--the position of the user-->
        <span id="title">Searching results > <?php echo $Name; ?> > Specification</span>
        <!--if user wants go back to results page, POST the keyword again in this form to show search results page-->
        <form method="POST" action="results.php" class='postform'>
            <input type="submit" id="goBack" value="Back to searching results"/>
            <?php
                echo "<input class='hidden' type='text' name='search' value='".$_SESSION['search']."' >";
                echo "<input class='hidden' type='text' name='suburb' value='".$_SESSION['suburb']."' >";
            ?>
        </form>

        <div class="item">
            <!--div used to contain a map-->
            <div id="map">Map</div>
            <!--the small logo-->
            <img src="images/wifi.png" width="40px" alt="spot" class="spot_img"/>
            <!--the title of the spot-->
            <p class="spotName"> <?php echo $Name; ?> </p>
            <!--the rate image-->
            <div id="average">Average Rating:</div>
            <?php
                echo "<img src='images/".$Average_Int."_rate.png' class='rating' width='100px' id='item-rating'/>";
            ?>
            <!--link to the review posting part-->
            <div class="notice-item"><p id="distance">(Click marker to check distance)</p><p class="write"><a href="#postReview" name="write">Write a Review</a></p></div>

            <!--the intro of the spot-->
            <p class="synopsis" id="synopsis-single">
                <?php
                    echo $Address;
                    echo "<br />";
                    echo $Suburb;
                ?>
            </p>
        </div>

        <!--reviews-->
        <div class="reviews">
            <h2>Reviews</h2>
            <!--get reviews for specific item from database-->
            <?php
                // link to database
                include "php/mySQL.php";
                // query for getting rows
                $result = $pdo->prepare('SELECT * FROM reviews WHERE SpotName = "'.$spotName.'"');
                $result->execute();
                $count = $result->rowCount();
                // if no reviews for this spot, show following
                if ($count == 0) {
                    echo "<article><h3><span>Post the first review!</span></h3></article>";
                } else {
                    foreach($result as $review) {
                        // create the microdata including info about author, time, rating, content, for every review
                        echo '<script type="application/ld+json">
                            {
                              "@context": "http://fastapps04.qut.edu.au/n9253921/wifis/index.php",
                              "author": "Reviews" + '.json_encode($review["Name"]).',
                              "time": '.json_encode($review["Time"]).',
                              "rating": '.json_encode($review["Rating"]).',
                              "content": '.json_encode($review["Content"]).',
                              }
                            }
                            </script>';
                        // create div for every review, for css to decorate
                        echo "<div></div>";
                        echo "<article><h3><span>".$review['Name']." ( Email Address: ".$review['Email']." )</span>posted on ";
                        echo ''.$review['Time'].'';
                        echo "<img id='rating_in_review' src='images/".$review['Rating']."_rate.png'></h3><p>";
                        echo $review['Content'];
                        echo "</p></article>";
                        
                    }
                }
            ?>
        </div>

        <!--write a review-->
        <div id="post">
            <!--a table contain a form for review posting, first column is label and second is input-->
            <table id="table_post">
                <!--form for the review posting-->
                <?php include 'php/review_post_form.inc'; ?>
            </table>
        </div>
    </section>

    <!--footer-->
    <?php include 'php/footer.inc'; ?>
</body>
<!--creat the meta-data for every spot, including info about link, spot name, image, address and suburb-->
<script type="application/ld+json">
{
  "@context": "http://fastapps04.qut.edu.au/n9253921/wifis/index.php",
  "name": <?php echo json_encode($Name); ?>,
  "image": "http://fastapps04.qut.edu.au/n9253921/wifis/images/logo.png",
  "description": <?php echo json_encode($Address) ?>,
  "suburb": <?php echo json_encode($Suburb) ?>,
  }
}
</script>
</html>