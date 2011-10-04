<?php
session_start();
include('libs/autoloader.php');

$login = new SWB_Login_Login($_POST['loginUser'], md5($_POST['loginPassword']));
$loginError = $login->getLoginError();

if ($loginError) {
	
	// Relocate zum Login
	header('Location: index.php?le='.$loginError);
	break;
	
} else {
	
	// Session Daten setzen
	$_SESSION['userId'] = $login->getUser()->getId();
	$_SESSION['userName'] = $login->getUser()->getSurname().", ".$login->getUser()->getName();
	$_SESSION['userIsAdmin'] = $login->getUser()->isAdmin();
	
	header('Location: gui/index.php');
	break;
	
}

?>