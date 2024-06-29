<?php

class Plugin_FileManager extends Plugin
{
	public function admin_show_form()
	{
		// directory browser window consists of two frames:
		// 1. Upper: toolbar
		// 2. Bottom: directory contents

		// Toolbar provides access to commands:
////////// 1) new file
////////// 2) new directory
////////// 3) rename
////////// 4) edit text file (can't choose if selected more than 1 file or a folder selected)
////////// 5) duplicate file
////////// 6) select a file/directory
////////// 7) move selected to another directory
////////// 8) download selected
////////// 9) upload file
		// 10) archive selected files into a .zip file
////////// 11) delete selected (move to trashbox)
		// 12) clear trashbox
		// 13) view trashbox
		// 14) restore selected from trashbox

		// Directory contents provides:
////////// 1) visual representation of files and folders
////////// 2) selection via checkboxes and/or clicks to certain places
////////// 3) move up/down using names of directories as links ("..", "certain-name123")

		if ($this->mode === 'browser')
		{
			$this->view_form($this->path);
		}
		if ($this->mode === 'editor')
		{
			$this->view_editor($this->path);
		}
?>


<?php
	}

	public function admin_process_form()
	{
		$this->path = from($_REQUEST, 'current-path');
		$command = from($_REQUEST, 'command');
		$description = from($_REQUEST, 'description');
		$selected = [];
		if (isset($_POST['file-selected'])) {
			$selected = $_POST['file-selected'];
		} 

reswitch_command:
		switch ($command)
		{
			// these two options are automated already by the previous work with $_POST['current-path']
			case 'up': 
				{
				}
				break;
			case 'open folder': 
				{
					if (is_file($this->path))
					{
						$command = 'edit';
						goto reswitch_command;
					}
				}
				break;

			case 'new-file':
				{
					$fileName = $description;
					$filePath = $this->path . '/' . $fileName;
					if (!file_exists($filePath))
					{
						file_put_contents($filePath, '');
					}
				}
				break;
			case 'new-folder':
				{
					$folderName = $description;
					$folderPath = $this->path . '/' . $folderName;
					if (!file_exists($folderPath))
					{
						mkdir($folderPath, 0755);
					}
				}
				break;

			case 'move to': 
				{
					if (file_exists($description))
					{
						foreach ($selected as $filePath)
						{
							$oldPath = explode('/', $filePath);
							$fileName = $oldPath[count($oldPath) - 1];
							rename($filePath, $description .'/' . $fileName);
						}
					}
				}
				break;
			case 'copy': 
				{
					foreach ($selected as $filePath)
					{
						if (!is_dir($filePath))
						{
							$newFileName = $filePath;
							$i = 0;
							while (file_exists($newFileName))
							{
								++$i;
								$newFileName = $filePath . ' (' . $i . ')';
							}

							file_put_contents($newFileName, file_get_contents($filePath));
						}
					}
				}
				break;

			case 'edit': 
				{
					if (!isset($_POST['content']))
					{
						if (file_exists($this->path))
						{
							$this->mode = 'editor';
						}
					} else {
						if (from($_REQUEST, 'saved') == 'true')
						{
							file_put_contents($this->path, $_POST['content']);
						}

						$this->mode = 'browser';
					}
				}
				break;
			case 'rename': 
				{
					if (count($selected) > 0)
					{
						if (!file_exists(BASE_DIR . '/' . $description))
						{
							rename($selected[0], BASE_DIR . '/' . $description);
						}
					}
				}
				break;

			case 'upload': 
				{
					$upload = [];

					if ($_FILES)
					{
						if (isset($_FILES['upload']))
						{
							$upload = $_FILES['upload'];
						}
					}
					if ($upload)
					{
						$filename = $this->path . '/' . $upload['name'];
						move_uploaded_file($upload['tmp_name'], $filename);
					}
				}
				break;

			case 'download': 
				{
					foreach($selected as $filePath)
					{
						if (file_exists($this->path)) 
							{
							header('Content-Description: File Transfer');
							header('Content-Type: application/octet-stream');
							header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
							header('Expires: 0');
							header('Cache-Control: must-revalidate');
							header('Pragma: public');
							header('Content-Length: ' . filesize($filePath));
							readfile($filePath);
						}
					}
				}
				break;

			case 'zip': 
				{
				}
				break;
			case 'delete':
				{
					// create trash folder if there is none
					if (!file_exists(BASE_DIR . '/trash'))
					{
						mkdir(BASE_DIR . '/trash', 0755);
					}

					// walk through all selected
					foreach ($selected as $filePath)
					{
						if (file_exists($filePath) && (substr($filePath, -2) !== '..'))
						{
							// if this is a file
							if (is_file($filePath))
							{
								unlink($filePath);
							}

							// if this is a directory
							if (is_dir($filePath))
							{
								$level = 1;
								$done = false;
								$basePath = $filePath;
								$thisPath = $basePath;
								$tempPath = '';
								while (!(($level == 0) && ($done == true)))
								{
									// check if the directory is not empty
									$contents = scandir($thisPath);

									// get rid of the directory contents first
									if (count($contents) > 2)
									{
										// delete all files in the directory or dive deeper into each folder
										foreach($contents as $file)
										{
											if (($file == '.') || ($file == '..')) continue;

											$tempPath = $thisPath . '/' . $file;
											if (!is_dir($tempPath))
											{
												unlink($tempPath);
											}

											// DIVE!
											if (is_dir($tempPath))
											{
												$level++;
												$done = false;
												$thisPath = $thisPath . '/' .  $file;
												break;
											}
										}
									} else {
										// if there are no contents, delete the direcory
										$level--;
										$done = true;
										rmdir($thisPath);

										// change current path
										// $thisPath = str_replace('\\', '/', $thisPath); // windows-specific thing
										$pathElements = explode('/', $thisPath);
										$thisPath = $pathElements[0];
										for ($i = 1; $i < (count($pathElements) - 1); ++$i)
										{
											$thisPath = $thisPath . '/' . $pathElements[$i];
										}
									}
								}
							}
						}
					}
				}
				break;
		}
	}

	public function backend_processor()
	{
	}

	public function frontend_theme_start()
	{
	}

	public function frontend_theme_header()
	{
	}

	public function frontend_theme_content()
	{
	}

	public function frontend_theme_footer()
	{
	}

	public function frontend_theme_end()
	{
	}

	public function name()
	{
		return "Файловый менеджер";
	}

	private function view_form($path = '.')
	{
		if ($path === '.')
		{
			$path = BASE_DIR;
		}
		$dirContents = scandir($path);

		require PLUGINS_BASE_DIR . 'file-manager/views/file-manager.html.php';
	}

	private function view_editor($path = '.')
	{
		if ($path !== '.')
		{
			require PLUGINS_BASE_DIR . 'file-manager/views/file-editor.html.php';
		}
	}

	private $path = '.';
	private $mode = 'browser'; // or 'editor'
}

plugin_register('file-manager', new Plugin_FileManager());