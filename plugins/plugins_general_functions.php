<?php
if (!defined('HTMLY')) die('HTMLy');

// bulk plugin usage
function plugins_backend_processor()
{
	global $plugins_registry;
	foreach($plugins_registry as $plugin)
	{
		$plugin->backend_processor();
	}
}

function plugins_frontend_theme_start()
{
	global $plugins_registry;
	foreach($plugins_registry as $plugin)
	{
		$plugin->frontend_theme_start();
	}
}

function plugins_frontend_theme_header()
{
	global $plugins_registry;
	foreach($plugins_registry as $plugin)
	{
		$plugin->frontend_theme_header();
	}
}

function plugins_frontend_theme_content()
{
	global $plugins_registry;
	foreach($plugins_registry as $plugin)
	{
		$plugin->frontend_theme_content();
	}
}

function plugins_frontend_theme_footer()
{
	global $plugins_registry;
	foreach($plugins_registry as $plugin)
	{
		$plugin->frontend_theme_footer();
	}
}

function plugins_frontend_theme_end()
{
	global $plugins_registry;
	foreach($plugins_registry as $plugin)
	{
		$plugin->frontend_theme_end();
	}
}