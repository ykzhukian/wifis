<!--two functions used to check the validatoin of login form on server side-->
<?php
    // check if the Email has been signed up
    function validateEmail(&$errors, $field_list, $field_name) {
        $pdo = new PDO('mysql:host=localhost;dbname=kianzykc_wifis','kianzykc','Kian1214@');
        $result = $pdo->prepare('SELECT * FROM users WHERE Email = "'.$field_list['email'].'"');
        $result->execute();
        $count = $result->rowCount();
        if ($count == 0) {
            $errors[$field_name] = 'Email has not been signed up';
        }
    }
    // check if the password is correct
    function validatePassword(&$errors, $field_list, $field_name) {
        $pdo = new PDO('mysql:host=localhost;dbname=kianzykc_wifis','kianzykc','Kian1214@');
        $result = $pdo->prepare('SELECT * FROM users WHERE Email = "'.$field_list['email'].'"');
        $result->execute();
        $count = $result->rowCount();
        if ($count == 1) {
            foreach ( $result as $user) {
                if ($user['Password'] != $field_list[$field_name]) {
                    $errors[$field_name] = 'Wrong Password';
                }
            }
        }


    }
?>