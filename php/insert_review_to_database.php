<?php
    // query used to insert new reviews to database, once after the user posting some reviews
    $keywordBack = $_POST['spotName'];
    // link to database
    include 'mySQL.php';
    $sql = "INSERT INTO reviews ( SpotName, Name, Email, Rating, Content, Time) VALUES (:spot,:name,:email,:rating,:content,:time)";
    $q = $pdo->prepare($sql);
    $q->execute(array(':spot'=>$_POST['spotName'],
        ':name'=>$_POST['name'],
        ':email'=>$_POST['email'],
        ':rating'=>$_POST['rating'],
        ':content'=>$_POST['comment'],
        ':time'=>$_POST['time'],
    ));
    // reload the item page after posting the review, so the new review will show 
    header('Location: ../item.php?keyword='.$keywordBack.'');
?>