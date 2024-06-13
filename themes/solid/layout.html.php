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
	<base href='<?php echo site_url(); ?>'>
    <?php echo head_contents();?>
    <title><?php echo $title;?></title>
    <meta name="description" content="<?php echo $description; ?>"/>
    <link rel="canonical" href="<?php echo $canonical; ?>" />
    <link rel="icon" type="image/png" href="<?php echo theme_path();?>img/favicon.png" />
    <?php echo $metatags;?>
    <link rel="stylesheet" id="genericons-css"  href="<?php echo theme_path();?>genericons/genericons.css" type="text/css" media="all" />
	<style>
		body {
			background-image:url(<?php echo site_url(); ?>files/games/html/common/background.jpg);
			background-repeat: no-repeat;
			background-size: 100% auto;
			background-attachment: fixed;
		}
	</style>
    <link rel="stylesheet" href="<?php echo theme_path();?>css/style.css" type="text/css" media="all" />
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
					<!--
					<li class='nav-item'>
						<a href='#'>Софт</a>
						<ul class='submenu'>
							<li class='nav-item'>
								<a href='#'>Движки и фреймворки</a>
								<ul class='submenu2'>
									<li class='nav-item'>
										<a href='#'>Crystal Serpent Engine</a>
									</li>
									<li class='nav-item'>
										<a href='#'>Savannah</a>
									</li>
									<li class='nav-item'>
										<a href='#'>Blazing Serpent Engine</a>
									</li>
								</ul>
							</li>
							<li class='nav-item'>
								<a href='#'>Игры</a>
								<ul class='submenu2'>
									<li class='nav-item'>
										<a href='#'>Арканоид</a>
									</li>
									<li class='nav-item'>
										<a href='#'>Волейбол</a>
									</li>
								</ul>
							</li>
							<li class='nav-item'>
								<a href='#'>Исследовательское ПО</a>
							</li>
							<li class='nav-item'>
								<a href='#'>Утилиты</a>
							</li>
						</ul>
					</li>
					-->
					<!--
					<li class='nav-item'>
						<a href='blog'>Блог</a>
						<ul class='submenu'>
							<li class='nav-item'>
								<a href='category/webdev'>Вебдев</a>
							</li>
							<li class='nav-item'>
								<a href='category/gamedev'>Геймдев</a>
							</li>
							<li class='nav-item'>
								<a href='category/notes'>Заметки</a>
							</li>
							<li class='nav-item'>
								<a href='category/cyber-archaeology'>Кибер-археология</a>
							</li>
							<li class='nav-item'>
								<a href='category/culture'>Культура</a>
							</li>
							<li class='nav-item'>
								<a href='category/writing'>Писательство</a>
							</li>
							<li class='nav-item'>
								<a href='category/radiotehnika'>Радиотехника</a>
							</li>
							<li class='nav-item'>
								<a href='category/self-enlightenment'>Саморазвитие</a>
							</li>
						</ul>
					</li>
					-->

					<li class='nav-item'>
						<a href="blog">Блог</a>
						<?php echo adv_category_list() ?>
					</li>
					<!--
					<li class='nav-item'>
						<a href='#'>Радиовидение</a>
						<ul class='submenu'>
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
								<li><a href='mailto:kvk-tech@mail.ru'>Электронная почта</a>
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

<script type="text/javascript" src="<?php echo theme_path();?>js/page-postprocessing.js"></script>
<?php if (analytics()): ?><?php echo analytics() ?><?php endif; ?>