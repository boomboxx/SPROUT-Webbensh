<?php /* Smarty version Smarty-3.0.7, created on 2011-08-23 22:53:07
         compiled from "F:/xamppWin7/xampp/htdocs/projekte/BBX - Boomboxx/BBX1103-SWB - Sprout 0.2/Dev/smarty/templates\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:229024e541333aaeed7-50702956%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd0e712f1551567a8c02736b3fdf22ddad3dadf9a' => 
    array (
      0 => 'F:/xamppWin7/xampp/htdocs/projekte/BBX - Boomboxx/BBX1103-SWB - Sprout 0.2/Dev/smarty/templates\\login.tpl',
      1 => 1309124565,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '229024e541333aaeed7-50702956',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="de">
<head>
	<title><?php echo $_smarty_tpl->getVariable('title')->value;?>
</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link href="index.css" rel="stylesheet" type="text/css" />   
	<script type="text/javascript" src="js/jquery-1.5.js"></script>
</head>
<body>
	<?php if ($_smarty_tpl->getVariable('loginError')->value==true){?>
	<div id="loginErrorWrap">
		Fehler: <?php echo $_smarty_tpl->getVariable('errorText')->value;?>

	</div>
	<?php }?>
	<div id="loginWrap"<?php if ($_smarty_tpl->getVariable('loginError')->value==true){?> style="top:23px"<?php }?>>
		<div id="loginInnerWrap">
			<img src="gfx/index/login-sprout-logo.png" alt="SPROUT Webbench" />
			<form name="swbLogin" action="checkLogin.php" method="post" accept-charset="utf-8">
				<input type="text" name="loginUser" id="loginUser" />
				<input type="password" name="loginPassword" id="loginPassword" />
				<input type="submit" name="loginButton" id="loginButton" class="loginButton" value="Enter" />
			</form>
		</div>
	</div>
</body>
</html>