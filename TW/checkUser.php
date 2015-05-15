<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "dball";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$sql = "INSERT INTO users (firstname, lastname, birthdate, email, username, password, safetyword, role)
VALUES ('" .$_POST["firstname"] ."','" .$_POST["lastname"] ."','"
 .$_POST["birthdate"]. "','" .$_POST["email"] ."','" .$_POST["username"] ."', '" .$_POST["password"] ."', '" .$_POST["safetyword"] ."','user')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>