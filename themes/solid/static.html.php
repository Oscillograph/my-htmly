<?php if (!defined('HTMLY')) die('HTMLy'); ?>

<?php if (login()) { echo tab($p); } ?>
<span class="paper-title"><?php echo $p->title;?></span>
<!-- .entry-header -->

<?php echo $p->body;?>
<!-- .entry-content -->
    
<!-- #post-## -->

<p>&nbsp;</p>
<hr>

<!--
<nav role="navigation" class="navigation post-navigation">
    <h2 class="screen-reader-text">Post navigation</h2>
    <div class="nav-links">
        <?php if (!empty($prev)): ?>
            <div class="nav-previous"><a rel="prev" href="<?php echo($prev['url']); ?>"><span aria-hidden="true" class="meta-nav"><?php echo i18n('Next');?></span> <span class="screen-reader-text">Previous post:</span> <span class="post-title"><?php echo($prev['title']); ?></span></a></div>
        <?php endif;?>
        <?php if (!empty($next)): ?>
            <div class="nav-next"><a rel="next" href="<?php echo($next['url']); ?>"><span aria-hidden="true" class="meta-nav"><?php echo i18n('Prev');?></span> <span class="screen-reader-text">Next post:</span> <span class="post-title"><?php echo($next['title']); ?></span></a></div>
        <?php endif;?>
    </div>
</nav>
-->