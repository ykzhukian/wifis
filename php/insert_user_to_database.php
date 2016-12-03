<?php
	// link to database
    include 'mySQL.php';
    // query used to insert new user to database, once after the registration validation has passed
    $sql = "INSERT INTO users (LastName,FirstName, Email, Password) VALUES (:lname,:fname,:email,:password)";
    $q = $pdo->prepare($sql);
    $q->execute(array(':lname'=>$_POST['lastName'],
        ':fname'=>$_POST['firstName'],
        ':email'=>$_POST['email'],
        ':password'=>$_POST['password'],
));
?>