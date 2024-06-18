<?php
if (!defined('HTMLY')) die('HTMLy');

define('PLUGINS_BASE_DIR', __DIR__ . '/plugins/');
define('PLUGINS_REGISTRY_FILE', 'config/plugins.ini');

require_once(PLUGINS_BASE_DIR . 'plugins_plugin.php');

require_once(PLUGINS_BASE_DIR . 'plugins_registry.php');
update_plugins_registry();

require_once(PLUGINS_BASE_DIR . 'plugins_general_functions.php');
require_once(PLUGINS_BASE_DIR . 'plugins_callbacks.php');