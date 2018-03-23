<?php
include('header.php');
?>
    <div class = "row">
        <h1 style = "text-align:center">Sign Up</h1>
        <div style = "width:30%; margin: 25px auto;">
            <form action="register.php" method="post">
                <div class = "form-group">
                    <input class = "form-control" type = "text" name = "email" required = "required" placeholder = "email">
                </div>
                <div class = "form-group">
                    <input class = "form-control" type = "password" name = "password"  required = "required" placeholder = "password">
                </div>
                <div class = "form-group">
                    <input class = "form-control" type = "text" name = "phone" placeholder = "phone">
                </div>
                <div class = "checkbox">
                    <label><input type = "checkbox" name = "subscription" placeholder = "subscription">Subscribe</label>
                </div>
                <div class = "form-group">
                    <button class = "btn btn-lg btn-primary btn-block">Sign Up</button>
                </div>
            </form>
            <a href="index.php">Back to home page</a>
            
        </div>
    </div>


<?php
include('footer.php');
?>

<?php

require('db.php');
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $mysqli->real_escape_string($_POST['email']); // mysqli_real_escape_string($mysqli, $_POST['email'])
    $password = $mysqli->real_escape_string($_POST['password']);
    $phone = $mysqli->real_escape_string($_POST['phone']);
    $subscription = 0;
    if($_POST['subscription'] == "on"){
        $subscription = 1;
    }
    $bool = true;

    
    // mysql_connect("localhost", "rigassembly_admin","jiajunc2") or die(mysql_error()); //Connect to server
    // mysql_select_db("rigassembly_main") or die("Cannot connect to database"); //Connect to database
    // $conn = new mysqli("localhost", "rigassembly_admin","jiajunc2");
    // if ($conn->connect_error) {
    // die("Connection failed: " . $conn->connect_error);
    // } 
    if($result = $mysqli->query("SELECT email FROM account")){
        while($row = mysqli_fetch_array($result)){
            if($row['email'] == $email){
                $bool = false; // sets bool to false
                Print '<script>alert("Email has been registered before!");</script>'; //Prompts the user
                Print '<script>window.location.assign("register.php");</script>'; // redirects to register.php
            }
        }
        $result->close();
    }; //Query the users table
    /**
    while($row = mysql_fetch_array($query)) //display all rows from query
    {
        $table_email = $row['email']; // the first username row is passed on to $table_users, and so on until the query is finished
        if($email == $table_email) // checks if there are any matching fields
        {
            $bool = false; // sets bool to false
            Print '<script>alert("Email has been registered before!");</script>'; //Prompts the user
            Print '<script>window.location.assign("register.php");</script>'; // redirects to register.php
        }
    }
    **/
    if($bool) // checks if bool is true
    {
        $result = $mysqli->query("INSERT INTO `account` (`email`, `password`, `phone`, `subscription`) VALUES ('".$email."','".$password."','".$phone."','".$subscription."');"); //Inserts the value to table users
        if($result){
            $_SESSION['username'] = $email;
            Print '<script>alert("Successfully registered: '.$email.'");</script>'; // Prompts the user
            Print '<script>window.location.assign("home.php");</script>'; // redirects to register.php
        }
        else{
            echo "Registration failed. ". $mysqli->error;
        }
    } 
}
?>
