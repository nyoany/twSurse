<?php

class dbUtils{


function createUser($firstname, $lastname, $birthdate, $email, $username, $password, $safetyword){
$result;
$servername = "localhost";
$dbusername = "root";
$dbpassword = "root";
$dbname = "dball";
// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection to database failed: " . $conn->connect_error);
}
if($this->verifyUserExists($username, $password) != null){

return "A user with the username ".$username." already exists in the system.";
}

$sql = "INSERT INTO users (firstname, lastname, birthdate, email, username, password, safetyword, role)
VALUES ('" .$firstname ."','" .$lastname ."','"
 .$birthdate ."','" .$email ."','" .$username ."', '" .$password ."', '" .$safetyword ."','user')";

if ($conn->query($sql) === TRUE) {
    $result = "You have been added successfully to the site. Please login.";
} else {
    $result = "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
return $result;
}


function verifyUserExists($username, $password){
$result;
$servername = "localhost";
$dbusername = "root";
$dbpassword = "root";
$dbname = "dball";
// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection to database failed: " . $conn->connect_error);
}

$sql ="select role from users where username = '" .$username ."' and password = '" . $password ."';";
$queryr = $conn->query($sql);
if ($queryr->num_rows > 0) {
while($row = $queryr->fetch_assoc()) {
if($row["role"] === "admin"){
return "admin";
}
else if($row["role"]==="user"){
return "user";
}
}
}
else{
$result = null;
}
return $result;
}


function verifyUserIsValid($username, $password, $safetyword, $email){
$result;
$servername = "localhost";
$dbusername = "root";
$dbpassword = "root";
$dbname = "dball";
// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection to database failed: " . $conn->connect_error);
}

$sql ="select * from users where username = '" .$username ."' and password = '" . $password . "' and safetyword = '" .$safetyword ."' and email = '" .$email
."';";
$queryr = $conn->query($sql);
if ($queryr->num_rows > 0) {
$result = "valid";
}
else{
$result = "";
}
return $result;

}
}
?>