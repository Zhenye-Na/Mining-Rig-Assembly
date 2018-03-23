<!DOCTYPE html>
<html>
<head>
	<title>
	    Mining Rigs Assembly -- Customize Your Rigs
	</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="main.css"
</head>
<body>
	<nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
    
                <a class="navbar-brand" href="index.php">Mining Rigs Assembly</a>
            </div>

            <div id="navbar" class="collapse navbar-collapse">
              <ul class="nav navbar-nav">
                <li><a href="components.php">All Components</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">

                <?php
                session_start();
            
                if($_SESSION['username']){
                  echo '                  <li><a href="home.php">'.$_SESSION['username'].'</a></li>
                  <li><a href="logout.php">Logout</a></li>';
                }else{
                  echo '                  <li><a href="login.php">Login</a></li>
                  <li><a href="register.php">Register</a></li>';
                }

                // <li><a href="login.php">Login</a></li>
                //  <li><a href="register.php">Register</a></li>
                ?>
              </ul>
            </div>
        </div>
  </nav>