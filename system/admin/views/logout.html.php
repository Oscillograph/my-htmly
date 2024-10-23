<?php namespace myHTMLy; if (!defined('HTMLY')) die('HTMLy'); ?>
<?php

unset($_SESSION[site_url()]);

// to prevent further logging in if authorization is set to be disabled
if (file_exists('_login.lock'))
{
	rename('_login.lock', 'login.lock');
}

header('location: login');

?>