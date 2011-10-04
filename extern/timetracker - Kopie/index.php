<?php
session_start();
include('../../libs/autoloader.php');

// Check for login error
if (isset($_GET['le'])) {

	switch ($_GET['le']) {

		case SWB_Login_Login::LOGIN_ERROR_NO_USERNAME_OR_PASSWORD:
			$errorText = 'Benutzername oder Passwort nicht angegeben';
			break;

		case SWB_Login_Login::LOGIN_ERROR_NOT_ACTIVE:
			$errorText = 'Benutzer nicht freigeschaltet';
			break;

		case SWB_Login_Login::LOGIN_ERROR_USER_UNKNOWN;
			$errorText = 'Benutzer nicht bekannt';
			break;

		case SWB_Login_Login::LOGIN_ERROR_WRONG_PASSWORD;
			$errorText = 'Passwort inkorrekt';
			break;

		default:
			$errorText = 'Unbekannter Fehler';
			break;

	}	
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="de">
	<head>
	   <title>autoactiva GmbH Timetracker</title>
	   <meta http-equiv="content-type" content="text/html;charset=utf-8" />
	   <meta http-equiv="Content-Style-Type" content="text/css" />
		<meta name="description" content="none" />
		<meta name="keywords" content="none" />
		<meta name="robots" content="index, follow" />
		<meta name="language" content="de" />	
		<meta name="distribution" content="global" />
		<meta name="revisit-after" content="7" />
		<script src="js/jquery-1.6.1.min.js" type="text/javascript"></script>
		<link href="css/login.css" rel="stylesheet" type="text/css" />   
	</head>
	<body>
		<div class="content-wrap">
			<?php
			if (!empty($errorText)) {
			?>
				<div id="loginErrorWrap">
					<?php  echo $errorText; ?>
				</div>
			<?php 
			}	
			?>	
			<div class="login-wrap">
				<h1>Login</h1><br /><br />
				<form name="trackerLogin" id="trackerLogin" method="post" accept-charset="utf8" action="checkLogin.php">
					<input type="text" name="loginUser" /><br /><br />
					<input type="password" name="loginPass" /><br /><br />
					<input type="submit" name="submitLogin" id="submitLogin" value="Login" />
				</form>
			</div>
		</div>
	</body>
</html>