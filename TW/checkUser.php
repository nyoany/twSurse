<?php
require 'dbUtils.php';

$db =  new DbUtils();
$db->createUser($_POST["firstname"], $_POST["lastname"], $_POST["birthdate"], $_POST["email"], $_POST["username"], $_POST["password"], $_POST["safetyword"], "user");
?>