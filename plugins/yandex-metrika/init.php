<?php
namespace myHTMLy;

class Plugin_Yandex_Metrika extends Plugin
{
	public function admin_show_form()
	{
		$content_counter = htmlspecialchars(file_get_contents(PLUGINS_BASE_DIR . 'yandex-metrika/counter.txt'));
?>
<div class='row'>
	<div class='col-sm-6' style='flex-basis: 100%; max-width: 100%'>
		<label for="wmd-input">Код счётчика</label>
		<textarea id="wmd-input" class="form-control wmd-input" style='overflow-x:auto' name="content_counter" cols="20" rows="11"><?php echo $content_counter; ?></textarea></br>
	</div>
</div>
<input type="submit" name="save" class="btn btn-primary submit" value="Сохранить"/>
<?php
	}

	public function admin_process_form()
	{
		$file_counter = PLUGINS_BASE_DIR .'yandex-metrika/counter.txt';
		$content_counter = from($_REQUEST, 'content_counter');

		file_put_contents($file_counter, $content_counter);
	}

	public function backend_processor()
	{
	}

	public function frontend_theme_start()
	{
	}

	public function frontend_theme_header()
	{
		include PLUGINS_BASE_DIR . 'yandex-metrika/counter.txt';
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
		return "Яндекс.Метрика";
	}
}

plugin_register('yandex-metrika', new Plugin_Yandex_Metrika());