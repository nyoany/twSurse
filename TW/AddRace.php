<?php
class DbAddRace{

	function insertRace($date, $participant1, $participant2, $cota1, $cota2){
		
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
		
		$sql = "INSERT INTO races (date, participant1, participant2, cota1, cota2) VALUES ('".$date ."', (SELECT rats.id from rats where rats.name = '" .$participant1 ."'),(SELECT rats.id from rats where rats.name = '" .$participant2 ."'),'".$cota1 ."','".$cota2 ."');";

		if ($conn->query($sql) === TRUE) {
			$result = "Error.";
		} else {
			$result = "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$conn->close();
	}
	
	function addCota($cota1, $cota2){
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
		
		$sql = "UPDATE races SET cota1=2,cota2=2 WHERE races.id=1;";

		if ($conn->query($sql) === TRUE) {
			$result = "Error.";
		} else {
			$result = "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$conn->close();
	}	
	
	function addRace(){
		if(isset($_POST['submitedButton'])){
		//echo "<script>alert('".$_POST['date']." ".$_POST["time"].":00"."');</script>";

		$this->insertRace($_POST['date']." ".$_POST['time'],$_POST['participant1'], $_POST['participant2'], $_POST['cota1'], $_POST['cota2']);
		}
	}
	
	
}


?>