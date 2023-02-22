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
<body>

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
                <li class="active"><a href="#" name="link3">Add Post</a></li>
                <li class=''><a href='?link=4' name='link4'>Own Post</a>
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
        //echo "3";
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
            <h1>New Post</h1>
            <hr>
            <form action="../php/posting.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="username">Username</label>
                    <?php echo "<input type=\"text\" class=\"form-control\" name=\"username\" id=\"username\" value=". $_SESSION["username"] ." readonly>" ?>
                </div>
                <div class="form-group">
                    <label for="file">Email address:</label>
                    <input type="file" class="form-control" name="file_upload" id="file" accept=".png,.jpg,.jpeg,.img,.ico,.gif,.mp3,.wav,.aac,.mp4,.avi,.webm,"> <!--.txt,.pdf were removed because it didnt work for firefox; .mov,.mkv were removed because of the size-->
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" name="description" id="description" required></textarea>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
</div>

<footer class="container-fluid text-center" >
    <p>Footer Text</p>
</footer>
</body>
</html>
