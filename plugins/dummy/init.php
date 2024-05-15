<?php

class Plugin_Dummy extends Plugin
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
		echo 'Dummy Plugin';
	}

	public function frontend_theme_content()
	{
		echo 'Dummy Plugin Operational. <br>Let us bring content!';
	}

	public function frontend_theme_footer()
	{
	}

	public function frontend_theme_end()
	{
	}
}

$plugins_registry['dummy'] = new Plugin_Dummy();