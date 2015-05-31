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
$result = null;
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
$result = "admin";
}
else if($row["role"]==="user"){
$result = "user";
}
else{
$result = null;
}
}
}
return $result;
}

function updateSessionId($username, $password){

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

$sessionID = rand();
$loggedinQ ="update users set sessionID = ".$sessionID." where username = '" .$username ."' and password = '" . $password ."';";
$conn->query($loggedinQ);
return $sessionID;
}


function verifyUserIsValid($username,$safetyword, $email){
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

$sql ="select password from users where username = '" .$username ."' and safetyword = '" .$safetyword ."' and email = '" .$email."';";
$queryr = $conn->query($sql);
if ($queryr->num_rows > 0) {
while($row = $queryr->fetch_assoc()) {
$result = $row["password"];
}
}
else{
$result = null;
}
return $result;

}

function verifyRaceStart(){

$conn = mysqli_connect('localhost','root','root','dball');
if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

$sql = "Select r.id as raceID, DATE_FORMAT(r.date,'%d-%m-%Y') as date, DATE_FORMAT(r.date,'%h:%i:00') as time,
 r1.name as r1, r2.name as r2 from races as r, rats as r1, rats as r2 where (r1.id = r.participant1) 
 and (r2.id = r.participant2) and EXTRACT(DAY from r.date) = '".$day."' and EXTRACT(MONTH from r.date) = '".$month."' and EXTRACT(YEAR from r.date) = '"
.$year ."';";

}

}
?>