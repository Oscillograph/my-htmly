<?php

class Plugin_Advanced_Functions extends Plugin
{
	public function admin_show_form()
	{
	}

	public function admin_process_form()
	{
	}

	public function backend_processor()
	{
	}

	public function frontend_theme_start()
	{
	}

	public function frontend_theme_header()
	{
	}

	public function frontend_theme_content()
	{
	}

	public function frontend_theme_footer()
	{
	}

	public function frontend_theme_end()
	{
	}

	public function name()
	{
		return "Advanced Functions";
	}
}

plugin_register('advanced-functions', new Plugin_Advanced_Functions());

include PLUGINS_BASE_DIR . 'advanced-functions/functions.php';
include PLUGINS_BASE_DIR . 'advanced-functions/getCallbacks.php';

?>