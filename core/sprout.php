<?php

// Error handling
error_reporting(E_ALL ^E_NOTICE ^E_WARNING); 
//error_reporting(0);

// Root dir
const ROOT_DIR			= 'F:/XAMPP/xampp/htdocs/projekte/BBX - Boomboxx/BBX1103-SWB - Sprout 0.2/Dev/';

// Smarty
const SMARTY_DIR		= 'F:/XAMPP/xampp/htdocs/projekte/BBX - Boomboxx/BBX1103-SWB - Sprout 0.2/Dev/libs/smarty/libs/';

// hack version example that works on both *nix and windows
// Smarty is assumend to be in 'includes/' dir under current script
//define('SMARTY_DIR',str_replace("\\","/",getcwd()).'../libs/smarty/libs/');
require_once(SMARTY_DIR . 'Smarty.class.php');
$smarty = new Smarty; 
$smarty->compile_check = true; 
$smarty->debugging = false; 
$smarty->template_dir = ROOT_DIR.'smarty/templates'; 
$smarty->compile_dir = ROOT_DIR.'smarty/templates_c';     