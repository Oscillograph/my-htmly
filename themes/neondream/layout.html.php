<?php if (!defined('HTMLY')) die('HTMLy'); ?>
<?php
include('sidebar-plugin-start.php');
include('sidebar-plugin-head.php');
include('sidebar-plugin-body.php');
include('sidebar-plugin-end.php');
?>
<!DOCTYPE html>
<html lang="<?php echo blog_language();?>">
<head>
    <?php echo head_contents();?>
    <title><?php echo $title;?></title>
    <meta name="description" content="<?php echo $description; ?>"/>
    <link rel="canonical" href="<?php echo $canonical; ?>" />
    <link rel="icon" type="image/png" href="<?php echo theme_path();?>img/favicon.png" />
    <?php echo $metatags;?>
    <link rel="stylesheet" id="genericons-css"  href="<?php echo theme_path();?>genericons/genericons.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo theme_path();?>css/style.css" type="text/css" media="all" />
	<style>
		body 
		{
			background-image: url("<?php echo theme_path(); ?>img/background.jpg");
			background-size: cover;
			background-repeat: no-repeat;
			background-color: #000000;
		}
	</style>
</head>
<body>
	<?php if (login()) { toolbar(); } ?>
	<table class='outer-glow-pink'><tr><td>
		<table class='inner-glow'><tr><td>
			<table class='outer-glow-pink'><tr>

			<td class='titlebar'>
				&nbsp;<a href="<?php echo site_url();?>" rel="home"><?php echo blog_title();?></a>
			</td>

			<td class='navbar'>
<!--				<ul class='nav-list'>-->
					<!-- Static pages -->
					<!--<button id="menu-toggle" class="menu-toggle">Menu</button>-->
					<?php $primaryMenu = menu('primary-menu'); echo $primaryMenu;?>

					<!-- Separator -->
					<!-- <span class="nav-separator">&nbsp;|&nbsp;</span>-->

					<!-- Social Networks -->
<!--				</ul>-->
			</td>

			</tr></table>
		</td></tr></table>
	</td></tr></table>

	<table class='outer-glow-yellow'><tr><td>
		<table class='inner-glow'><tr><td>
			<table class='outer-glow-yellow'><tr>
				<td class='content'>

					<div class='sidebar outer-glow-yellow'>
						<?php echo sidebar_plugin_start_html(); ?>
						<?php echo sidebar_plugin_head_html(); ?>
							<span>Поиск по сайту</span>
						<?php echo sidebar_plugin_body_html(); ?>
							<form role="search">
							<label>
								<input type="search" placeholder="<?php echo i18n("Search");?> &hellip;" value="" name="search" title="<?php echo i18n("Search_for");?>:" />
							</label>
							<button type="submit">Искать</button>
							</form>
						<?php echo sidebar_plugin_end_html(); ?>
						
						<?php echo sidebar_plugin_start_html(); ?>
						<?php echo sidebar_plugin_head_html(); ?>
							<?php echo i18n("Categories");?>
						<?php echo sidebar_plugin_body_html(); ?>
							<?php echo category_list() ?>
						<?php echo sidebar_plugin_end_html(); ?>
						
						<?php echo sidebar_plugin_start_html(); ?>
						<?php echo sidebar_plugin_head_html(); ?>
							<?php echo i18n("Tags");?>
						<?php echo sidebar_plugin_body_html(); ?>
							<?php echo tag_cloud();?>
						<?php echo sidebar_plugin_end_html(); ?>

						<?php echo sidebar_plugin_start_html(); ?>
						<?php echo sidebar_plugin_head_html(); ?>
							Дружбанские ссылки
						<?php echo sidebar_plugin_body_html(); ?>
						<center>
							<a href="http://sf.fancon.ru/">Открытый конкурс НФ</a><br>
							<a href="http://conkings.com/">Короли Созвездий</a>
						</center>
						<?php echo sidebar_plugin_end_html(); ?>
					</div>

                    <main id="main" class="site-main" role="main">
                        <?php echo content();?>
                    </main><!-- .site-main -->
				</td>
			</tr></table>
		</td></tr></table>
	</td></tr></table>

	<table class='outer-glow-blue'><tr><td>
		<table class='inner-glow'><tr><td>
			<table class='outer-glow-blue'><tr>
			<td class='content' style='text-align: center'>
                <table id='footer'>
                    <tr>
                        <td>
							<p class='paper-title'>Контакты</p>
							<?php echo social();?>
							<!--
                            <p>Telegram: Broscillograph</p>
                            <p>Github: <a href='https://github.com/Oscillograph' target='_blank'>Oscillograph</a></p>
                            <p>Почта: <a href='mailto:kvk-tech@mail.ru' target='_blank'>kvk-tech@mail.ru</a></p>
							-->
                        </td>
                        <td><!--
                            <p class='paper-title'>Важные разделы</p>
                            <a href='#' target='_blank'>Об авторе</a><br>
                            <a href='#' target='_blank'>Портфолио</a><br>
                            <a href='#' target='_blank'>Статьи</a><br>
                            <a href='#' target='_blank'>Карта сайта</a><br>
							-->
                        </td>
                        <td>
                            <!--<p class='paper-title'>Колонка три.</p>-->

                        </td>

						<td>
							<p class='paper-title'>Про сайт</p>
							<p>
							<?php echo copyright();?><br />
							Сайт оптимизирован для работы на ПК.<br />
							</p>
						</td>
                    </tr>
                </table>
			</td>
			</tr></table>
		</td></tr></table>
	</td></tr></table>
            </footer><!-- .site-footer -->

    <!--[if lt IE 9]>
    <script type="text/javascript" src="<?php echo theme_path();?>js/html5.js"></script>
    <![endif]-->
    <script type="text/javascript" src="<?php echo theme_path();?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo theme_path();?>js/jquery-migrate.js"></script>
    <script type="text/javascript" src="<?php echo theme_path();?>js/skip-link-focus-fix.js"></script>
    <script type="text/javascript">
    /* <![CDATA[ */
    var screenReaderText = {"expand":"expand child menu","collapse":"collapse child menu"};
    /* ]]> */
    </script>
    <script type="text/javascript" src="<?php echo theme_path();?>js/functions.js"></script>
    <?php if (analytics()): ?><?php echo analytics() ?><?php endif; ?>
</body>
</html>