<?php

class RaceDetails{

function getCurrentRaceID(){
if(isset($_GET['raceID'])){
return $_GET['raceID'];
}
}

function getComments(){

$result = "";
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
if(isset($_COOKIE["username"])){
$getUserID ="select id from users where username='".$_COOKIE["username"]."';";
$userIDQ= $conn->query($getUserID);
if ($userIDQ->num_rows > 0) {
while($row = $userIDQ->fetch_assoc()) {
$userID = strval($row["id"]);
if(isset($_POST["comment"])){
$insertComm = "INSERT INTO comentaries (raceID, userID, commentary, date) VALUES ('".$_POST['raceID'] ."','". $userID."','" .$_POST['comment']."',NOW());";
$conn->query($insertComm);
}
}
}
}
$sql ="select u.username, commentary, date from comentaries, users u where raceID= '" .$_GET['raceID']."' and u.id = userID ORDER BY date;";
$queryr = $conn->query($sql);

if ($queryr->num_rows <= 0){ 
return "<b>There is no comment yet. Be the first to comment...</b>";
}
if ($queryr->num_rows > 0) {
while($row = $queryr->fetch_assoc()) {

$result = $result ."<br><b>" .$row["username"] . " commented on " .$row["date"]. " : </b>" .$row["commentary"] . ".<br>";
}
}
return $result;
}

function getBetSection(){

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

$sql ="select participant1, participant2, date, winner, r.id, r1.name as r1, r2.name as r2 from races as r, rats as r1, rats as r2 where r.id= '" .$this->getCurrentRaceID()."' and (r1.id = r.participant1) and (r2.id = r.participant2);";
$queryr = $conn->query($sql);

if ($queryr->num_rows <= 0){ 
return "<b>The requested page does not exist...</b>";
}

while($row = $queryr->fetch_assoc()) {
$result = "<br> <b>Select rat : </b> <input type = 'checkbox' id='c1' name = 'r1' value='". $row["r1"] ."' onclick = 'verifyErrorFree(this)'>". $row["r1"];
$result =$result."<input type = 'checkbox' id='c2' name = 'r2' value='". $row["r2"] ."' onclick = 'verifyErrorFree(this)'>". $row["r2"];
return $result;

}}



function getDetails(){

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

$sql ="select participant1, participant2, date, winner, r.id, r1.name as r1, r2.name as r2 from races as r, rats as r1, rats as r2 where r.id= '" .$this->getCurrentRaceID()."' and (r1.id = r.participant1) and (r2.id = r.participant2);";
$queryr = $conn->query($sql);

if ($queryr->num_rows <= 0){ 
return "<b>The requested page does not exist...</b>";
}

while($row = $queryr->fetch_assoc()) {
$result = "<br> <b>Participants : </b>". $row["r1"] . " vs. " .$row["r2"]."<br>";
$result = $result. "<b>Date : </b>".$row["date"]."<br>";

if($row["winner"] === null){

$result = $result. "<b>Winner: </b>The race did not start yet.";
}
else{
$result = $result. "<b>Winner : </b>" .$row["winner"]; 
}
}
return $result;
}

function getWinner(){

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
if(isset($_GET["raceID"])){
$sql = "select DISTINCT DATE_SUB((select date from races where id=" .$this->getCurrentRaceID()."),INTERVAL 1 HOUR) as date2 from races where DATE_SUB((select date from races where id=" 
.$this->getCurrentRaceID() ."),INTERVAL 1 HOUR)-NOW()>0;";
$queryr = $conn->query($sql);

if ($queryr->num_rows <= 0){ 
return "none;";
}

while($row = $queryr->fetch_assoc()) {

if($row["date2"] != null){
return $row["date2"];
}
}
return "block;";
}
}

function getAvailableTime(){

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
if(isset($_GET["raceID"])){
$sql = "select DISTINCT DATE_SUB((select date from races where id=" .$this->getCurrentRaceID()."),INTERVAL 1 HOUR) as date2 from races where DATE_SUB((select date from races where id=" 
.$this->getCurrentRaceID() ."),INTERVAL 1 HOUR)-NOW()>0;";
$queryr = $conn->query($sql);

if ($queryr->num_rows <= 0){ 
return "<b>Error...</b>";
}

while($row = $queryr->fetch_assoc()) {

if($row["date2"] != null){
return $row["date2"];
}
}
}
}
}
?>