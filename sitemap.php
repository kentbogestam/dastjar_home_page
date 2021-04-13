<?php
   /*  File Name  : site_map.php
   *  Description : Show stors
   *  Author      : Kent
   *  Date        : 18th,April,2020  Creation
   */
//require('config/dbConfig.php');
$SERVER = "dastjardb.cdlnsxaqoaic.eu-west-1.rds.amazonaws.com";
$PORT = "3306";
$DATABASE = "dastjar";
$USER  = "dastjardb";
$PASSWORD  = "Alirezakent1";

function __autoload($class_name) {
    include "classes/".$class_name . '.php';
}

        $conn = mysqli_connect($SERVER, $USER, $PASSWORD, $DATABASE);
            // Check connection
                if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                }
                $query = "SELECT * FROM dastjar.store where s_activ = 1 and not city = 'Oslo'";
                $result = mysqli_query($conn, $query) or die(mysql_error());

	$sitmap = fopen("/var/www/html/wordpress/sitemap.txt", "w") or die("Unable to open file!");
        if (mysqli_num_rows($result) > 0) {
	// Get all URL to our restaurants
        while($row = mysqli_fetch_assoc($result)) {
                $txt ="https://anar.dastjar.com/restro-menu-list/" . $row["store_id"] . "\n";
		fwrite($sitmap, $txt);
        }
        } else {
                echo "0 results";
        }
	fclose($sitmap);
mysqli_close($conn);
?>

