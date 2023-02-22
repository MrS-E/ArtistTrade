<?php
session_start();
if(!isset($_SESSION["username"])) {
    header("Location: ./account.php");
    exit;
}
$user = $_SESSION["username"];

require '../php/sql_connection.php';

$sql = "select CreatID from taccountscreater where CreatUsername = '$user';";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Onito</title>
    <meta charset="utf-8">
    <meta name="description" content="Website for supporting in artists.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body onload="load_content()">
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Onito</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class=""><a href="?link=1" name="link1">Home</a></li>
                <li class=""><a href="?link=2" name="link2">View Posts</a></li>
                <li class=""><a href="?link=3" name="link3">Add Post</a></li>
                <li class='active'><a href='#' name='link4'>Own Post</a><!--TODO + delete-->
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="?link=5" name="link5"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<?php
if(isset($_GET['link'])){
    $link=$_GET['link'];
    if ($link == '1'){
        session_start();
        $_SESSION["username"];
        header("Location: ./account.php");
    }
    if ($link == '2'){
        session_start();
        $_SESSION["username"];
        header("Location: ./view_post.php");
    }
    if ($link == '3'){
        session_start();
        $_SESSION["username"];
        header("Location: ./new_post.php");
    }
    if ($link == '4'){

    }
    if ($link == '5'){
        session_abort();
        $_SESSION["username"] = "logout";
        header("Location: ../log.php");
        exit;
    }
}
?>

<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-12 text-left">
            <h1>Own Posts</h1>
            <hr>
            <div id="posts">
            </div>
            <div>
                <!--TODO load animation-->
            </div>
        </div>
    </div>
</div>

<footer class="container-fluid text-center" >
    <p>Footer Text</p>
</footer>
<script>
    function load_content(){
        var user;
        console.log("load_content");
        var text = document.getElementById("posts");
        if(text.innerText=="Nothing to see here ;-)"){
            text.innerText = "";
        }
        <?php echo "user = \"" . $_SESSION["username"]."\";\n"?>
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "../php/own_content.php?user="+user, true);
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                text.innerHTML += this.responseText;
                console.log(this.responseText);
            } else {
                console.error("Connection failed");
            }
        };
        xmlhttp.send();
    }

    var comments_visable = false;
    function comment(id){
        console.log("show comments for post " + id);
        var text = document.getElementById(id+"_comment");
        if(comments_visable==false) {
            comments_visable=true;
            console.log("load_comments");
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "../php/own_content_comments.php?id=" + id, true);
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    text.innerHTML = this.responseText;
                    console.log(this.responseText);
                } else {
                    console.error("Connection failed");
                }
            };
            xmlhttp.send();
            console.log("done comments post " + id);
        }else{
            comments_visable=false;
            text.innerHTML="";
        }
    }

    function delete_post(id){
        console.log("deleting " + id);
        var text = document.getElementById(id);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "../php/deleting_content.php?typ=post&id=" + id, true);
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                text.innerHTML = this.responseText;
                console.log(this.responseText);
            } else {
                console.error("Connection failed");
            }
        };
        xmlhttp.send();
        console.log("done deleting post " + id);
    }


    function delete_comment(id){
        console.log("deleting comment " + id);
        var text = document.getElementById(id+"_comment");var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "../php/deleting_content.php?typ=comment&id=" + id, true);
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                text.innerHTML = this.responseText;
                console.log(this.responseText);
            } else {
                console.error("Connection failed");
            }
        };
        xmlhttp.send();
        console.log("done deleting comment " + id);
    }
</script>
</body>
</html>