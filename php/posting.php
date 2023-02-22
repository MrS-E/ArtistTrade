<?php
if(isset( $_POST['username']))
    $user =$_POST['username'];

if($_FILES['file_upload']['tmp_name']){
    $image = base64_encode(file_get_contents($_FILES['file_upload']['tmp_name']));
    $imageFileType = strtolower(pathinfo(basename($_FILES["file_upload"]["name"]), PATHINFO_EXTENSION));
}

if(isset( $_POST['description']))
    $desc = $_POST['description'];

require './sql_connection.php';

if (!$conn) {
    die("<div>Connection failed: " . mysqli_connect_error() . "</div> <script>history.back()</script>");
}

$sql = "select CreatID from taccountscreater where CreatUsername = '$user';";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $userID = $row["CreatID"];
    //echo $row["CreatID"]. "<br>";
} else {
    die("<div>User not found</div> <script>history.back()</script>");
}

$sql = "insert into TContributions (CreatID, ConTyp, ConFile, ConDescryption) values('$userID','$imageFileType','$image','$desc');";
if (mysqli_query($conn, $sql)) {
    session_start();
    $_SESSION["username"];
    header("Location: ../sites/account.php");
} else {
    die("<div>Error: " . $sql . "<br>" . mysqli_error($conn) . "</div> <script>history.back()</script>");

}
