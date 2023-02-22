<?php
//TODO mayby error messages into signup and not as there own sites
if(isset( $_POST['surname_signup']))
    $surname = $_POST['surname_signup'];
if(isset( $_POST['name_signup']))
    $name = $_POST['name_signup'];
if(isset( $_POST['username_signup']))
    $username = $_POST['username_signup'];
if(isset( $_POST['pwd_signup']))
    $pwd = $_POST['pwd_signup'];
    $pwd = hash('sha256', $pwd);
if(isset( $_POST['email_signup']))
    $email = $_POST['email_signup'];
if(isset( $_POST['telefon_signup']))
    $telefon = $_POST['telefon_signup'];
if(isset( $_POST['creator_signup']))
    $creator = $_POST['creator_signup'];
if($creator==true){
    //$typ = $_POST['typ']; //FIXME
    $typ = NULL;
    if(isset( $_POST['description_signup']))
        $desc = $_POST['description_signup'];
    $sql = "INSERT INTO TAccountsCreater (CreatSurname, CreatName, CreatUsername, CreatPasswd, CreatEMail, CreatTelefon, CreatTyp, CreatDescryption)VALUES ('$surname', '$name', '$username', '$pwd', '$email', '$telefon','$typ', '$desc');";
}
else{
    if(isset( $_POST['bithday_signup']))
        $birthday = $_POST['bithday_signup'];
    $sql = "INSERT INTO TAccountsUser (UseSurname, UseName, UseUsername, UsePasswd, UseEMail, UseTelefon, UseBirthday)VALUES ('$surname', '$name', '$username', '$pwd', '$email', '$telefon', '$birthday');";
}

$sql_select1 = "select * from TAccountsUser where UseEmail='$email' or UseUsername='$username';" ;
$sql_select2 = "select * from TAccountsCreater where CreatEmail='$email' or CreatUsername='$username';";

// Create connection
require './sql_connection.php';

$die_444 = "<html><head><meta charset='UTF-8'><title>Onito</title></head><body><h1 id='not_found'>444 Connection to signup system could not be established</h1><!--<button onclick='history.back()'>Back to last known Page</button>--><script>alert('444 Connection to signup system could not be established');history.back()</script></body></html>";
$die_used = "<html><head><meta charset='UTF-8'><title>Onito</title></head><body><h1 id='not_found'>Username is already in use</h1><!--<buttononclick='history.back()'>BacktolastknownPage</button>--><script>alert('Username is already in use');history.back()</script></body></html>";

$result1 = mysqli_query($conn, $sql_select1);
$result2 = mysqli_query($conn, $sql_select2);
if (mysqli_num_rows($result1) > 0 || mysqli_num_rows($result2) > 0) {
    die(print $die_used);
} else {

    // Insert
    if (mysqli_query($conn, $sql)) {
        die(print'
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Onito</title>
        </head>
        <body>
            <h1 id="not_found">User has been created</h1>
            <button onclick="history.back()">Back to last known Page</button>
            <script>alert("User has been created");history.back()</script>
        </body>
    </html>
    ');
    } else {
        die(print'
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Onito</title>
        </head>
        <body>
            <h1 id="not_found">406 Something went wrong while signup</h1>
            <!--<button onclick="history.back()">Back to last known Page</button>-->
            <script>alert("406 Something went wrong while signup");history.back()</script>
        </body>
    </html>
    ');
    }
}
?>