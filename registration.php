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
    <title>Registration</title>
    <!--link to the css-->
    <link rel="stylesheet" href="CSS/style.css" type="text/css" />
    <!--link to the js-->
    <script src="javascript/myjs.js"></script>

</head>
<body>
    <!--link to header-->
    <?php include 'php/header.inc'; ?>
    <section id="create">
        <!--registration-->
        <div id="registration">
            <?php
                $errors = array();
                if (isset($_POST['email']))
                {
                    // link to validation of server part
                    require 'php/registration_form_validation.inc';
                    validateEmail($errors, $_POST, 'email');
                    if ($errors){
                        // link to registration form
                        include 'php/registration_form.inc';
                    }
                    else
                    {
                        // if no errors, insert the new user to database
                        include 'php/insert_user_to_database.php';
                        echo "<div id='successfully_signup'> You have successfully signed up!</div>";
                        echo "<div id='successfully_signup2'><a href='logIn.php'> Log in</a></div>";
                    }

                } else{
                    // link to the registration form
                    include 'php/registration_form.inc';
                }
            ?>
        </div>
    </section>
    <!--footer-->
    <?php include 'php/footer.inc'; ?>
</body>
</html>