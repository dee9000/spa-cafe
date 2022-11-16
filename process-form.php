<?php
//create variable for each value we are interested in taking the value from the post array using their indexes
$name = $_POST["name"];
$email = $_POST["email"];
$rate_your_experience = filter_input(INPUT_POST, "rate_your_experience", FILTER_VALIDATE_INT); //filter input to convert data to int from string
$name_of_staff = $_POST["name_of_staff"];
$rate_service_staff = filter_input(INPUT_POST, "rate_service_staff", FILTER_VALIDATE_INT);
$feedback = $_POST["feedback"];
$terms = filter_input(INPUT_POST, "terms", FILTER_VALIDATE_BOOLEAN);



//cant move forward until check box is ticked for Name
if(empty($_POST["name"])) {
  die("Name is required");
}
//cant move forward until valid email
if(! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
  die("Valid email is required");
}



//cant move forward until check box is ticked for Terms
if(!$terms){
  die("Please tick accepted terms and conditions");
}

//link to the database credentials
$host = "localhost"; //webserver
$dbname = "spa_cafe_feedback"; //name of dbase
$username = "spa";// we connect using the root account on the dbase when dev locally
$password = "";



//connection to the database several methods none of these worked for me
//mysqli_connect($host, $dbase, $username, $password); //ideally should be in this order or else use method below
/*$conn = mysqli_connect(hostname: $host,
                       username: $username,
                       database: $dbase
                       password: $password);*/


//CONNECTION TO DBASE only this worked
$conn = mysqli_connect("localhost", "spa", "", "spa_cafe_feedback");



//test to ensure you are Connected
if($conn === false){
  die("ERROR: Could not connect. "
    . mysqli_connect_error());
}


//connection to insert into dbase table
$sql = "INSERT INTO feedbacks (name, email, rate_your_experience, name_of_staff, rate_service_staff, feedback)
        VALUES ('$name', '$email', '$rate_your_experience', '$name_of_staff', '$rate_service_staff', '$feedback')";



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
