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
$typ_of_user=mysqli_num_rows($result);
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
<body onload="load_content(5,0)" style="height: 110vh">

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
                <li class="active"><a href="#" name="link2">View Posts</a></li>
                <?php
                if (mysqli_num_rows($result) == 1) {
                    echo"<li class=''><a href='?link=3' name='link3'>Add Post</a>";
                    echo"<li class=''><a href='?link=4' name='link4'>Own Post</a>";

                }
                ?>
            </ul> <!--TODO if creater own posts + delete-->
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

    }
    if ($link == '3'){
        session_start();
        $_SESSION["username"];
        header("Location: ./new_post.php");
    }
    if ($link == '4'){
        session_start();
        $_SESSION["username"];
        header("Location: ./own_post.php");
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
            <div>
                <h1>Posts:</h1>
                <div>
                    <h3>Search:</h3>
                    <input id="desc" type="text" placeholder="Description">
                    <input id="user" type="text" placeholder="Username">
                    <select id="typ">
                        <option value="">--</option>
                        <option value="pic">Picture</option>
                        <option value="audio">Audio</option>
                        <option value="video">Video</option>
                        <option value="text">Text</option>
                    </select>
                    <input type="button" value="Search" onclick="search()">
                </div>
            </div>
            <hr>
            <div id="posts">
            </div>
            <div>
                <!--TODO load animation-->
            </div>
        </div>
    </div>
</div>

<footer class="container-fluid text-center">
    <p>Footer Text</p>
</footer>

<div class="modal fade" id="comment" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Add a Comment</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="../php/new_comment.php" method="post">
                    <div id="posts_id_div" class="form-group">
                        <?php
                        require '../php/sql_connection.php';
                        $sql = "select UseID from TAccountsUser where UseUsername=\"".$_SESSION["username"]."\";";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) == 1) {
                            // output data of each row
                            $userid= mysqli_fetch_assoc($result)["UseID"];
                        } else {
                            echo "We can't find your user, please try later again.";
                        }
                        echo "<input type=\"text\" name=\"username\" id=\"username\" value=". $userid ." readonly hidden>" ?>
                    </div>
                    <div class="form-group">
                        <lable for="comment_text" >Comment:</lable>
                        <textarea class="form-control" name="comment_text" id="comment_text" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-default" <?php if(mysqli_num_rows($result) != 1){echo "disabled";} ?>>Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function load_content(q,p){
        for(var x=p+1;x<=q;x++) {
            console.log("load_content");
            var text = document.getElementById("posts");
            if(text.innerText=="Nothing to see here ;-)"){
                text.innerText = "";
            }
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "../php/content.php?q=" + x + "&p=" + (x-1) + "&comm_show", true);
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    text.innerHTML += this.responseText;
                    console.log(this.responseText);
                } else {
                    console.error("Connection failed");
                }
            };
            xmlhttp.send();
            console.log("done " + x);
        }
    }

    function search(){
        var description = document.getElementById("desc").value;
        var username = document.getElementById("user").value;
        var typ = document.getElementById("typ").options[document.getElementById("typ").selectedIndex].value;

        console.log(description + ", " + username + ", " + typ);

        console.log("Searching...");
        var text = document.getElementById("posts");
        text.innerText = "";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "../php/search.php?desc="+description+"&user="+username+"&typ="+typ, true);
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                text.innerHTML += this.responseText;
                console.log(this.responseText);
            } else {
                console.error("Connection failed");
            }
        };
        xmlhttp.send();
        console.log("done searching");
    }

    var comments_visable = false;
    function comment(id){
        var typ;
        console.log("show comments for post " + id);
        var text = document.getElementById(id+"_comment");
        if(comments_visable==false) {
            comments_visable=true;
            console.log("load_comments");
            <?php
            if ($typ_of_user == 1) {
                echo "typ=1;";
            } else {
                echo "typ=0;";
            }
            ?>
            console.log(typ);
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "../php/show_comments.php?id=" + id + "&typ=" + typ, true);
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

    function leave_comment(id){
        console.log("leave comment to post " + id);
        document.getElementById("posts_id_div").innerHTML += "<input type=\"text\" name=\"post_id\" value=\""+id+"\" hidden readonly>";
        $('#comment').modal('show');
        /*
        var newWindow = window.open("", "newWindow", "resizable=yes");
        newWindow.document.write('<p>Pop up window text</p>');*/
    }

    var q = 5;
    var p = 0;
    document.addEventListener('DOMContentLoaded', function(e) {
        document.addEventListener('scroll', function(e) {
            let documentHeight = document.body.scrollHeight;
            let currentScroll = window.scrollY + window.innerHeight;
            // When the user is [modifier]px from the bottom, fire the event.
            let modifier = 200;
            if(currentScroll + modifier > documentHeight) {
                console.log('You are at the bottom!');

                setTimeout(function() {
                    console.log('You are at the bottom!');
                    q += 5;
                    p += 5;
                    load_content(q, p);
                }, 2000);
            }
        });
    });

</script>

</body>
</html>