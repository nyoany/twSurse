<?php 

// output headers so that the file is downloaded rather than displayed
header('Content-Type: application/json; charset=utf-8');
header('Content-Disposition: attachment; filename=results.json');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');


// fetch the data
mysql_connect('localhost', 'root', 'licenta_dbP@ss1');
mysql_select_db('dball');
$rows = mysql_query('SELECT id,username FROM users');
$response = array();
$posts = array();

while($row=mysql_fetch_array($rows)) 
{ 
$id=$row['id']; 
$username=$row['username']; 

$posts[] = array('id'=> $id, 'username'=> $username);

} 

//$response['posts'] = $posts;

$fp = fopen('results.json', 'w');
fwrite($fp, json_encode($posts));
fclose($fp);

?> 