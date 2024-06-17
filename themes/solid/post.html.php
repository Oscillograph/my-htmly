<?php if (!defined('HTMLY')) die('HTMLy'); ?>
<article class="post <?php if ($p->type == 'post') {echo 'format-standard';} else { echo 'format-' . $p->type;} ?> hentry single">

    <header class="entry-header">
        <?php if (!empty($p->link)) {?>
            <div class="post-link"><h1 class="entry-title"><a target="_blank" href="<?php echo $p->link;?>"><?php echo $p->title;?></a></h1></div>
        <?php } else { ?>
            <span class="paper-title"><?php echo $p->title;?></span>
        <?php } ?>
<br>
	<?php if (authorized($p)) { echo '<span class="edit-link"><a href="'. $p->url .'/edit?destination=post">Edit</a></span>'; } ?>
	<span class="posted-on"><?php echo i18n('Posted_on');?> <time class="entry-date published"><?php echo format_date($p->date) ?></time></span>
    | <b>Рубрика:</b> <?php echo $p->category;?> | 
    <b>Метки: </b> <?php echo $p->tag;?>

    </header><!-- .entry-header -->

    <?php if (!empty($p->image)):?>
        <a href="<?php echo $p->url;?>"><img alt="<?php echo $p->title;?>" src="<?php echo $p->image;?>" width="100%"/></a>
    <?php endif;?>

    <?php if (!empty($p->quote)):?>
        <blockquote><?php echo $p->quote;?></blockquote>
    <?php endif;?>
    <?php if (!empty($p->video)):?>
        <span class="embed-youtube"><iframe width="100%" height="315px" class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo get_video_id($p->video); ?>" frameborder="0" allowfullscreen></iframe></span>
    <?php endif; ?>
    <?php if (!empty($p->audio)):?>
        <span class="embed-soundcloud"><iframe width="100%" height="200px" class="embed-responsive-item" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=<?php echo $p->audio;?>&amp;auto_play=false&amp;visual=true"></iframe></span>
    <?php endif; ?>
    <?php echo $p->body;?>
	<!-- .entry-content -->

    <footer class="entry-footer">

        <?php if (disqus_count()) { ?>
            <span class="comments-link"><a href="<?php echo $p->url ?>#disqus_thread"> <?php echo i18n('Comments');?></a></span>
        <?php } elseif (facebook()) { ?>
            <span class="comments-link"><a href="<?php echo $p->url ?>#comments"><span><fb:comments-count href=<?php echo $p->url ?>></fb:comments-count> <?php echo i18n('Comments');?></span></a></span>
        <?php } ?>

    </footer><!-- .entry-footer -->

</article><!-- #post-## -->

    <?php if (disqus()): ?>
        <?php echo disqus($p->title, $p->url) ?>
    <?php endif; ?>
    
    <?php if (disqus_count()): ?>
        <?php echo disqus_count() ?>
    <?php endif; ?>
    
    <?php if (facebook() || disqus()): ?>
        <div class="comments-area" id="comments">
        
            <h2 class="comments-title"><?php echo i18n('Comments');?> “<?php echo $p->title;?>”</h2>
            
            <?php if (facebook()): ?>
                <div class="fb-comments" data-href="<?php echo $p->url ?>" data-numposts="<?php echo config('fb.num') ?>" data-colorscheme="<?php echo config('fb.color') ?>"></div>
            <?php endif; ?>
            
            <?php if (disqus()): ?>
                <div id="disqus_thread"></div>
            <?php endif; ?>
            
        </div>
    <?php endif; ?>

<nav role="navigation" class="navigation post-navigation">
	<p> &nbsp; </p>
	<hr>
    <div class="nav-links">
		<div class="nav-previous">
        <?php if (!empty($prev)): ?>
            <?php echo i18n('Prev');?> <a rel="prev" href="<?php echo($prev['url']); ?>"><span class="post-title"><?php echo($prev['title']); ?></span></a>
        <?php endif;?>
		</div>
		<div class="nav-next">
        <?php if (!empty($next)): ?>
            <?php echo i18n('Next');?> <a rel="next" href="<?php echo($next['url']); ?>"><span class="post-title"><?php echo($next['title']); ?></span></a>
        <?php endif;?>
		</div>
    </div>
</nav>
<p>&nbsp;</p>
<hr>