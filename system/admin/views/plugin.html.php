<?php if (!defined('HTMLY')) die('HTMLy'); ?>

<?php if (login()) { ?>
	
<h2><a href='<?php echo site_url(); ?>admin/plugins'><?php echo i18n('Plugins'); ?></a> » <?php echo $plugin_name; ?></h2>

<form method="POST">
	<input type="hidden" name="csrf_token" value="<?php echo get_csrf(); ?>">
	<?php
		echo $plugin->admin_show_form();
	?>

</form>

<?php } ?>