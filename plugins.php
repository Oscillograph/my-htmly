<?php
if (!defined('HTMLY')) die('HTMLy');

define('PLUGINS_BASE_DIR', __DIR__ . '/plugins/');

// this is what every plugin should be able to do
abstract class Plugin
{
	abstract public function admin_show_form();
	abstract public function admin_process_form();

	abstract public function backend_processor();

	abstract public function frontend_theme_start();
	abstract public function frontend_theme_header();
	abstract public function frontend_theme_content();
	abstract public function frontend_theme_footer();
	abstract public function frontend_theme_end();
}

$plugins_registry = [];

// fill $plugins_registry with plugins
require_once 'plugins/plugins_registry.php';

// registration should look like this:
// in plugins_registry.php:
//		require (PLUGINS_BASE_DIR . 'name/init.php');
// in plugins/name/init.php:
//		$plaugins_registry['name', $this]; // where $this is the plugin object

// from that moment any part of HTMLy should be able to call upon plugins functionality


// bulk plugin usage
function plugins_backend_processor()
{
	foreach($plugins_registry as $plugin)
	{
		$plugin->backend_processor();
	}
}

function plugins_frontend_theme_start()
{
	foreach($plugins_registry as $plugin)
	{
		$plugin->frontend_theme_start();
	}
}

function plugins_frontend_theme_header()
{
	foreach($plugins_registry as $plugin)
	{
		$plugin->frontend_theme_header();
	}
}

function plugins_frontend_theme_content()
{
	foreach($plugins_registry as $plugin)
	{
		$plugin->frontend_theme_content();
	}
}

function plugins_frontend_theme_footer()
{
	foreach($plugins_registry as $plugin)
	{
		$plugin->frontend_theme_footer();
	}
}

function plugins_frontend_theme_end()
{
	foreach($plugins_registry as $plugin)
	{
		$plugin->frontend_theme_end();
	}
}