<?php
if(isset( $_POST['username']))
    $username = $_POST['username'];
if(isset($_POST['post_id']))
    $post_id = $_POST['post_id'];
if(isset($_POST['comment_text']))
    $content = $_POST['comment_text'];

require './sql_connection.php';

if (!$conn) {
    die(print'
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Onito</title>
        </head>
        <body>
            <h1 id="not_found">Adding comment failed</h1>
            <!--<button onclick="history.back()">Back to last known Page</button>-->
            <script>alert("Adding comment failed");history.back()</script>
        </body>
    </html>
    ');
}
//echo "Connected successfully";

//echo $post_id . " post";


$sql = "INSERT INTO TComments (ConID, UseID, CommText)VALUES ('$post_id', '$username', '$content')";
if (mysqli_query($conn, $sql)) {
    die(print'
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Onito</title>
        </head>
        <body>
            <!--<button onclick="history.back()">Back to last known Page</button>-->
            <script>history.back()</script>
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
            <h1 id="not_found">Adding comment failed</h1>
            <!--<button onclick="history.back()">Back to last known Page</button>-->
            <script>alert("Adding comment failed");history.back()</script>
        </body>
    </html>
    ');
}

