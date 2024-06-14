<?php if (!defined('HTMLY')) die('HTMLy'); ?>

<?php if (login()) { ?>
	
    <?php 
		echo '<h2>' . $plugin_name . '</h2>';
	?>

<form method="POST">
	<input type="hidden" name="csrf_token" value="<?php echo get_csrf(); ?>">
	<?php
		echo $plugin->admin_show_form();
	?>

</form>

<?php } ?>