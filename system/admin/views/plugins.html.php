<?php if (!defined('HTMLY')) die('HTMLy'); ?>


<form method='POST'>
	<p>
	<label class="col-sm-2 col-form-label"><?php echo i18n('Enabled'); ?></label>
	</p>

	<input type="hidden" name="csrf_token" value="<?php echo get_csrf() ?>">
	<input type="hidden" id= "plugin_disable" name="plugin_disable" value="">
	<input type="hidden" id= "plugin_enable" name="plugin_enable" value="">

	<table class="table post-list">
		<thead>
		<tr class="head">
			<th><?php echo i18n('Name');?></th>
			<th><?php echo i18n('Disable');?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($plugins_registry as $key => $plugin): ?>
			<tr>
				<td><a href="<?php echo site_url();?>admin/plugin/<?php echo $key; ?>" class="nav-link"><?php echo $plugin->name(); ?></a></td>
				<td>
					<button type='submit' class="btn btn-danger btn-xs" onclick="javascript: document.getElementById('plugin_disable').setAttribute('value', '<?php echo $key?>');">
						<?php echo i18n('Disable');?>
					</button>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

	<p>
	<label class="col-sm-2 col-form-label"><?php echo i18n('Disabled'); ?></label>
	</p>

	<table class="table post-list">
		<thead>
		<tr class="head">
			<th><?php echo i18n('Name');?></th>
			<th><?php echo i18n('Enable');?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($plugins_all as $key => $plugin): ?>
			<?php if (!isset($plugins_registry[$plugins_all[$key]])): ?>
			<tr>
				<td><a href="<?php echo site_url();?>admin/plugin/<?php echo $plugins_all[$key]; ?>" class="nav-link"><?php echo $plugins_all[$key]; ?></a></td>
				<td>
					<button type='submit' class="btn btn-primary btn-xs" onclick="javascript: document.getElementById('plugin_enable').setAttribute('value', '<?php echo $plugins_all[$key]; ?>');">
						<?php echo i18n('Enable');?>
					</button>
				</td>
			</tr>
			<?php endif; ?>
		<?php endforeach; ?>
		</tbody>
	</table>
</form>
