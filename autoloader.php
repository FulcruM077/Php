<?php
# FulcruM

# Defined APP path for ease of use
define('APP', $_SERVER['DOCUMENT_ROOT'] . '/app');

# Define Project Namespace tag
define('PNAMESPACE', 'FulcruM\\');

spl_autoload_register(function($class) {
	$file = APP . '/'. $class . '.php';
	$file = str_replace(PNAMESPACE, '', $file);
	$file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
	if (file_exists($file)) {
		require_once($file);
	}
});
