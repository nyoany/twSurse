<?php
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/html; charset=utf-8');
header('Content-Disposition: attachment; filename=data.html');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('Column 1', 'Column 2', 'Column 3'));

// fetch the data
mysql_connect('localhost', 'root', 'licenta_dbP@ss1');
mysql_select_db('dball');
$rows = mysql_query('SELECT id,username FROM users');

// loop over the rows, outputting them
while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);
?>
