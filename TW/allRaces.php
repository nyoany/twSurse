<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
if(isset($_GET['q']) ){
$q = $_GET['q'];
$conn = mysqli_connect('localhost','root','root','dball');
if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}
$without = str_replace('-', '', strval($q));
$year =substr($without,0, 4);
$month =substr($without,4, 2);
$day =substr($without,6, 2);
$sql = "Select r.id as raceID, DATE_FORMAT(r.date,'%d-%m-%Y') as date, DATE_FORMAT(r.date,'%h:%i:00') as time,
 r1.name as r1, r2.name as r2 from races as r, rats as r1, rats as r2 where (r1.id = r.participant1) 
 and (r2.id = r.participant2) and EXTRACT(DAY from r.date) = '".$day."' and EXTRACT(MONTH from r.date) = '".$month."' and EXTRACT(YEAR from r.date) = '"
.$year ."';";
$index = 1;
$races = $conn->query($sql);
		if ($races != null) {
		if($races->num_rows > 0){
		echo"<table id = 'dataTable' class='tabel'>
							<thead>
								<th>Crt</th>
								<th>Date</th>
								<th>Time</th>
								<th>First Participant</th>
								<th>Second Participant</th>
							<thead>
							<tbody>
						";
			 while($row = $races->fetch_assoc()) {
				echo "<tr><td>";
				echo "<a href='raceDetails.html?raceID=".strval($row["raceID"]). "&sessionID=".$_GET['sessionID']."'>";
				echo $index .".";
				echo "</td>";
				
  				echo "<td>";
	            echo $row["date"];
				echo "</td>";
				
  				echo "<td>";
	            echo $row["time"];
				echo "</td>";				
				
  				echo "<td>";
				echo "<a href='RatDetails.html?RatName=".strval($row["r1"])."&Date=".strval($row["date"])."&Time=".strval($row["time"])."&sessionID=".$_GET['sessionID']."'>";
	            echo $row["r1"];
				echo "</td>";
				
				echo "<td>";
				echo "<a href='RatDetails.html?RatName=".strval($row["r2"])."&Date=".strval($row["date"])."&Time=".strval($row["time"])."&sessionID=".$_GET['sessionID']."'>";
	            echo $row["r2"];
				echo "</td></tr>";
				$index = $index + 1;
			 }
			 echo "</tbody>
					</table>";
		}
		}
		
		$conn->close();
		}
?>
</body>
</html>