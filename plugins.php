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

	/* general properties */
	abstract public function name();
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

// Show admin/pages
get('/admin/plugin/:static', function ($static) 
{
	global $plugins_registry;
	$user = $_SESSION[site_url()]['user'];
	$role = user('role', $user);
	if (login()) {
		config('views.root', 'system/admin/views');

		$plugin = $plugins_registry[$static];

		render('plugin', array(
			'metatags' => generate_meta(null, null),
			'plugin' => $plugin,
			'title' => $plugin->name(),
			'plugin_name' => $plugin->name(),
			'is_page' => true
		));

	} else {
        $login = site_url() . 'login';
        header("location: $login");
    } 
});

post('/admin/plugin/:static', function ($static) {
	global $plugins_registry;
	$proper = is_csrf_proper(from($_REQUEST, 'csrf_token'));
	if (!login())
	{
        $login = site_url() . 'login';
        header("location: $login");
		return;
	}

	if (!$proper)
	{
		echo 'CSRF attack detected.';
		return;
	}

	$user = $_SESSION[site_url()]['user'];
	$role = user('role', $user);
	if ($role === 'admin')
	{
		$plugin = $plugins_registry[$static];
		$plugin->admin_process_form();

		config('views.root', 'system/admin/views');
		render('plugin', array(
			'metatags' => generate_meta(null, null),
			'plugin' => $plugin,
			'title' => $plugin->name(),
			'plugin_name' => $plugin->name(),
			'is_page' => true
		));
	} else {
		echo 'Not enough rights to change plugin settings.';
	}
});