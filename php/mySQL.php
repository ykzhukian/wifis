<!--storing the database linking details-->
<?php
	// create a new pdo for using query 
    $pdo = new PDO('mysql:host=localhost;dbname=kianzykc_wifis','kianzykc','Kian1214@');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
