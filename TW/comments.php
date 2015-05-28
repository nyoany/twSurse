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
if(isset($_GET['c'])){
$q = $_GET['c'];
$conn = mysqli_connect('localhost','root','root','dball');
if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}
$without = str_replace('-', '', strval($q));
$year =substr($without,0, 4);
$month =substr($without,4, 2);
$day =substr($without,6, 2);
$sql = "Select c.comentary, r.id, DATE_FORMAT(r.date,'%d-%m-%Y') as date, DATE_FORMAT(r.date,'%h:%i:00') as time,
 r1.name as r1, r2.name as r2 from comentaries as c, races as r, rats as r1, rats as r2 where (r1.id = r.participant1) 
 and (r2.id = r.participant2) and EXTRACT(DAY from r.date) = '".$day."' and EXTRACT(MONTH from r.date) = '".$month."' and EXTRACT(YEAR from r.date) = '"
.$year ."' and r.id = c.raceID;";

$index = 1;
$races = $conn->query($sql);
		if ($races != null) {
		if($races->num_rows > 0){
		
		
		}
		}
		
		$conn->close();
		}
?>
</body>
</html>