<?php 

class RaceDbUtils{


function getFirstRatPosition(){

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

$selectCurrentPos = "Select firstratposition from currentrace;";

$positions = $conn->query($selectCurrentPos);
if ($positions->num_rows > 0) {
 while($row = $positions->fetch_assoc()) {
$newFvalue= $row["firstratposition"] + rand(1,20);
$updateQ = "update currentrace set firstratposition = '".$newFvalue ."';";

if ($conn->query($updateQ) === TRUE) {
    $result = $newFvalue;
} else {
    $result = null;
	}	
$conn->close();
return $result;
}
}
}


function getSecondRatPosition(){

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

$selectCurrentPos = "Select secondratposition from currentrace;";

$positions = $conn->query($selectCurrentPos);
if ($positions->num_rows > 0) {
 while($row = $positions->fetch_assoc()) {
$newSvalue= $row["secondratposition"]  + rand(1,4);	
$updateQ = "update currentrace set secondratposition = '".$newSvalue ."';";

if ($conn->query($updateQ) === TRUE) {
    $result = $newSvalue;
} else {
    $result = null;
	}	
$conn->close();
return $result;
}
}
}

}
?>