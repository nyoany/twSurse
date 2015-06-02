<?php 
if (isset($_POST['CSV']))
{
	if(!empty($_POST['date']))
	{
	// output headers so that the file is downloaded rather than displayed
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=data.csv');

		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');

		// output the column headings
		fputcsv($output, array('Date', 'Time', 'First Participant', 'Bettors for First Participant', 'Second Participant', 'Bettors for Second Participant'));

		// fetch the data
		mysql_connect('localhost', 'root', 'root');
		mysql_select_db('dball');
	
		$rows = mysql_query("Select DATE_FORMAT(r.date,'%d-%m-%Y') as date, DATE_FORMAT(r.date,'%h:%i:00') as time,
		 r1.name as r1, (select count(ratID) from bets where ratId=r.participant1 and raceID = r.id) as b1,
		 r2.name as r2, (select count(ratID) from bets where ratId=r.participant2 and raceID = r.id) as b2
		 from races as r, rats as r1, rats as r2 
		 where (r1.id = r.participant1)
		 and (r2.id = r.participant2)
		 and date_format('".$_POST['date']."', '%d-%m-%Y') = DATE_FORMAT(r.date,'%d-%m-%Y');");
		// loop over the rows, outputting them
		while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);
	}else
	{
		// output headers so that the file is downloaded rather than displayed
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=data.csv');

		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');

		// output the column headings
		fputcsv($output, array('Date', 'Time', 'First Participant', 'Bettors for First Participant', 'Second Participant', 'Bettors for Second Participant'));

		// fetch the data
		mysql_connect('localhost', 'root', 'root');
		mysql_select_db('dball');

		$rows = mysql_query("Select DISTINCT DATE_FORMAT(r.date,'%d-%m-%Y') as date, DATE_FORMAT(r.date,'%h:%i:00') as time, r1.name as r1, 
		 (select count(ratID) from bets where ratId=r.participant1 and raceID = r.id) as b1, r2.name as r2,
		 (select count(ratID) from bets where ratId=r.participant2 and raceID = r.id) as b2
			 from races as r, rats as r1, rats as r2, bets as b
			 where (r1.id = r.participant1) 
			 and (r2.id = r.participant2);");
		// loop over the rows, outputting them
		while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);
	}
}else if(isset($_POST['JSON']))
{
	if(!empty($_POST['date']))
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
		 r1.name as r1, (select count(ratID) from bets where ratId=r.participant1 and raceID = r.id) as b1,
		 r2.name as r2, (select count(ratID) from bets where ratId=r.participant2 and raceID = r.id) as b2
		 from races as r, rats as r1, rats as r2 
		 where (r1.id = r.participant1)
		 and (r2.id = r.participant2)
		 and date_format('".$_POST['date']."', '%d-%m-%Y') = DATE_FORMAT(r.date,'%d-%m-%Y');");
		$response = array();
		$posts = array();

		while($row=mysql_fetch_array($rows)) 
		{ 
		$Date=$row['date']; 
		$Time=$row['time']; 
		$FirstParticipant=$row['r1']; 
		$BettorsForFirstParticipant=$row['b1']; 
		$SecondParticipant=$row['r2']; 
		$BettorsForSecondParticipant=$row['b2']; 

		$posts[] = array('date'=> $Date, 'time'=> $Time, 'r1'=> $FirstParticipant, 'b1'=>$BettorsForFirstParticipant, 'r2'=> $SecondParticipant, 'b2'=>$BettorsForSecondParticipant);

		} 

		//$response['posts'] = $posts;

		//$fp = fopen('C:\Users\Alex\Downloads\results.json', 'w');
		fwrite($output, json_encode($posts));
		fclose($output);
	}else
	{
		// output headers so that the file is downloaded rather than displayed
		header('Content-Type: application/json; charset=utf-8');
		header('Content-Disposition: attachment; filename=results.json');

		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');


		// fetch the data
		mysql_connect('localhost', 'root', 'root');
		mysql_select_db('dball');
		$rows = mysql_query("Select DISTINCT DATE_FORMAT(r.date,'%d-%m-%Y') as date, DATE_FORMAT(r.date,'%h:%i:00') as time, r1.name as r1, 
		 (select count(ratID) from bets where ratId=r.participant1 and raceID = r.id) as b1, r2.name as r2,
		 (select count(ratID) from bets where ratId=r.participant2 and raceID = r.id) as b2
			 from races as r, rats as r1, rats as r2, bets as b
			 where (r1.id = r.participant1) 
			 and (r2.id = r.participant2);");
		$response = array();
		$posts = array();

		while($row=mysql_fetch_array($rows)) 
		{ 
		$Date=$row['date']; 
		$Time=$row['time']; 
		$FirstParticipant=$row['r1']; 
		$BettorsForFirstParticipant=$row['b1']; 
		$SecondParticipant=$row['r2']; 
		$BettorsForSecondParticipant=$row['b2']; 

		$posts[] = array('date'=> $Date, 'time'=> $Time, 'r1'=> $FirstParticipant, 'b1'=>$BettorsForFirstParticipant, 'r2'=> $SecondParticipant, 'b2'=>$BettorsForSecondParticipant);

		} 

		//$response['posts'] = $posts;

		//$fp = fopen('C:\Users\Alex\Downloads\results.json', 'w');
		fwrite($output, json_encode($posts));
		fclose($output);
	}
}else if(isset($_POST['HTML']))
{
	if(!empty($_POST['date']))
	{
		// output headers so that the file is downloaded rather than displayed
		header('Content-Type: text/html; charset=utf-8');
		header('Content-Disposition: attachment; filename=data.html');

		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');

		// output the column headings
		fwrite($output,'<html><head><link rel="stylesheet" type="text/css" href="C:\xampp\htdocs\twSurse\TW\template.css"></head><body><table><thead><tr><th>Date</th><th>Time</th><th>First Participant</th><th>Bets for First Participant</th><th>Second Participant</th><th>Bets for First Participant</th></tr></thead><tbody>');
		//fwrite($output, array('Date', 'Time', 'First Participant', 'Second Participant'));

		// fetch the data
		mysql_connect('localhost', 'root', 'root');
		mysql_select_db('dball');

		$rows = mysql_query("Select DATE_FORMAT(r.date,'%d-%m-%Y') as date, DATE_FORMAT(r.date,'%h:%i:00') as time,
		 r1.name as r1, (select count(ratID) from bets where ratId=r.participant1 and raceID = r.id) as b1,
		 r2.name as r2, (select count(ratID) from bets where ratId=r.participant2 and raceID = r.id) as b2
		 from races as r, rats as r1, rats as r2 
		 where (r1.id = r.participant1)
		 and (r2.id = r.participant2)
		 and date_format('".$_POST['date']."', '%d-%m-%Y') = DATE_FORMAT(r.date,'%d-%m-%Y');");

		// loop over the rows, outputting them
		
		while ($row = mysql_fetch_assoc($rows))
		{
			fwrite($output, '<tr>');
			fwrite($output, '<td>');
			fwrite($output, $row['date']);
			fwrite($output, '</td>');
			
			fwrite($output, '<td>');
			fwrite($output, $row['time']);
			fwrite($output, '</td>');
			
			fwrite($output, '<td>');
			fwrite($output, $row['r1']);
			fwrite($output, '</td>');
			
			fwrite($output, '<td>');
			fwrite($output, $row['b1']);
			fwrite($output, '</td>');
			
			fwrite($output, '<td>');
			fwrite($output, $row['r2']);
			fwrite($output, '</td>');
			
			fwrite($output, '<td>');
			fwrite($output, $row['b2']);
			fwrite($output, '</td>');
			
			fwrite($output, '</tr>');
		}
		fwrite($output, '</tbody></table></body></html>');
		fclose($output);
	}else
	{
		// output headers so that the file is downloaded rather than displayed
		header('Content-Type: text/html; charset=utf-8');
		header('Content-Disposition: attachment; filename=data.html');

		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');

		// output the column headings
		fwrite($output,'<html><head><link rel="stylesheet" type="text/css" href="C:\xampp\htdocs\twSurse\TW\template.css"></head><body><table><thead><tr><th>Date</th><th>Time</th><th>First Participant</th><th>Bets for First Participant</th><th>Second Participant</th><th>Bets for First Participant</th></tr></thead><tbody>');
		//fwrite($output, array('Date', 'Time', 'First Participant', 'Second Participant'));

		// fetch the data
		mysql_connect('localhost', 'root', 'root');
		mysql_select_db('dball');

		$rows = mysql_query("Select DISTINCT DATE_FORMAT(r.date,'%d-%m-%Y') as date, DATE_FORMAT(r.date,'%h:%i:00') as time, r1.name as r1, 
		 (select count(ratID) from bets where ratId=r.participant1 and raceID = r.id) as b1, r2.name as r2,
		 (select count(ratID) from bets where ratId=r.participant2 and raceID = r.id) as b2
			 from races as r, rats as r1, rats as r2, bets as b
			 where (r1.id = r.participant1) 
			 and (r2.id = r.participant2);");

		// loop over the rows, outputting them
		
		while ($row = mysql_fetch_assoc($rows))
		{
			fwrite($output, '<tr>');
			fwrite($output, '<td>');
			fwrite($output, $row['date']);
			fwrite($output, '</td>');
			
			fwrite($output, '<td>');
			fwrite($output, $row['time']);
			fwrite($output, '</td>');
			
			fwrite($output, '<td>');
			fwrite($output, $row['r1']);
			fwrite($output, '</td>');
			
			fwrite($output, '<td>');
			fwrite($output, $row['b1']);
			fwrite($output, '</td>');
			
			fwrite($output, '<td>');
			fwrite($output, $row['r2']);
			fwrite($output, '</td>');
			
			fwrite($output, '<td>');
			fwrite($output, $row['b2']);
			fwrite($output, '</td>');
			
			fwrite($output, '</tr>');
		}
		fwrite($output, '</tbody></table></body></html>');
		fclose($output);
	}
}	
?>