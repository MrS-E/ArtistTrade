<!DOCTYPE html>
<html lang="en">
<head>
  <title>Onito</title>
  <meta charset="utf-8">
  <meta name="description" content="Website for supporting in artists.">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/index.css">
  <link rel="stylesheet" href="./css/log.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="./js/login_signup.js"></script>
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
        <li><a href="index.php">Home</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="log.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <p>SideWindow</p>
    </div>
    <div class="col-sm-8 text-left">
      <div>
        <h1 class="bg-black text-center" id="title_text">Login</h1>
      </div>
      <div class="text-center">
        <button id="login" class="btn btn-primary" onclick="import_login()">Login</button>
        <button id="signup" class="btn btn-default" onclick="import_signup()">Sign up</button> <!--TODO check in signup if both passwords are the same-->
        <p></p>
      </div>
      <div id="form" class="col-sm-12 text-center">
        <form action="php/login.php" method="post">
          <div class="form-group">
            <label for="email_login">Email address:</label>
            <input type="email" class="form-control" name="email_login" id="email_login" placeholder="max.musterman@mail.com" required>
          </div>
          <div class="form-group">
            <label for="pwd_login">Password:</label>
            <input type="password" class="form-control" name="pwd_login" id="pwd_login" required>
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
      </div>
    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        <p>ADS</p>
      </div>
      <div class="well">
        <p>ADS</p>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

</body>
</html>
