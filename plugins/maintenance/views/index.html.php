<?php if (!defined('HTMLY')) die('HTMLy'); ?>
<!DOCTYPE html>
<html lang="<?php echo blog_language();?>">
<head>
	<base href='<?php echo site_url(); ?>'>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
    <meta name="robots" content="noyaca"/>
    <meta name="robots" content="noindex"/>
    <title>Сайт в разработке.</title>
    <style>
		body
		{
			background-image: url(<?php echo site_url(); ?>files/games/html/common/background.jpg);
			background-size: cover;
			background-repeat: no-repeat;
			background-color: #000000;
		}
		.content 
		{
			width: 100%;
			height: 100%;
		}
		.content tr td
		{
			vertical-align: middle; 
			text-align: center;
		}
		.caption
		{
			font-size: 12pt;
			background-color: #000000; 
			opacity: 0.7; 
		}
		h1
		{
			color: #afffff;
		}

		.text
		{
			margin: 5px;
			padding: 5px;
			max-width: 800px;
			background-color: #000000;
			text-align: center;
			opacity: 0.7;
		}

		p
		{
			color: #afffff;
		}
		.blocked
		{
			display: none;
		}
		.thinker
		{
			width: 20%;
		}

		a:hover
		{
			color: #ffffff;
		}

		a:visited
		{
			color: #ffffff;
		}

		a:link
		{
			color: #ffffff;
		}

		a:active
		{
			color: #ffffff;
		}
	</style>
</head>

<body>
<center>
    <table class='content'>
        <tr>
            <td class='caption'>
                <h1>Сайт на техобслуживании.</h1>
            </td>
        </tr>
        <tr>
            <td>
                <img src='files/images/thinking.png' class='thinker'>
                <p class='blocked'>(С 2005-го?)</p>
            </td>
        </tr>
        <tr>
            <td>
                <center>
                    <div class='text'>
                        <p>Пока можно покоротать время с <a href='./games/html/arcanoid/' target='_self'>Арканоидом</a> (сделан на Phaser v3.80 для игры с ПК).</p>
                    </div>
                </center>
            </td>
        </tr>
        <tr>
            <td class='caption, blocked'>
                <p>C++, Nau Engine, моделирование, писательское дело и другие развлечения.</p>
            </td>
        </tr>
    </table>
</center>
</body>
</html>


