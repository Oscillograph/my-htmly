<?php if (!defined('HTMLY')) die('HTMLy'); ?>
<?php plugins_frontend_theme_start(); ?>
<!DOCTYPE html>
<html lang="<?php echo blog_language();?>">
<head>
	<base href='<?php echo site_url(); ?>'>
    <?php echo adv_head_contents();?>
    <title><?php echo $title;?></title>
    <meta name="description" content="<?php echo $description; ?>"/>
	<meta name="keywords" content="<?php echo adv_blog_keywords(); ?>"/>
    <link rel="canonical" href="<?php echo $canonical; ?>" />
    <link rel="icon" type="image/png" href="<?php echo theme_path();?>img/favicon.png" />
    <?php echo $metatags;?>
    <link rel="stylesheet" id="genericons-css"  href="<?php echo theme_path();?>genericons/genericons.css" type="text/css" media="all" />
	<style>
		body {
			background-image:url(<?php echo theme_path(); ?>img/background.jpg);
			background-repeat: no-repeat;
			background-size: 100% auto;
			background-attachment: fixed;
		}
	</style>
    <link rel="stylesheet" href="<?php echo theme_path();?>css/style.css" type="text/css" media="all" />

	<?php plugins_frontend_theme_header(); ?>
</head>
<body>
	<?php if (login()) { toolbar(); } ?>
		<div class='page-container'>

			<!-- Headbar -->
			<div class='headbar'>
				<ul class='mainmenu'>
					<li class='nav-item'>
						<a href='<?php echo site_url(); ?>'>Главная</a>
					</li>

					<li class='nav-item'>
						<a href="blog">Блог</a>
						<?php echo adv_category_list() ?>
					</li>
					<!--
					<li class='nav-item'>
						<a href='#'>Радиовидение</a>
						<ul class='submenu'>
							<li class='nav-item'>
								<a href='#'>Разное</a>
							</li>
							<li class='nav-item'>
								<a href='#'>Моделирование</a>
							</li>
							<li class='nav-item'>
								<a href='#'>Формирование РЛИ</a>
							</li>
							<li class='nav-item'>
								<a href='#'>Компенсация движения</a>
							</li>
							<li class='nav-item'>
								<a href='#'>Автофокусировка</a>
							</li>
						</ul>
					</li>
					-->
					<li class='nav-item'>
						<a href='stream' class='headbar-item'>Стрим</a>
					</li>
					<li class='nav-item'>
						<a href='files' class='headbar-item'>Файлы</a>
					</li>
					<!--
					<li class='nav-item'>
						<a href='forum' class='headbar-item'>Сообщество</a>
					</li>
					-->
				</ul>
				<ul class='mainmenu-right'>
					<li class='nav-item'>
						<a href='about' class='headbar-item'>Об авторе</a>
					</li>
				</ul>
			</div>
			<hr>


			<!-- Page content -->
			<div class='content'>
				<div class='mainsection' id='mainsection'>
					<?php echo content();?>
				</div>
			</div>

			<!-- Footer -->
			<div class='footer'>
				<table cellspacing=0 cellpadding=0>
					<tr>
						<td class='footer-section'>
							<div class='header'>Контакты</div>
							<ul>
								<li><a href='https://github.com/Oscillograph' target='_blank'>Github</a></li>
								<li><a href='https://t.me/kvktechchannel' target='_blank'>Канал в Telegram</a></li>
<!--								<li><a href='https://vk.com/totcreativelabs' target='_blank'>VKontakte</a></li>-->
								<li><a href='mailto:admin@kvk-tech.ru'>Электронная почта</a>
							</ul>
						</td>
						<td class='footer-section'>
							<div class='header'>Метки</div>
							<p><?php echo adv_tag_cloud();?></p>
						</td>
						<td class='footer-section'>
							<div class='header'>Дружбанские ссылки</div>
							<ul>
								<li><a href='http://sf.fancon.ru/' target='_blank'>Открытый конкурс научной фантастики</a></li>
								<li><a href='https://conkings.com/' target='_blank'>Короли созвездий &#8211; онлайн-стратегия</a></li>
								<li><a href='http://rpg-zone.ru/' target='_blank'>RPG-Zone.ru &#8211; форум о ролевых и настолках</a></li>
							</ul>
						</td>
						<td class='footer-section-right'>
							<div class='header'>О сайте</div>
							<p><?php echo copyright();?><br>
							Сайт оптимизирован для работы на ПК.</p>
						</td>
					</tr>
				</table>
			</div>

		</div>
	</body>
</html>

<?php plugins_frontend_theme_footer(); ?>
<?php if (analytics()): ?><?php echo analytics() ?><?php endif; ?>