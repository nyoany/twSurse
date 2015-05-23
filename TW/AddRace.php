<?php
class DbAddRace{

	function insertRace($date, $participant1, $participant2){
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
		
		$sql = "INSERT INTO races (date, participant1, participant2) VALUES ('".$date ."', (SELECT rats.id from rats where rats.name = '" .$participant1 ."'),(SELECT rats.id from rats where rats.name = '" .$participant2 ."'));";
		echo "<script>alert('".$sql."');</script>";

		if ($conn->query($sql) === TRUE) {
			$result = "Error.";
		} else {
			$result = "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$conn->close();
	}
	
	function updateCota($cota){
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
		
		$sql = "INSERT INTO races (date, participant1, participant2) VALUES ('" .$date ."','" .$participant1 ."','". $participant2 .")";

		if ($conn->query($sql) === TRUE) {
			$result = "Error.";
		} else {
			$result = "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$conn->close();
	}	
	
	function addRace(){

		//echo "<script>alert('".$_POST['date']." ".$_POST["time"].":00"."');</script>";

		$this->insertRace($_POST['date']." ".$_POST["time"],$_POST["participant1"], $_POST["participant2"]);
	}
}
$addNewRace = new DbAddRace();
$addNewRace->addRace();

?>