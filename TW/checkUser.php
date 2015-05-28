<?php
require 'dbUtils.php';

$db =  new DbUtils();
if($db->verifyUserExists($_POST["username"], $_POST["password"]) === ""){
header('Location : http://localhost/twsurse/TW/login.html');
die();
return "The data you have inserted is invalid";
}
header('Location : http://localhost/twsurse/TW/welcome.html');
die();
?>