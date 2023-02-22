<?php
//TODO mayby get error messages into login page and not like now as there own sites.
//get form imput
if(isset( $_POST['email_login']))
    $email = $_POST['email_login'];
if(isset( $_POST['pwd_login']))
    $pwd = $_POST['pwd_login'];
$pwd_hash = hash('sha256', $pwd);


require './sql_connection.php';

// Check connection
if (!$conn) {
    die(print'
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Onito</title>
        </head>
        <body>
            <h1 id="not_found">444 Connection to Loginsystem could not be established</h1>
            <!--<button onclick="history.back()">Back to last known Page</button>-->
            <script>alert("444 Connection to Loginsystem could not be established");history.back()</script>
        </body>
    </html>
    ');
    //die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";

//Select 1
$sql = "SELECT CreatPasswd, CreatUsername FROM TAccountsCreater WHERE CreatEMail = '$email';";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        if($row["CreatPasswd"]==$pwd_hash){
            session_start();
            $_SESSION["username"] = $row["CreatUsername"];
            header("Location: ../sites/account.php");
        }
    }
    die(print'
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Onito</title>
        </head>
        <body>
            <h1 id="not_found">Login failed</h1>
            <!--<button onclick="history.back()">Back to last known Page</button>-->
            <script>alert("Login failed");history.back()</script>
        </body>
    </html>
    ');
} else {
    //echo "0 results";
}

//Select 2
$sql = "SELECT UsePasswd, UseUsername FROM TAccountsUser WHERE UseEMail = '$email';";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        if($row["UsePasswd"]==$pwd_hash){
            session_start();
            $_SESSION["username"] = $row["UseUsername"];
            header("Location: ../sites/account.php");
        }
    }
    die(print'
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Onito</title>
        </head>
        <body>
            <h1 id="not_found">Login failed</h1>
            <!--<button onclick="history.back()">Back to last known Page</button>-->
            <script>alert("Login failed");history.back()</script>
        </body>
    </html>
    ');
} else {
    //echo "0 results";
}

die(print'
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Onito</title>
        </head>
        <body>
            <h1 id="not_found">Login failed</h1>
            <!--<button onclick="history.back()">Back to last known Page</button>-->
            <script>alert("Login failed");history.back()</script>
        </body>
    </html>
    ');

?>