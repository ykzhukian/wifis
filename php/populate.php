<!--populate window for the suburb searching input-->
<?php
    // link to database
    include 'mySQL.php';
    try {
        // get the matching suburbs if exist
        $result = $pdo->query('SELECT Suburb FROM spots WHERE Suburb LIKE "%'.$_GET['keyword'].'%" ');

    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
    $count = 0;
    foreach($result as $suburb){
        if($count == 0){
            // div contains every matching suburbs
            echo "<div class='result result-top' onclick='hideResult(".$count.");'id='result".$count."'>".$suburb['Suburb']."</div>";
        } else if($count < 10 && $count > 0) {
            echo "<div class='result' onclick='hideResult(".$count.");'id='result".$count."'>".$suburb['Suburb']."</div>";
        }
        $count++;
    }
?>