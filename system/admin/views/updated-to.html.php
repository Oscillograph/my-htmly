<?php namespace myHTMLy; ?>
<h3>Updated to<h3>
<h2>[<?php echo $info['tag_name']; ?>] <?php echo $info['name']; ?></h2>
<p><?php echo \Michelf\MarkdownExtra::defaultTransform($info['body']); ?></p>
<?php 
if (file_exists('install.php')) {
    unlink('install.php');
}
?>