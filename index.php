<?php
namespace myHTMLy
{
	define('HTMLY', true);
	define('HTMLY_VERSION', 'v2.9.8');
	define('MYHTMLY_VERSION', 'v0.2');
	$config_file = 'config/config.ini';
	require 'system/vendor/autoload.php';
	require_once 'plugins.php';
	require 'system/htmly.php';
}
?>