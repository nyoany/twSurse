<?php
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
		
		$sql = "SELECT name FROM rats WHERE name != '".$_GET['q']."';";
		echo "<script>alert('".$sql."')</script>";
		$positions = $conn->query($sql);
		if ($positions->num_rows > 0) {
			 while($row = $positions->fetch_assoc()) {
				$result[$index]= $row["name"];
				$index = $index + 1;
			 }
		}
		echo "<option>"." "."</option>";
		foreach ($result as $participant)
			{
				echo "<option>".$participant."</option>";
			}
		$conn->close();
?>