<?php 

class Plugin_BBTags extends Plugin
{
	public function admin_show_form()
	{
		$content_js = htmlspecialchars(file_get_contents(PLUGINS_BASE_DIR .'bbtags/theme-postprocessing.js'));
		$content_css = htmlspecialchars(file_get_contents(PLUGINS_BASE_DIR .'bbtags/style.css'));
?>
<p>Задачи этого плагина: поддержка BB-тегов на страницах сайта; частичная доработка разметки на стороне клиента, включая содержимое тегов &lt;pre&gt;...&lt;/pre&gt;; а также замена двух дефисов подряд "--" на знак тире "&#8211;"</p>
<div class='row'>
	<div class='col-sm-6'>
		<label for="wmd-input">Скрипты тегов</label>
		<textarea id="wmd-input" class="form-control wmd-input" style='overflow-x:auto' name="content_js" cols="20" rows="11"><?php echo $content_js; ?></textarea></br>
	</div>

	<div class='col-sm-6'>
		<label for="wmd-input">Таблица стилей</label>
		<textarea id="wmd-input" class="form-control wmd-input" style='overflow-x:auto' name="content_css" cols="20" rows="11"><?php echo $content_css; ?></textarea></br>
	</div>
</div>
<input type="submit" name="save" class="btn btn-primary submit" value="Сохранить"/>
<input type="hidden" id="restore_jsandcss_from_backup" name="restore" value="0">
<input type="submit" name="save" class="btn btn-primary submit" value="Вернуть, как было" onclick="javascript: document.getElementById('restore_jsandcss_from_backup').setAttribute('value', '1')" />

<?php
	}

	public function admin_process_form()
	{
		$file_js = PLUGINS_BASE_DIR .'bbtags/theme-postprocessing.js';
		$file_css = PLUGINS_BASE_DIR . 'bbtags/style.css';
		$backup_file_js = PLUGINS_BASE_DIR .'bbtags/backup/theme-postprocessing.js';
		$backup_file_css = PLUGINS_BASE_DIR . 'bbtags/backup/style.css';

		$content_js = from($_REQUEST, 'content_js');
		$content_css = from($_REQUEST, 'content_css');
		$restore = from($_REQUEST, 'restore');

		if ($restore)
		{
			file_put_contents($file_js, file_get_contents($backup_file_js));
			file_put_contents($file_css, file_get_contents($backup_file_css));
		} else {
			// make backup
			file_put_contents($backup_file_js, file_get_contents($file_js));
			file_put_contents($backup_file_css, file_get_contents($file_css));

			// save actual
			file_put_contents($file_js, $content_js);
			file_put_contents($file_css, $content_css);
		}
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
<!-- BBTags addon -->
<link rel="stylesheet" href="<?php echo site_url(); ?>plugins/bbtags/style.css" type="text/css" media="all" />
<!-- /BBTags addon -->
<?php
	}

	public function frontend_theme_content()
	{
	}

	public function frontend_theme_footer()
	{
?>
<!-- BBTags addon -->
<script type="text/javascript" src="<?php echo site_url(); ?>plugins/bbtags/theme-postprocessing.js"></script>
<!-- /BBTags addon -->
<?php
	}

	public function frontend_theme_end()
	{
	}

	public function name()
	{
		return "BB-теги";
	}
}

$plugins_registry['bbtags'] = new Plugin_BBTags();