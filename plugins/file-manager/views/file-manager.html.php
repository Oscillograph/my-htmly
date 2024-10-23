<?php namespace myHTMLy; if (!defined('HTMLY')) die('HTMLy'); ?>

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

</style>

<input type='hidden' id='command'  name='command' value=''>
<input type='hidden' id='description' name='description' value=''>
<hr>
<div class='toolbar'>
<span style='width: 10%'>Адрес:</span> <input id='current-path' name='current-path' style='width: 80%' type=text size=1024 value='<?php echo $path; ?>'>
<input style='width: 10%' type='submit' value='Перейти'>
</div>

<div class='toolbar'>
	<ul>
		<li><img src='<?php echo site_url() . 'plugins/file-manager/img/png/btn-file.png'; ?>' alt='[New File...]' title='Новый файл...' onclick='javascript: submitForm(this, "new-file");'></li>
		<li><img src='<?php echo site_url() . 'plugins/file-manager/img/png/btn-folder.png'; ?>' alt='[New Directory...]' alt='Новая папка...' onclick='javascript: submitForm(this, "new-folder");'></li>
		
		<img src='<?php echo site_url() . 'plugins/file-manager/img/png/btn-separator.png'; ?>' alt='|'>
		<li><img src='<?php echo site_url() . 'plugins/file-manager/img/png/btn-copy.png'; ?>' alt='[Copy]' title='Копировать' onclick='javascript: submitForm(this, "copy");'></li>
		<li><img src='<?php echo site_url() . 'plugins/file-manager/img/png/btn-move.png'; ?>' alt='[Move...]' title='Переместить...' onclick='javascript: submitForm(this, "move to");'></li>
		
		<img src='<?php echo site_url() . 'plugins/file-manager/img/png/btn-separator.png'; ?>' alt='|'>
		<li><img src='<?php echo site_url() . 'plugins/file-manager/img/png/btn-edit.png'; ?>' alt='[Edit...]' title='Править...' onclick='javascript: submitForm(this, "edit");'></li>
		<li><img src='<?php echo site_url() . 'plugins/file-manager/img/png/btn-rename.png'; ?>' alt='[Rename...]' title='Переименовать...' onclick='javascript: submitForm(this, "rename");'></li>
		
		<img src='<?php echo site_url() . 'plugins/file-manager/img/png/btn-separator.png'; ?>' alt='|'>
		<li><img src='<?php echo site_url() . 'plugins/file-manager/img/png/btn-download.png'; ?>' alt='[Download]' title='Скачать' onclick='javascript: submitForm(this, "download");'></li>
		<li><img src='<?php echo site_url() . 'plugins/file-manager/img/png/btn-upload.png'; ?>' alt='[Upload...]' title='Загрузить...' onclick='javascript: document.getElementById("file-box").style.display = (document.getElementById("file-box").style.display == "block") ? "none" : "block";'></li>
		<!--
		<li><img src='<?php echo site_url() . 'plugins/file-manager/img/png/btn-zip.png'; ?>' alt='[Archive...]' title='Архивировать...'></li>
		-->

		<img src='<?php echo site_url() . 'plugins/file-manager/img/png/btn-separator.png'; ?>' alt='|'>
		<li><img src='<?php echo site_url() . 'plugins/file-manager/img/png/btn-delete.png'; ?>' alt='[Delete]' title='Удалить' onclick='javascript: submitForm(this, "delete");'></li>
		<!--
		<li>[To Trashbox]
		<li>[Clear Trash]
		<li>[Restore] 
		-->
	</ul>

	<div id='file-box' style='text-align: center; display:none; border: 1px solid white;'>
		<input type='file' id='upload' name='upload' style='width: 13em;'>
		<input type='button' value='Отправить' onclick='javascript: submitForm(this, "upload");'>
	</div>
</div>

