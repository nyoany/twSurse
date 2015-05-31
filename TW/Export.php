<?php 
if (isset($_POST['CSV']))
{
	// output headers so that the file is downloaded rather than displayed
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=data.csv');

	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');

	// output the column headings
	fputcsv($output, array('Date', 'Time', 'First Participant', 'Second Participant'));

	// fetch the data
	mysql_connect('localhost', 'root', 'root');
	mysql_select_db('dball');
	$rows = mysql_query("Select DATE_FORMAT(r.date,'%d-%m-%Y') as date, DATE_FORMAT(r.date,'%h:%i:00') as time,
	 r1.name as r1, r2.name as r2 from races as r, rats as r1, rats as r2 where (r1.id = r.participant1) 
	 and (r2.id = r.participant2) and date_format('".$_POST['date']."', '%d-%m-%Y') = DATE_FORMAT(r.date,'%d-%m-%Y');");
	// loop over the rows, outputting them
	while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);
}else if(isset($_POST['JSON']))
{
	// output headers so that the file is downloaded rather than displayed
	header('Content-Type: application/json; charset=utf-8');
	header('Content-Disposition: attachment; filename=results.json');

	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');


	// fetch the data
	mysql_connect('localhost', 'root', 'root');
	mysql_select_db('dball');
	$rows = mysql_query("Select DATE_FORMAT(r.date,'%d-%m-%Y') as date, DATE_FORMAT(r.date,'%h:%i:00') as time,
	 r1.name as r1, r2.name as r2 from races as r, rats as r1, rats as r2 where (r1.id = r.participant1) 
	 and (r2.id = r.participant2) and date_format('".$_POST['date']."', '%d-%m-%Y') = DATE_FORMAT(r.date,'%d-%m-%Y');");
	$response = array();
	$posts = array();

	while($row=mysql_fetch_array($rows)) 
	{ 
	$Date=$row['date']; 
	$Time=$row['time']; 
	$FirstParticipant=$row['r1']; 
	$SecondParticipant=$row['r2']; 

	$posts[] = array('date'=> $Date, 'time'=> $Time, 'r1'=> $FirstParticipant, 'r2'=> $SecondParticipant);

	} 

	//$response['posts'] = $posts;

	$fp = fopen('results.json', 'w');
	fwrite($fp, json_encode($posts));
	fclose($fp);
}else if(isset($_POST['HTML']))
{
	// output headers so that the file is downloaded rather than displayed
	header('Content-Type: text/html; charset=utf-8');
	header('Content-Disposition: attachment; filename=data.html');

	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');

	// output the column headings
	fputcsv($output, array('Date', 'Time', 'First Participant', 'Second Participant'));

	// fetch the data
	mysql_connect('localhost', 'root', 'root');
	mysql_select_db('dball');
	$rows = mysql_query("Select DATE_FORMAT(r.date,'%d-%m-%Y') as date, DATE_FORMAT(r.date,'%h:%i:00') as time,
	 r1.name as r1, r2.name as r2 from races as r, rats as r1, rats as r2 where (r1.id = r.participant1) 
	 and (r2.id = r.participant2) and date_format('".$_POST['date']."', '%d-%m-%Y') = DATE_FORMAT(r.date,'%d-%m-%Y');");

	// loop over the rows, outputting them
	while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);
}	
?>