<?php
namespace myHTMLy;

/* Logic is this:
Admin:
- set up whether the site is on maintenance or not (with a button which sends a form)
- the setting is stored in maintenance.ini

Client:
- load the setting and check the site status
- if the site is on maintenance, load the corresponding page
^^^ this should be done before the theme starts
*/


class Plugin_Maintenance extends Plugin
{
	public function admin_show_form()
	{
		?>
		<input type='hidden' name='plugin_name' value='<?php echo $this->name();?>'>
		<input type='hidden' name='maintenance_on' value='<?php echo $this->isOnMaintenance();?>'>

		<?php
			$form_sent = from($_REQUEST, 'plugin_name');
			if ($form_sent == $this->name()) {
				?>
				<p>Спасибо за отправленную форму!</p>
				<p>Теперь техобслуживание <?php echo ($this->isOnMaintenance() ? 'включено' : 'выключено'); ?>.</p>
				<?php
			}
		?>

		<input type='submit' value='<?php echo ($this->isOnMaintenance() ? 'Выключить' : 'Включить'); ?>' class="btn btn-primary" style="width:100px;">
		<?php
	}

	public function admin_process_form()
	{
		$filename = PLUGINS_BASE_DIR . 'maintenance/data/data.php';

		$maintenance = from($_REQUEST, 'maintenance_on');
		$maintenance = ($maintenance == '0' ? 1 : 0);

		file_put_contents($filename, $maintenance);

	}

	public function backend_processor()
	{
	}

	public function frontend_theme_start()
	{
		if ($this->isOnMaintenance())
		{
			if (login())
			{
				$user = $_SESSION[site_url()]['user'];
				$role = user('role', $user);
				if ($role === 'admin')
				{
				} else {
					$this->showMaintenance();
					exit;
				}
			} else {
				$this->showMaintenance();
				exit;
			}
		}
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
		return "Техобслуживание";
	}

	private function isOnMaintenance()
	{
		$filename = PLUGINS_BASE_DIR . 'maintenance/data/data.php';
		$maintenance = file_get_contents($filename);
		return ($maintenance == '0' ? 0 : 1);
	}

	private function showMaintenance()
	{
		$maintenance_page = PLUGINS_BASE_DIR . 'maintenance/views/index.html.php';
		include $maintenance_page;
	}
}

plugin_register('maintenance', new Plugin_Maintenance());