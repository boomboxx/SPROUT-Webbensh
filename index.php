<?php
session_start();
include('core/sprout.php');
include('libs/autoloader.php');

$loginError		= false;

// Check for login error
if (isset($_GET['le'])) {

	$smarty->assign('loginError', true);
	switch ($_GET['le']) {

		case SWB_Login_Login::LOGIN_ERROR_NO_USERNAME_OR_PASSWORD:
			$smarty->assign('errorText', 'Benutzername oder Passwort nicht angegeben');
			break;

		case SWB_Login_Login::LOGIN_ERROR_NOT_ACTIVE:
			$smarty->assign('errorText', 'Benutzer nicht freigeschaltet');
			break;

		case SWB_Login_Login::LOGIN_ERROR_USER_UNKNOWN;
			$smarty->assign('errorText', 'Benutzer nicht bekannt');
			break;

		case SWB_Login_Login::LOGIN_ERROR_WRONG_PASSWORD;
			$smarty->assign('errorText', 'Passwort inkorrekt');
			break;

		default:
			$smarty->assign('errorText', 'Unbekannter Fehler');
			break;

	}	
	
}


$smarty->assign('title','SPROUT Webbench '.SWB_Config_System::SWB_VERSION);
$smarty->display('login.tpl');   