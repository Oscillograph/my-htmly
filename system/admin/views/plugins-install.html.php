<?php if (!defined('HTMLY')) die('HTMLy'); ?>

<form method='POST'>
	<?php if($success == 1):?>
		<p><font style='color: green'><span>Плагин <?php echo $plugin_name; ?> успешно установлен -- теперь его можно включить в <a href='<?php echo site_url() . 'admin/plugins'; ?>'>настройках</a>.</span></font></p>
	<?php endif; ?>
	<?php if($success == -1):?>
		<p><font style='color: red'><span>Ошибка! Не удалось установить плагин <?php echo $plugin_name; ?>.</span></font></p>
	<?php endif; ?>

	<input type="hidden" name="csrf_token" value="<?php echo get_csrf() ?>">
	<input type="hidden" id= "plugin_install" name="plugin_install" value="">

	<table class="table post-list">
		<tr class="head">
			<td  style='width: 75%'><b><?php echo i18n('Plugins_Install_Availiable');?></b></td>
			<td>&nbsp;</td>
		</tr>
		<?php foreach($plugins_zips as $key => $plugin): ?>
			<tr>
				<td><?php echo $plugin; ?></td>
				<td>
					<button type='submit' class="btn btn-primary btn-xs" onclick="javascript: document.getElementById('plugin_install').setAttribute('value', '<?php echo $plugin?>');">
						<?php echo i18n('Plugins_Install');?>
					</button>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

	<p>&nbsp;
	<p>&nbsp;
</form>

<form method='POST' enctype='multipart/form-data'>
	<h5><?php echo i18n('Plugins_Upload_New'); ?></h5>

	<input type="hidden" name="csrf_token" value="<?php echo get_csrf() ?>">
	<input type='file' id='plugin_upload' name='plugin_upload' class="btn btn-xs">
	<input type='submit' class="btn btn-primary btn-xs" value='<?php echo i18n('Plugins_Upload'); ?>'>
</form>