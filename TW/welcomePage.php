<?php 
echo '<head>
  <title>Login page</title>
  <link rel="stylesheet" type="text/css" href="login.css">
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#infoDialog" ).dialog();
  });
  </script>
  </head>

<body>
<div id="infoDialog" title="Information">
<p>
<?php
require "dbUtils.php";

$db =  new DbUtils();
if($db->verifyUserExists($_POST["username"], $_POST["password"]) != null){
 echo $result;
?>
</p>
</div>
<div id="main">
<span id="page-title"><H1>Login Page</H1></span>
 <form action="welcomePage.html" method="POST">
  <fieldset class="fieldSetClass">
    <legend>Please enter username and password:</legend>
	<br><br>
    Username: <input type="text" name="username"><br><br>
    Password: <input type="password" name= "password"><br><br>
	<input type="submit" value="Log in" class="generalButton">
  </fieldset>
  <div id="otherLinks">
  <span><H3><a href="create account.html"</H3>No account? Create new account</span>
  <span><H3><a href="forgot password.html"</H3>Forgot password</span>
  </div>
</form> 
</div>
</body>';
?>