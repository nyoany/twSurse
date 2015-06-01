<?php
class CurrentRace{

function getStatus(){
$status = null;
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
		$sql = "SELECT status FROM currentrace;";

		$statusR = $conn->query($sql);
		if ($statusR->num_rows > 0) {
			 while($statusT = $statusR->fetch_assoc()) {
$status = $statusT["status"];
}
}
if($status != "running"){
return "display:none;";
}
return "display:block;";
}

function setEarnedMoney(){



}

}
?>