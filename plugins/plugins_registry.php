<?php
if (!defined('HTMLY')) die('HTMLy');

$plugins_registry = [];

function plugins_ini_load()
{
	$plugins_setup = 0;

	if (file_exists(PLUGINS_REGISTRY_FILE))
	{
		$plugins_setup = unserialize(file_get_contents(PLUGINS_REGISTRY_FILE));
	}

	if (!$plugins_setup)
	{
		$plugins_setup = array();
	}

	return $plugins_setup;
}

function plugins_get_dirs()
{
	$plugins_all = array();
	$files = scandir(PLUGINS_BASE_DIR);
	for ($i = 0; $i < count($files); ++$i)
	{
		if (is_dir(PLUGINS_BASE_DIR . $files[$i]))
		{
			if (($files[$i] != '.') && ($files[$i] != '..'))
			{
				$plugins_all[] = $files[$i];
			}
		}
	}
	return $plugins_all;
}

function plugins_get_zips()
{
	$plugins_zips = array();
	$files = scandir(PLUGINS_BASE_DIR);
	for ($i = 0; $i < count($files); ++$i)
	{
		if (!is_dir(PLUGINS_BASE_DIR . $files[$i]))
		{
			if ((substr($files[$i], -4) == '.zip'))
			{
				$plugin_name = substr($files[$i], 0, (strlen($files[$i]) - 4));
				if (!is_dir(PLUGINS_BASE_DIR . $plugin_name))
				{
					$plugins_zips[] = $files[$i];
				}
			} else {
				continue;
			}
		}
	}
	return $plugins_zips;
}

function plugin_register($name, $obj = null)
{
	global $plugins_registry;
	$plugins_registry[$name] = $obj;
}

function plugin_unregister($name)
{
	global $plugins_registry;
	unset($plugins_registry[$name]);
}

function update_plugins_registry($plugins = null)
{
	global $plugins_registry;

	$plugins_set = [];
	if (!$plugins == null)
	{
		$plugins_set = $plugins;
	} else {
		$plugins_set = plugins_ini_load();
	}

	foreach($plugins_registry as $key => $object)
	{
		$stillSet = false;

		for ($i = 0; $i < count($plugins_set); ++$i)
		{
			if ($plugins_set[$i] == $key)
			{
				$stillSet = true;
				unset($plugins_set[$i]);
				$plugins_set = array_values($plugins_set);
				$i = count($plugins_set);
			}
		}

		if (!$stillSet)
		{
			unset($plugins_registry[$key]);
		}
	}

	if (count($plugins_set) > 0)
	{
		for ($i = 0; $i < count($plugins_set); ++$i)
		{
			require(PLUGINS_BASE_DIR . $plugins_set[$i] . '/init.php');
		}
	}
}