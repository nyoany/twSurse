<?php


$result = mail(
     $_POST["email"],
     'New generated password for Ratsie Race site',
     'A new password has been generated for you :'.  $_POST["securityword"].'123');
	 
	 if($result){
	 
	 }
?>