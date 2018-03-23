<?php
include('header.php');
?>

<div class = "row">
    <h1 style = "text-align:center">Login</h1>
    <div style = "width:30%; margin: 25px auto;">
        <form action="checklogin.php" method="post">
            <div class = "form-group">
                <input class = "form-control" type = "text" name = "email" placeholder = "email"
                required = "required">
            </div>
            <div class = "form-group">
                <input class = "form-control" type = "password" name = "password" placeholder = "password" required = "required">
            </div>
            <div class = "form-group">
                <button class = "btn btn-lg btn-primary btn-block">Login</button>
            </div>
        </form>
        
    </div>
</div>

<?php
include('footer');
?>

