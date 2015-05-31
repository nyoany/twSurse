<?php 

class RaceDbUtils{


function startRace(){

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

$winnerQ = "Select winner from currentrace;";
}

function verifyStillRunning(){
$result = 0;
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

$winnerQ = "Select winner from currentrace;";

$winner = $conn->query($winnerQ);
if ($winner->num_rows > 0) {
 while($row = $winner->fetch_assoc()) {
if($row["winner"] == "none"){
$result = 1;
}
}
}
return $result;
}

function getWinner(){
$result = "none";
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

$winnerQ = "Select winner from currentrace;";

$winner = $conn->query($winnerQ);
if ($winner->num_rows > 0) {
 while($row = $winner->fetch_assoc()) {
if($row["winner"] != "none"){
 $result= $row["winner"];
}
}
}
return $result;
}

function setWinner(){

if(intval($this->getFirstRatFinalPosition())>=1084 || intval($this->getSecondRatFinalPosition())>1084){
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
$updateW = null;
if(intval($this->getFirstRatFinalPosition())>=1084){
$updateW = "update currentrace set status = 'ended', winner = 'first', firstratposition = '1084', secondratposition = '" .$this->getSecondRatFinalPosition() ."';";
}
else{
$updateW = "update currentrace set status = 'ended', winner = 'second', secondratposition = '1084', firstratposition = '" .$this->getFirstRatFinalPosition() . "';";
}

if ($conn->query($updateW) === TRUE) {
} 	
	
$conn->close();


}
}

function getFirstRatFinalPosition(){
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

$selectCurrentPos = "Select firstratposition from currentrace;";

$positions = $conn->query($selectCurrentPos);
if ($positions->num_rows > 0) {
 while($row = $positions->fetch_assoc()) {
$result= $row["firstratposition"];
}
}
return $result;
}

function getSecondRatFinalPosition(){
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

$selectCurrentPos = "Select secondratposition from currentrace;";

$positions = $conn->query($selectCurrentPos);
if ($positions->num_rows > 0) {
 while($row = $positions->fetch_assoc()) {
$result= $row["secondratposition"];
}
}
return $result;
}


function setLoserPosition(){

$loserPosition = null;
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
$firstRatPos = intval($this->getFirstRatFinalPosition());
$secondRatPos =  intval($this->getSecondRatFinalPosition());
if($firstRatPos >= 1084){
$loserPosition = $secondRatPos;
}
else if($secondRatPos >= 1084){
$loserPosition = $firstRatPos;
}
$verifyIsNotAlreadySet = $this->getLoserPosition();
if(intval($verifyIsNotAlreadySet) === 0){
$updateloserposition = "update currentrace set loserfinalposition = '" . strval($loserPosition) ."';";
if ($conn->query($updateloserposition) === TRUE) {
}
}
$conn->close();

}

function getLoserPosition(){

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

$loserpositionQ = "select loserfinalposition from currentrace;";
$loserposition = $conn->query($loserpositionQ);
if ($loserposition->num_rows > 0) {
 while($row = $loserposition->fetch_assoc()) {
$result= $row["loserfinalposition"];

}
}
return $result;
$conn->close();


}

function updateFirstRatPosition(){

$result =null;
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

$selectCurrentPos = "Select firstratposition from currentrace;";
$verifyIsNotAlreadySet = $this->getLoserPosition();
if(intval($verifyIsNotAlreadySet) === 0){
$positions = $conn->query($selectCurrentPos);
if ($positions->num_rows > 0) {
 while($row = $positions->fetch_assoc()) {
$newFvalue= $row["firstratposition"] + rand(1,100);
$updateQ = "update currentrace set firstratposition = '".$newFvalue ."';";

if ($conn->query($updateQ) === TRUE) {
    $result = $newFvalue;
} else {
    $result = null;
	}
}
}
}
else{
$result = $this->getFirstRatFinalPosition();
}	
$conn->close();
return $result;
}


function updateSecondRatPosition(){

$result =null;
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

$selectCurrentPos = "Select secondratposition from currentrace;";
$verifyIsNotAlreadySet = $this->getLoserPosition();
if(intval($verifyIsNotAlreadySet) === 0){
$positions = $conn->query($selectCurrentPos);
if ($positions->num_rows > 0) {
 while($row = $positions->fetch_assoc()) {
$newSvalue= $row["secondratposition"]  + rand(1,100);	
$updateQ = "update currentrace set secondratposition = '".$newSvalue ."';";

if ($conn->query($updateQ) === TRUE) {
    $result = $newSvalue;
} else {
    $result = null;
	}
}}}
else{
$result = $this->getSecondRatFinalPosition();
}	
$conn->close();
return $result;
}


function setSecondRatPos($position){

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

$updateQ = "update currentrace set secondratposition = '".$position ."';";

if ($conn->query($updateQ) === TRUE) {
}
	
$conn->close();
}


function setFirstRatPos($position){

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

$updateQ = "update currentrace set firstratposition = '".$position ."';";
if ($conn->query($updateQ) === TRUE) {
}	
$conn->close();
}
}
?>