<?php 
namespace myHTMLy
{
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


		// show the page
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
	});

	get('/admin/plugins/install', function () 
	{
		global $plugins_registry;

		if (login()) {
			$plugins_all = plugins_get_dirs();
			$plugins_zips = plugins_get_zips();
			$user = $_SESSION[site_url()]['user'];
			$role = user('role', $user);

			config('views.root', 'system/admin/views');

			render('plugins-install', array(
				'metatags' => generate_meta(null, null),
				'title' => i18n('plugins') . ' : ' . i18n('plugins_install'),
				'plugins_all'=> $plugins_all,
				'plugins_zips' => $plugins_zips,
				'plugins_registry' => $plugins_registry,
				'user' => $user,
				'role' => $role,
				'success' => 0,
				'is_page' => true
			));

		} else {
			$login = site_url() . 'login';
			header("location: $login");
		} 
	});

	post('/admin/plugins/install', function () 
	{
		$proper = is_csrf_proper(from($_REQUEST, 'csrf_token'));
		if (!login())
		{
			$login = site_url() . 'login';
			header("location: $login");
			return;
		}

		$user = $_SESSION[site_url()]['user'];
		$role = user('role', $user);
		if ($role != 'admin')
		{
			echo 'Only admin can install plugins';
			return;
		}

		if (!$proper)
		{
			echo 'CSRF attack detected.';
			return;
		}

		global $plugins_registry;

		// collect post data
		$plugin_install = from($_REQUEST, 'plugin_install');
		$plugin_name = '';


		// install routine
		$success = 0; // -1 - fail; 0 - nothing was sent; 1 - win

		if ($plugin_install)
		{
			$success = -1;

			$zip = new ZipArchive;
			$result = $zip->open(PLUGINS_BASE_DIR . $plugin_install, ZipArchive::RDONLY);
			if ($result)
			{
				$plugin_name = substr($plugin_install, 0, (strlen($plugin_install) - 4));
				$result = $zip->extractTo(PLUGINS_BASE_DIR);
				if ($result)
				{
					$success = 1;
				}
			}
			$result = $zip->close();
		}

		// upload new plugins
		$plugin_upload = [];
		
		if ($_FILES)
		{
			$plugin_upload = $_FILES['plugin_upload'];
		}

		if ($plugin_upload)
		{
			$filename = PLUGINS_BASE_DIR . $plugin_upload['name'];
			move_uploaded_file($plugin_upload['tmp_name'], $filename);
		}


		// show the page
		$plugins_all = plugins_get_dirs();
		$plugins_zips = plugins_get_zips();

		config('views.root', 'system/admin/views');

		render('plugins-install', array(
			'metatags' => generate_meta(null, null),
			'title' => i18n('plugins') . ' : ' . i18n('plugins_install'),
			'plugins_all'=> $plugins_all,
			'plugins_zips' => $plugins_zips,
			'plugins_registry' => $plugins_registry,
			'plugin_name' => $plugin_name,
			'user' => $user,
			'role' => $role,
			'success' => $success,
			'is_page' => true
		));
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
}