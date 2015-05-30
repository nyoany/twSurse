<?php
class DbUpdateRace{

	function getParticipants($participant){
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
		
		$sql = "select rats.name from rats where rats.id = (select ".$participant." from races where ".$_GET['raceID']." = races.id);";

		$positions = $conn->query($sql);
		if ($positions->num_rows > 0) {
			 while($row = $positions->fetch_assoc()) {
				$result = $row["name"];
			 }
		}
		
		$conn->close();
		return $result;
	}
	
	function getCota($cota){
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
		
		$sql = "select ".$cota." from races where id = ".$_GET['raceID'].";";

		$positions = $conn->query($sql);
		if ($positions->num_rows > 0) {
			 while($row = $positions->fetch_assoc()) {
				$result = $row[$cota];
			 }
		}
		
		$conn->close();
		return $result;
	}
	

	
	
	
	
	function getActiveRaces(){
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
		
		$sql = "SELECT u.userName as userName, b.amount as amountBet, r.name as ratName 
				FROM users u, bets b, rats r 
				WHERE b.userID = u.id
				AND b.raceID = ".$_GET['raceID']."
				AND b.ratID = r.id;";
		
		$positions = $conn->query($sql);
		if ($positions->num_rows > 0) {
			 while($row = $positions->fetch_assoc()) {
				echo "<tr><td>";
				echo $index;
				echo "</td>";
				
  				echo "<td>";
	            echo $row["userName"];
				echo "</td>";
				
  				echo "<td>";
	            echo $row["amountBet"];
				echo "</td>";				
				
  				echo "<td>";
	            echo $row["ratName"];
				echo "</td></tr>";
				$index = $index + 1;
			 }
		}
		
		$conn->close();
	}
}
?>