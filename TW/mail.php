<?php
$result;
require 'dbUtils.php';
$db = new dbUtils();
$password = $db->verifyUserIsValid($_POST["username"],$_POST["securityword"],$_POST["email"]);
if($password==null){
header ('Location:http://localhost/twsurse/TW/login.html?error=true');
return;
}
$result = mail(
     $_POST["email"],
     'Your forgotten password from Ratsie Race site',
     'Your password is : '.$password);
	 
header ('Location:http://localhost/twsurse/TW/login.html');
?>