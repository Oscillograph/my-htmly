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
		return "Dummy";
	}
}

$plugins_registry['dummy'] = new Plugin_Dummy();