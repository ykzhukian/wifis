<!--validate if the email in registration form has been already signed up-->
<?php
    function validateEmail(&$errors, $field_list, $field_name) {
        $pdo = new PDO('mysql:host=localhost;dbname=kianzykc_wifis','kianzykc','Kian1214@');
        $result = $pdo->query('SELECT * FROM users');
        foreach ($result as $user) {
            if ($field_list[$field_name] == $user['Email']) {
            	// show the error if the email has been occupied
                $errors[$field_name] = 'This Email has been signed up';
            }
        }
    }
?>
