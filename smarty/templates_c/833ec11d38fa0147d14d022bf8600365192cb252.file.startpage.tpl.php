<?php /* Smarty version Smarty-3.0.7, created on 2011-07-22 17:22:30
         compiled from "/pub/www/vhosts/sprout/smarty/templates/start/startpage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7426536134e2995b6bd69b5-36253094%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '833ec11d38fa0147d14d022bf8600365192cb252' => 
    array (
      0 => '/pub/www/vhosts/sprout/smarty/templates/start/startpage.tpl',
      1 => 1309124939,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7426536134e2995b6bd69b5-36253094',
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
	<?php if ($_smarty_tpl->getVariable('errorMessage')->value==true){?>
	<div id="loginErrorWrap">
		errorMessage
	</div>
	<?php }?>
	<?php echo $_smarty_tpl->getVariable('title')->value;?>

</body>
</html>