<div>
	<table style='width:100%; border: 1px solid black'>
		<tr style='background-color: #444444; color: #efefef; font-weight: 700'>
			<td style='text-align: center; width:2em'><input type='checkbox' id='file-select-all' name='file-select-all' class='select' value='' onclick='javascript: selectAll();'></td>
			<td style='padding-left: 1em;; width:50%; max-width: 550px'>Имя</td>
			<td>Размер</td>
			<td>Дата изменения</td>
			<td>CHMOD</td>
		</tr>
		<!-- directories first -->
		<?php foreach($dirContents as $item): ?>
		<?php if ($item === '.') continue; $itempath = $path . '/' . $item; ?>
		<?php if (is_dir($itempath)): ?>
		<tr class='fileman_item'>
			<td style='background-color: #afafaf; text-align: center'><input type='checkbox' name='file-selected[]' class='select' value='<?php echo $itempath; ?>'></td>
			<td style='padding-left: 1em; font-weight: 700; border-right: 1px solid black'' onclick='javascript: submitForm(this, "<?php if ($item === '..') { echo 'up'; } else { echo 'open folder'; } ?>"); return;'><?php echo $item; ?></td>
			<td style='padding: 0 0.25em; border-right: 1px solid black'><?php if(file_exists($itempath)) { echo filesize($itempath); } ?></td>
			<td style='padding: 0 0.25em; border-right: 1px solid black'><?php if(file_exists($itempath)) echo date('d.m.Y - H:i:s', filemtime($itempath)); ?></td>
			<td style='padding: 0 0.25em; border-right: 1px solid black'><?php if(file_exists($itempath)) echo substr(sprintf('%o', fileperms($itempath)), -4); ?></td>
		</tr>
		<?php endif; ?>
		<?php endforeach; ?>

		<!-- files next -->
		<?php foreach($dirContents as $item): ?>
		<?php if ($item === '.') continue; $itempath = $path . '/' . $item; ?>
		<?php if (!is_dir($itempath)): ?>
		<tr class='fileman_item'>
			<td style='background-color: #afafaf; text-align: center'><input type='checkbox' name='file-selected[]' class='select' value='<?php echo $itempath; ?>'></td>
			<td style='padding-left: 1em; border-right: 1px solid black'  onclick='javascript: submitForm(this, "<?php echo 'edit'; ?>"); return;'><?php echo $item; ?></td>
			<td style='padding: 0 0.2em; border-right: 1px solid black'><?php if(file_exists($itempath)) { echo filesize($itempath); } ?></td>
			<td style='padding: 0 0.2em; border-right: 1px solid black'><?php if(file_exists($itempath)) echo date('d.m.Y - H:i:s', filemtime($itempath)); ?></td>
			<td style='padding: 0 0.2em; border-right: 1px solid black'><?php if(file_exists($itempath)) echo substr(sprintf('%o', fileperms($itempath)), -4); ?></td>
		</tr>
		<?php endif; ?>
		<?php endforeach; ?>
	</table>
</div>

<script type='text/javascript'>
	function selectAll()
	{
		checkboxes = document.getElementsByClassName('select');
		selectAllStatus = document.getElementById('file-select-all').checked;
		for (i = 0; i < checkboxes.length; ++i)
		{
			checkboxes[i].checked = selectAllStatus;
		}
	}

	function sendForm(command, description)
	{
		// commands: 
		// 'up' - browser upper folder into what is in $_POST['current-path']
		// 'open folder'  browse into a folder from $_POST['file-selected']
		// 'move to' - move a file/folder from $_POST['file-selected'] to what is in $_POST['description']
		// 'edit' - edit a file from $_POST['file-selected']
		// 'copy' - edit a file from $_POST['file-selected']
		// 'rename' - rename a file from $_POST['file-selected'] to $_POST['description']
		// 'zip' - archive files from $_POST['file-selected'] into $_POST['description']

		document.getElementById('command').setAttribute('value', command);
		document.getElementById('description').setAttribute('value', description);
		document.getElementsByTagName('form')[1].submit();
	}

	function submitForm(obj, command)
	{
		var description = '';

		switch (command)
		{
			case 'up': 
				{
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
				break;
			case 'open folder': 
				{
					// get old path
					current_path = document.getElementById('current-path').getAttribute('value');

					// make a new path of it
					new_path = current_path + '/' + obj.innerHTML;

					//set new path
					document.getElementById('current-path').setAttribute('value', new_path);
				}
				break;
			case 'new-file':
				{
					fileName = prompt('Введите название нового файла:', '');
					if (fileName.length == 0)
					{
						fileName = 'New File.txt';
					}

					description = fileName;
				}
				break;
			case 'new-folder':
				{
					folderName = prompt('Введите название новой папки:', '');
					if (folderName.length == 0)
					{
						folderName = 'New Folder';
					}

					description = folderName;
				}
				break;
			case 'copy': 
				{
				}
				break;
			case 'move to': 
				{
					folderName = prompt('Введите название папки, в которую нужно переместить выделенные файлы:', '');
					if (folderName.length == 0)
					{
						folderName = document.getElementById('current-path').getAttribute('value');
					}

					description = folderName;
				}
				break;
			case 'edit': 
				{
					// get old path
					current_path = document.getElementById('current-path').getAttribute('value');

					// make a new path of it
					new_path = current_path + '/' + obj.innerHTML;

					//set new path
					document.getElementById('current-path').setAttribute('value', new_path);
				}
				break;
			case 'rename': 
				{
					fileName = prompt('Введите новое название файла:', '');
					if (fileName.length == 0)
					{
						fileName = 'New File.txt';
					}
					description = fileName;
				}
				break;
			case 'upload': 
				{
				}
				break;
			case 'download': 
				{
				}
				break;
			case 'zip': 
				{
				}
				break;
			case 'delete': 
				{
				}
				break;
		}

		sendForm(command, description);
	}
</script>