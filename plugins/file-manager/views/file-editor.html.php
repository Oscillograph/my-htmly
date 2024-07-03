<?php if (!defined('HTMLY')) die('HTMLy'); ?>

<style>
.fileman_item {
	background-color: #ffffff;
	cursor: pointer;
}
.fileman_item:hover {
	background-color: #aaffaa;
}

.selected {
	background-color: #aaffff;
}

.toolbar {
	background-color: #446688;
	text-align: justify;
	vertical-align: middle;
	color: #ffffff;
}

.toolbar a {
	color: #ffffff;
	text-decoration: underline;
}

.toolbar ul {
	margin: 0em;
	padding: 0em 2.5em;
	list-style-type: disc;
	list-style-position: inside;
}

.toolbar ul li {
	display: inline-block;
	padding: 0em 0.25em;
}

.toolbar ul li:hover {
	background-color: #44ffff;
}

textarea {
	width: 100%;
}
</style>

<input type='hidden' id='command'  name='command' value='edit'>
<input type='hidden' id='description' name='description' value=''>
<input type='hidden' id='current-path' name='current-path' value='<?php echo $path; ?>'>
<input type='hidden' id='save' name ='save' value='false'>
<hr>
<div class='toolbar'>
	<a href='admin/plugins/file-manager' onclick='javascript: return submitForm(false);'><< Назад</a><br>
	Открыт файл:<br> <?php echo $path; ?><br>
</div>

<div>
	<textarea rows=15 id='tinymce' name='content'><?php echo htmlspecialchars(file_get_contents($path)); ?></textarea>
</div>
<div>
	<input type='button' value='Сохранить' onclick='javascript: return submitForm(true);'>
</div>

<script type='text/javascript'>
function submitForm(btn)
{
	form = document.getElementsByTagName('form')[1];

	// confirm save
	if (btn)
	{
		document.getElementById('save').setAttribute('value', 'true');
	} else {
		// get old path
		current_path = document.getElementById('current-path').getAttribute('value');
		current_path = current_path.replace(/\\/gi, "/"); // widndows-specific

		// make a new path of it
		path_elements = current_path.split('/');
		new_path = path_elements[0]; 
		for (i = 1; i < (path_elements.length - 1); ++i)
		{
			new_path += '/' + path_elements[i];
		}

		//set new path
		document.getElementById('current-path').setAttribute('value', new_path);
	}

	// submit the form
	form.submit();

	return false;
}
</script>