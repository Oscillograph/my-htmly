<?php if (!defined('HTMLY')) die('HTMLy'); ?>


<form method='POST'>
	<input type="hidden" name="csrf_token" value="<?php echo get_csrf() ?>">
	<input type="hidden" id= "plugin_disable" name="plugin_disable" value="">
	<input type="hidden" id= "plugin_enable" name="plugin_enable" value="">

	<table class="table post-list">
		<tr class="head">
			<td style='width: 75%'><b><?php echo i18n('Enabled');?></b></td>
			<td> &nbsp; </td>
		</tr>
		<?php foreach($plugins_registry as $key => $plugin): ?>
			<tr>
				<td>
					<a href="<?php echo site_url();?>admin/plugin/<?php echo $key; ?>" class="nav-link"><?php echo $plugin->name(); ?></a>
				</td>
				<td>
					<input type='submit' class="btn btn-danger btn-xs" onclick="javascript: document.getElementById('plugin_disable').setAttribute('value', '<?php echo $key?>');" value="<?php echo i18n('Disable');?>">
				</td>
			</tr>
		<?php endforeach; ?>
	</table>

	<table class="table post-list">
		<tr class="head">
			<td style='width: 75%'><b><?php echo i18n('Disabled');?></b></td>
			<td> &nbsp; </td>
		</tr>
		<?php foreach($plugins_all as $key => $plugin): ?>
			<?php if (!isset($plugins_registry[$plugins_all[$key]])): ?>
			<tr>
				<td>
					<a href="<?php echo site_url();?>admin/plugin/<?php echo $plugins_all[$key]; ?>" class="nav-link"><?php echo $plugins_all[$key]; ?></a>
				</td>
				<td>
					<input type='submit' class="btn btn-primary btn-xs" onclick="javascript: document.getElementById('plugin_enable').setAttribute('value', '<?php echo $plugins_all[$key]; ?>');" value="<?php echo i18n('Enable');?>">
				</td>
			</tr>
			<?php endif; ?>
		<?php endforeach; ?>
	</table>
</form>
