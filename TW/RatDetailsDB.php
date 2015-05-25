<?php

class RatDetails {
	
function getRatName()
{
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
$inter="select name from rats; ";
 
$ratname=$conn->query($inter);
if($ratname->num_rows>0){
	while($row=$ratname->fetch_assoc()){
		$result=$row["name"];
	}
}  
$conn->close();
return $result;
}



function getRatWins()
{
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
$inter="select wins from rats; ";
 
$ratwins=$conn->query($inter);
if($ratwins->num_rows>0){
	while($row=$ratwins->fetch_assoc()){
		$result=$row["wins"];
	}
}  
$conn->close();
return $result;
}

function getRatLoses()
{
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
$inter="select loses from rats; ";
 
$ratloses=$conn->query($inter);
if($ratloses->num_rows>0){
	while($row=$ratloses->fetch_assoc()){
		$result=$row["loses"];
	}
}  
$conn->close();
return $result;
}

function getCota()
{
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
$inter="select cota from rats; ";
 
$ratcota=$conn->query($inter);
if($ratcota->num_rows>0){
	while($row=$ratcota->fetch_assoc()){
		$result=$row["cota"];
	}
}  
$conn->close();
return $result;
}
/*

function get()
{
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
$inter="select cota from rats; ";
 
$ratcota=$conn->query($inter);
if($ratcota->num_rows>0){
	while($row=$ratcota->fetch_assoc()){
		$result=$row["cota"];
	}
}  
$conn->close();
return $result;
}
*/
} 
?>