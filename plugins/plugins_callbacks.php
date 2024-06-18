<?php 
if (!defined('HTMLY')) die('HTMLy');

// Show admin/pages
get('/admin/plugins', function () 
{
	global $plugins_registry;

	if (login()) {

		$plugins_all = plugins_get_dirs();
		$user = $_SESSION[site_url()]['user'];
		$role = user('role', $user);

		config('views.root', 'system/admin/views');

		render('plugins', array(
			'metatags' => generate_meta(null, null),
			'title' => i18n('plugins') . ' : ' . i18n('plugins_setup'),
			'plugins_all'=> $plugins_all,
			'plugins_registry' => $plugins_registry,
			'user' => $user,
			'role' => $role,
			'is_page' => true
		));

	} else {
        $login = site_url() . 'login';
        header("location: $login");
    } 
});

post('/admin/plugins', function () 
{
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

	// load plugins registry
	$plugins_setup = plugins_ini_load();

	// process post data
	$enable_key = from($_REQUEST, 'plugin_enable');
	$disable_key = from($_REQUEST, 'plugin_disable');
	
	if ($enable_key)
	{
		$duplicate = 0;
		for ($i = 0; $i < count($plugins_setup); ++$i)
		{
			if ($plugins_setup[$i] == $enable_key)
			{
				$duplicate = 1;
				break;
			}
		}
		if (!$duplicate)
			$plugins_setup[] = $enable_key;
	}

	if ($disable_key)
	{
		for ($i = 0; $i < count($plugins_setup); ++$i)
		{
			if ($plugins_setup[$i] == $disable_key)
			{
				unset($plugins_setup[$i]);
				$plugins_setup = array_values($plugins_setup);
				break;
			}
		}
	}

	// save plugins registry
	file_put_contents(PLUGINS_REGISTRY_FILE, serialize($plugins_setup));

	update_plugins_registry($plugins_setup);

	if (login()) {
		config('views.root', 'system/admin/views');

		$plugins_all = plugins_get_dirs();
		$user = $_SESSION[site_url()]['user'];
		$role = user('role', $user);

		render('plugins', array(
			'metatags' => generate_meta(null, null),
			'title' => i18n('plugins') . ' : ' . i18n('plugins_setup'),
			'plugins_all'=> $plugins_all,
			'plugins_registry' => $plugins_registry,
			'user' => $user,
			'role' => $role,
			'is_page' => true
		));

	} else {
        $login = site_url() . 'login';
        header("location: $login");
    } 
});

get('/admin/plugins/install', function () 
{
	global $plugins_registry;

	if (login()) {
		$plugins_all = plugins_get_dirs();
		$user = $_SESSION[site_url()]['user'];
		$role = user('role', $user);

		config('views.root', 'system/admin/views');

		render('plugins-install', array(
			'metatags' => generate_meta(null, null),
			'title' => i18n('plugins') . ' : ' . i18n('plugins_install'),
			'plugins_all'=> $plugins_all,
			'plugins_registry' => $plugins_registry,
			'user' => $user,
			'$role' => $role,
			'is_page' => true
		));

	} else {
        $login = site_url() . 'login';
        header("location: $login");
    } 
});

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

// Show 403
get('/403', function () 
{
	render('403', array(
		'metatags' => generate_meta(null, null),
		'title' => '403',
		'is_page' => true
	));
});