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
}
?>