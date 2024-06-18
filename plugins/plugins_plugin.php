<?php
if (!defined('HTMLY')) die('HTMLy');

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