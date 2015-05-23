<?php
class DbAdminPage{

	function getParticipants(){
		$result;
		$index = 0;
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
		
		$sql = "SELECT name FROM rats;";

		$positions = $conn->query($sql);
		if ($positions->num_rows > 0) {
			 while($row = $positions->fetch_assoc()) {
				$result[$index]= $row["name"];
				$index = $index + 1;
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
		
		$sql = "Select r.id, DATE_FORMAT(r.date,'%d-%m-%Y') as date, DATE_FORMAT(r.date,'%h:%i:00') as time, r1.name as r1, r2.name as r2 from races as r, rats as r1, rats as r2 where (date > curdate()) and (r1.id = r.participant1) and (r2.id = r.participant2);";

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