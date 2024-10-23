<?php 
namespace myHTMLy;

class Plugin_KaTeX extends Plugin
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
	?>
<!-- KaTeX addon -->
<link rel="stylesheet" href="<?php echo site_url(); ?>plugins/katex/katex/katex.min.css">
<script src="<?php echo site_url(); ?>plugins/katex/katex/katex.min.js"></script>
<!-- /KaTeX addon -->
	<?php
	}

	public function frontend_theme_content()
	{
	}

	public function frontend_theme_footer()
	{
	?>
<!-- KaTeX addon -->
<script type="text/javascript" src="<?php echo site_url(); ?>plugins/katex/theme-postprocessing.js"></script>
<!-- /KaTeX addon -->
	<?php
	}

	public function frontend_theme_end()
	{
	}

	public function name()
	{
		return "KaTeX";
	}
}

plugin_register('katex', new Plugin_KaTeX());