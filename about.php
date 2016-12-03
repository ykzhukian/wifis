
<!--check if open this page directly, SESSION should be declared-->
<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        $_SESSION['user'] = "";
    }
    if (!isset($_SESSION['email'])) {
        $_SESSION['email'] = "Please login";
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Wi-Fi hot spots</title>
    <!--link to the files-->
    <link rel="stylesheet" href="CSS/style.css" type="text/css" />
</head>
<body>
    <!--link to the header-->
    <?php include 'php/header.inc'; ?>
    <section id="content">
        <!--content-->
        <div id="about">
            <p>WiFis makes the way easier for you to find a wi-fi hot spot. You can sign up for an account and post your reviews to share the experience and give feedback.</p>
        </div>
    </section>

    <!--footer-->
    <?php include 'php/footer.inc'; ?>

</body>
</html>