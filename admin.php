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
    <!--link to the files-->
    <link rel="stylesheet" href="CSS/style.css" type="text/css" />
    <script src="javascript/myjs.js"></script>
    <?php include 'php/mySQL.php'; ?>

</head>
<body>
    <!--link to header-->
    <?php include 'php/header.inc'; ?>
        <section id="content">
            <!--content-->
            <p id="upload">Upload the CSV file here</p>
            <div id="admin-div">
                <table id="admin_table">
                    <!--form used to post the csv file-->
                    <form method="post" enctype="multipart/form-data">
                        <tr>
                            <td class="admin_td">Select CSV File </td>
                            <!--input the file here-->
                            <td class="admin_td"><input type="file" name="file" id="file" required/></td>
                        </tr>
                        <tr>
                            <td class="admin_td">Submit</td>
                            <td><input type="submit" name="submit" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="admin_td">Please make sure the spots.csv file is separated by comma</td>
                        </tr>
                    </form>
                </table>

                <!--insert data from the csv file to the spots table in database-->
                <?php
                if(isset($_POST["submit"])){
                    //to deal with mac
                    ini_set('auto_detect_line_endings',TRUE);
                    //read file
                    $filename = $_FILES['file']['tmp_name'];
                    $row = 0;
                    if (($handle = fopen($filename, "r")) !== FALSE) {
                        // the rows are already there, so clear the table before insert again
                        $query_empty = "TRUNCATE TABLE spots";
                        $p = $pdo->query($query_empty);
                        // separate the data by "," and "" for the string with an extra ","
                        while (($data = fgetcsv($handle, 1000, ",", '"')) !== FALSE) {
                            $num = count($data);
                            $row++;
                            for ($c=0; $c < $num; $c = $c + 5) {
                                $result = $data;
                                // skip the first row, cause it's the column name
                                if($row >= 1){
                                    $name = $result[0];             // assign the value of every column of every row to a local variable
                                    $address = $result[1];
                                    $suburb = $result[2];
                                    $latitude = $result[3];
                                    $longitude = $result[4];
                                    // query for insert the rows
                                    $query_import = "INSERT INTO spots (Name, Address, Suburb, Latitude, Longitude) VALUES (:name,:address,:suburb,:latitude,:longitude)";
                                    $q = $pdo->prepare($query_import);
                                    $q->execute(array(':name'=>$name,
                                        ':address'=>$address,
                                        ':suburb'=>$suburb,
                                        ':latitude'=>$latitude,
                                        ':longitude'=>$longitude,
                                    ));
                                }
                            }
                        }
                        fclose($handle);
                        // show the result
                        echo "<h3>Successfully Uploaded!</h3>";
                    }
                }
                ?>
            </div>
        </section>
    <!--footer-->
    <?php include 'php/footer.inc'; ?>

</body>
</html>