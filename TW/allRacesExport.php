<?php
if(isset($_GET['q']) ){
$q = $_GET['q'];
$conn = mysqli_connect('localhost','root','root','dball');
if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}
$without = str_replace('-', '', strval($q));
$sql = " Select DATE_FORMAT(r.date,'%d-%m-%Y') as date, DATE_FORMAT(r.date,'%h:%i:00') as time, r1.name as r1, 
 (select count(ratID) from bets where ratId=r.participant1) as b1, r2.name as r2,
 (select count(ratID) from bets where ratId=r.participant2) as b2
     from races as r, rats as r1, rats as r2, bets as b
     where (r1.id = r.participant1) 
	 and (r2.id = r.participant2) and DATE_FORMAT('".$without."','%d-%m-%Y') = DATE_FORMAT(r.date,'%d-%m-%Y');";
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
								<th>Bets for First Participant</th>
								<th>Second Participant</th>
								<th>Bets for Second Participant</th>
							<thead>
							<tbody>
						";
			 while($row = $races->fetch_assoc()) {
				echo "<tr><td>";
				echo $index .".";
				echo "</td>";
				
  				echo "<td>";
	            echo $row["date"];
				echo "</td>";
				
  				echo "<td>";
	            echo $row["time"];
				echo "</td>";				
				
  				echo "<td>";
	            echo $row["r1"];
				echo "</td>";
				
				echo "<td>";
	            echo $row["b1"];
				echo "</td>";
				
				echo "<td>";
	            echo $row["r2"];
				echo "</td>";
				
				echo "<td>";
	            echo $row["b2"];
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