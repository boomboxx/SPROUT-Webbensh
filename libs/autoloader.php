<?php
function autoloader($class) {
	
	// Explode classname to file
	$iPath = 0;
	$path = explode('_', $class);
	$filename = dirname(__FILE__).'/';
	
	while($iPath < count($path)-1) {
	
		$filename .= $path[$iPath].'/';
		$iPath++;
		
	}
	
	$filename .= 'class.'.$path[count($path)-1].'.php';
	
	if (file_exists($filename))  {
		include ($filename);
	}

}

spl_autoload_register('autoloader');