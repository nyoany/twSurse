<?php
class DbUpdatingRace{
	
	function update($data){
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
		$sql = "UPDATE races SET date = '".$data."' WHERE races.id=".$_GET['raceID'].";";
		//echo "<script>alert('".$sql.":00"."');</script>";
		
		if ($conn->query($sql) === TRUE) {
			$result = "Error.";
		} else {
			$result = "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$conn->close();
	}

	function updateRace(){
		if(isset($_POST['submitedButton'])){
			//echo "<script>alert('".$_GET['date']."   ".$_POST['date']."')</script>";
			//echo "<script>alert('".$_GET['time']."   ".$_POST['time']."')</script>";
			$this->update($_POST['date']." ".$_POST['time']);
		}
	}
	
	function getDate($raceID){
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
		
		$sql = "SELECT DATE_FORMAT(date,'%d-%m-%Y') as date FROM races WHERE id='".$raceID."';";
		
		$positions = $conn->query($sql);
		if ($positions->num_rows > 0) {
			 while($row = $positions->fetch_assoc()) {
				$result = $row["date"];
			 }
		}
		
		$conn->close();
		return $result;
	}
	
	function getTime($raceID){
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
		
		$sql = "SELECT DATE_FORMAT(date,'%h:%i:00') as time FROM races WHERE id=".$raceID.";";

		$positions = $conn->query($sql);
		if ($positions->num_rows > 0) {
			 while($row = $positions->fetch_assoc()) {
				$result = $row["time"];
			 }
		}
		
		$conn->close();
		return $result;
	}
	
	function recreateURL(){
		$url="";
		if(isset($_POST['submitedButton'])){
			$this->updateRace();
			
			$url="http://localhost/twSurse/TW/UpdateRace.html?raceID=".$_GET['raceID']."&date=".strval($this->getDate($_GET['raceID']))."&time=".strval($this->getTime($_GET['raceID']));
			header("location:".$url,  true, 303);
		}
		return $url;
	}
}
?>