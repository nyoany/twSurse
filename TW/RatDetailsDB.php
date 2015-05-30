<?php

class RatDetails {
	
function getRatName()
{
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
$inter="select name from rats; ";
 
$ratname=$conn->query($inter);
if($ratname->num_rows>0){
	while($row=$ratname->fetch_assoc()){
		$result=$row["name"];
	}
}  
$conn->close();
return $result;
}



function getRatWins()
{
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
$inter="select wins from rats; ";
 
$ratwins=$conn->query($inter);
if($ratwins->num_rows>0){
	while($row=$ratwins->fetch_assoc()){
		$result=$row["wins"];
	}
}  
$conn->close();
return $result;
}

function getRatLoses()
{
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
$inter="select losses from rats where name = '" .$_GET['RatName'] ."';" ;
 
$ratloses=$conn->query($inter);
if($ratloses->num_rows>0){
	while($row=$ratloses->fetch_assoc()){
		$result=$row["losses"];
	}
}  
$conn->close();
return $result;
}



	function getAttendRaces(){
		$index = 1;
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
		
		/*$sql = "Select r.id, DATE_FORMAT(r.date,'%d-%m-%Y') as date, DATE_FORMAT(r.date,'%h:%i:00') as time,
		*/
		$positions = $conn->query($sql);
		if ($positions->num_rows > 0) {
			 while($row = $positions->fetch_assoc()) {
				echo "<tr><td>";
				echo $index;
				echo "</td>";
				
  				echo "<td>";
				echo "<a href='UpdateRace.html?raceID=".strval($row["id"])."'>";
	            echo $row["date"];
				echo "</td>";
				
  				echo "<td>";
	            echo $row["time"];
				echo "</td>";				
				
  				echo "<td>";
	            echo $row["r1"]." - ".$row["r2"];
				echo "</td></tr>";
				$index = $index + 1;
			 }
		}
		
		$conn->close();
	}

} 
?>