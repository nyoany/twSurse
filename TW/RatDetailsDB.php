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
$inter="select wins from rats where name = '" .$_GET['RatName'] ."';";
 
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
		
        
			     $sql="select date, name from races, rats where winner is not NULL and (races.participant1 = (select id from rats r where r.name = '".$_GET['RatName']."') or races.participant2 = (select id from rats r where r.name = '".$_GET['RatName']."')) and rats.name = '".$_GET['RatName']."';" ;

		
		$positions = $conn->query($sql);
		if ($positions->num_rows > 0) {
			 while($row = $positions->fetch_assoc()) {
				echo "<tr><td>";
				echo $index;
				echo "</td>";
				
  				echo "<td>";
	            echo $row["date"];
				echo "</td>";
				
  				echo "<td>";
	            if ($row["name"] == $_GET['RatName']){
					echo "Won";
				}else {
					echo "Lost";
				}
				echo "</td></tr>";		
				$index = $index + 1;
			 }
		}
		
		$conn->close();
}
	
	
	function getTodayRaces(){
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
		
        $sql = "select r.id as raceID, r.date as date, concat( ra.name, ' - ', r.cota1) as participant1, concat( rs.name, ' - ', r.cota2) as participant2 from races r, rats ra, rats rs where ra.id = r.participant1 and rs.id = r.participant2 and day(r.date) = day(curdate());";
		$positions = $conn->query($sql);
		if ($positions->num_rows > 0) {
			 while($row = $positions->fetch_assoc()) {
				echo "<tr><td>";
				echo $index;
				echo "</td>";
				
  				echo "<td>";
								echo "<a href='raceDetails.html?sessionID=". $_GET["sessionID"] . "&raceID=" .$row["raceID"]."'>" ;

	            echo $row["date"];
				echo "</td>";
				
  				echo "<td>";
	            echo $row["participant1"];
				echo "</td>";
				
				echo "<td>";
	            echo $row["participant2"];
				echo "</td>";
							
			 }
		}
		
		$conn->close();
	}
	
	function getYourBets(){
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
		
        
		$sql = "select ra.date , rs.name, b.amount, b.earnings from races ra, rats rs, bets b where b.userID= (select id from users where sessionid = ".$_GET['sessionID'].") and ra.id = b.raceID and b.ratID = rs.id;";
		
		
		$positions = $conn->query($sql);
		if ($positions->num_rows > 0) {
			 while($row = $positions->fetch_assoc()) {
				echo "<tr><td>";
				echo $index;
				echo "</td>";
				
  				echo "<td>";
	            echo $row["date"];
				echo "</td>";
				
  				echo "<td>";
	            echo $row["name"];
				echo "</td>";
				
				echo "<td>";
	            echo $row["amount"];
				echo "</td>";
				
				echo "<td>";
	            echo $row["earnings"];
				echo "</td>";
							
			 }
		}
		
		$conn->close();
	}
		}
	?>