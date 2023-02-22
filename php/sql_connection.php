<?php
$servername = "localhost";
$username = "all_user";
$password = "af928ioahfiuodhiuoe012390qufhuiglvtzff()/=)hzguhaodifguo";
$database = "Onito_DB";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("<div>Connection failed: " . mysqli_connect_error() . "</div><script>history.back()</script>");
}
//echo "Connected successfully";