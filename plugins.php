<?php
if (!defined('HTMLY')) die('HTMLy');

define('PLUGINS_BASE_DIR', __DIR__ . '/plugins/');
define('PLUGINS_REGISTRY_FILE', 'config/plugins.ini');

require_once(PLUGINS_BASE_DIR . 'plugins_plugin.php');
require_once(PLUGINS_BASE_DIR . 'plugins_registry.php');
require_once(PLUGINS_BASE_DIR . 'plugins_general_functions.php');

// initialize plugins collection
update_plugins_registry();

// server-side routines started after HTMLy loads properly
plugins_backend_processor();

// process GET/POST requests
require_once(PLUGINS_BASE_DIR . 'plugins_callbacks.php');