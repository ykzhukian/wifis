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
    <!--link to the database-->
    <?php include 'php/mySQL.php'; ?>
</head>
<body>
    <?php include 'php/header.inc'; ?>

    <section id="create">
        <!--registration-->
        <div id="registration">
            <?php
                // if the user status is login, show Welcome, if not show the login form
                if($_SESSION['user'] == 'in'){
                    echo "<div id='user_login'><p>Welcome!<br><br> Please use the search bar to find a wi-fi spot.</p>
                        </div>";
                } else {
                    $errors = array();
                    if (isset($_POST['email'])) {
                        // link to the validation of login and check the email and password
                        require 'php/log_in_validation.inc';
                        validateEmail($errors, $_POST, 'email');
                        validatePassword($errors, $_POST, 'password');
                        // if the email and password is invalid, show the form and error
                        if ($errors){
                            // link to the login form
                            include 'php/log_in_form.inc';
                            $_SESSION['user'] = "out";
                        } else {
                            // if no errors, change the user status to in, enable the user to POST reviews
                            $_SESSION['user'] = "in";
                            // record the user's email and will automatically fulfill the email part in review form
                            $_SESSION['email'] = $_POST["email"];
                            // reload this page
                            header('Location: logIn.php');
                        }
                    } else{
                        // link to login form
                        include 'php/log_in_form.inc';
                    }
                }
            ?>
        </div>
    </section>
    <!--footer-->
    <?php include 'php/footer.inc'; ?>
</body>
</html>