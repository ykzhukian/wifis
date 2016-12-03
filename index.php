<!--check if open this page directly, SESSION should be declared-->
<?php
    session_start();
    $_SESSION['searched'] = "";
    if (!isset($_SESSION['user'])) {
        $_SESSION['user'] = "";
    }
    if (!isset($_SESSION['email'])) {
        $_SESSION['email'] = "Please login";
    }
    if (!isset($_SESSION['search'])) {
        $_SESSION['search'] = "";
    }
    if (!isset($_SESSION['suburb'])) {
        $_SESSION['suburb'] = "Please login";
    }
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Wi-Fi hot spots</title>
    <!--link to the css-->
    <link rel="stylesheet" href="CSS/style.css" type="text/css" />
    <!--link to the database-->
    <?php include 'php/map.php'; ?>
    <!--link to js-->
    <script src="javascript/myjs.js"></script>
</head>
<!--call the map when onloading-->
<body onload="homeMapInitialize()">
    <!--link to the header-->
    <?php include 'php/header.inc'; ?>
    <section id="content">
        <!--content-->
        <p id="user-location">Wi-Fi spots around you</p>
        <!--the div for the map in home page-->
        <div id="home-map">
            <!--show Loading before the map comes out-->
            <p> Loading ...</p>
        </div>
    </section>
    <!--footer-->
    <?php include 'php/footer.inc'; ?>
</body>
</html>