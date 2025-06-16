<?php

define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');

switch (ENVIRONMENT)
{
	case 'development':
		error_reporting(E_ALL);
		ini_set('display_errors', 1);

	break;

	case 'testing':
	case 'production':
		error_reporting(E_ALL);
		ini_set('display_errors', 1);		
	break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', true, 503);
		echo 'The application environment is not set correctly.';
		exit(1);
}

$system_path = 'system';
$application_folder = 'application';
$view_folder = '';

if (defined('STDIN')) {
	chdir(dirname(__FILE__));
}

if (($_temp = realpath($system_path)) !== false) {
	$system_path = $_temp.DIRECTORY_SEPARATOR;
} else {
	$system_path = strtr(
		rtrim($system_path, '/\\'),
		'/\\',
		DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
	).DIRECTORY_SEPARATOR;
}

if (!is_dir($system_path)) {
	header('HTTP/1.1 503 Service Unavailable.', true, 503);
	echo 'Your system folder path does not appear to be set correctly.';
	exit(3);
}

define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('BASEPATH', $system_path);
define('FCPATH', __DIR__.DIRECTORY_SEPARATOR);
define('SYSDIR', basename(BASEPATH));

if (is_dir($application_folder)) {
	define('APPPATH', $application_folder.DIRECTORY_SEPARATOR);
} else {
	if (!is_dir(BASEPATH.$application_folder.DIRECTORY_SEPARATOR)) {
		header('HTTP/1.1 503 Service Unavailable.', true, 503);
		echo 'Your application folder path does not appear to be set correctly.';
		exit(3);
	}
	define('APPPATH', BASEPATH.$application_folder.DIRECTORY_SEPARATOR);
}

$view_folder = ($view_folder !== '') ? $view_folder : APPPATH.'views';

if (!is_dir($view_folder)) {
	if (!is_dir(APPPATH.$view_folder.DIRECTORY_SEPARATOR)) {
		header('HTTP/1.1 503 Service Unavailable.', true, 503);
		echo 'Your view folder path does not appear to be set correctly.';
		exit(3);
	}
	$view_folder = APPPATH.$view_folder;
}

define('VIEWPATH', rtrim($view_folder, '/\\').DIRECTORY_SEPARATOR);

require_once BASEPATH.'core/CodeIgniter.php';
