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
                    <label><input type = "checkbox" name = "subscribtion" placeholder = "subscribtion">Subscribe</label>
                </div>
                <div class = "form-group">
                    <button class = "btn btn-lg btn-primary btn-block">Sign Up</button>
                </div>
            </form>
            <a href="index.php">Click here to go back</a>
            <a href = "components.php">Back to All Components</a>
        </div>
    </div>


<?php
include('footer.php');
?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = mysql_real_escape_string($_POST['email']);
    $password = mysql_real_escape_string($_POST['password']);
    $phone = mysql_real_escape_string($_POST['phone']);
    $subscribtion = 0;
    if($_POST['subscribtion'] == "on"){
        $subscribtion = 1;
    }
    $bool = true;


    mysql_connect("localhost", "rigassembly_admin","jiajunc2") or die(mysql_error()); //Connect to server
    mysql_select_db("rigassembly_main") or die("Cannot connect to database"); //Connect to database
    // $conn = new mysqli("localhost", "rigassembly_admin","jiajunc2");
    // if ($conn->connect_error) {
    // die("Connection failed: " . $conn->connect_error);
    // } 
    $query = mysql_query("SELECT * FROM `account`"); //Query the users table
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

    if($bool) // checks if bool is true
    {
        mysql_query("INSERT INTO account (email, password, phone, subscribtion) VALUES ('$email','$password','$phone','$subscribtion');"); //Inserts the value to table users
        Print '<script>alert("Successfully registered: '.$_POST['email'].'");</script>'; // Prompts the user
        Print '<script>window.location.assign("home.php");</script>'; // redirects to register.php
    } 
}
?>
