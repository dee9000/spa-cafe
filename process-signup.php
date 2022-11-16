<?php
//create variable for each value we are interested in taking the value from the post array using their indexes
$name = $_POST["name"];
$email = $_POST["email"];



//link to the database credentials
$host = "localhost"; //webserver
$dbname = "spa_cafe_feedback"; //name of dbase
$username = "spa";// we connect using the root account on the dbase when dev locally
$password = "";

//CONNECTION TO DBASE only this worked
$conn = mysqli_connect("localhost", "spa", "", "spa_cafe_feedback");


//test to ensure you are Connected
if($conn === false){
  die("ERROR: Could not connect. "
    . mysqli_connect_error());
}




//validate name to make sure that name is required
if(empty($_POST["name"])){
  die("name is required");
}
//validate email to make sure that email is required
if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
  die("email is required");
}
//validate password strlen to make sure that strlen is number of characters required
if(strlen($_POST["password"]) < 8){
  die("password must be at least 8 characters");
}
//password must contain at least one letter
if(!preg_match("/[a-z]/i", $_POST["password"])){
  die("password must contain at least one letter");
}
//password must contain at least one number
if(!preg_match("/[0-9]/", $_POST["password"])){
  die("password must contain at least one letter");
}

//validate password to password confirmation field
if($_POST["password"] !== $_POST["password_confirmation"]){
  die("passwords must match");
}
//password hash function is used to save passwords and convert them to random stuff to hide from attackers for further security as people reuse passwords all the time on differnet sites, the attacker could use credentials to log into other sites too
//so we want to pass the password data into the hash function and assign it to a variable
//ensure to assign to a variable
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
//$mysqli = require __DIR__ . "/database.php"; //connect to the database.php page and assign to a variable

//connection to insert into dbase table
$sql = "INSERT INTO user (name, email, password_hash)
        VALUES ('$name', '$email','$password_hash')";


        //confirmation

        if(mysqli_query($conn, $sql)){
          echo "<h3>data stored in a database successfully."
            . " Please browse your localhost php my admin"
            . " to view the updated data</h3>";
        } else{
          echo "ERROR: Hush! Sorry $sql. "
            . mysqli_error($conn);
        }

        // Close connection
        mysqli_close($conn);















?>
