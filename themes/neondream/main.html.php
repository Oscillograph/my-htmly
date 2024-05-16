<?php if (!defined('HTMLY')) die('HTMLy'); ?>
<?php if (isset($is_category)):?>
    <header class="page-header">
		<span class="paper-title"><?php echo i18n('Category');?>: <?php echo $category->title;?></span>
		<span class="social-navigation feed-link"><a href="<?php echo $category->url;?>/feed"><span class="screen-reader-text">RSS</span></a></span>
		<div class="taxonomy-description"><?php echo $category->body;?></div>
	</header>
<?php endif;?>
<?php if (isset($is_tag)):?>
    <header class="page-header">
		<span class="paper-title"><?php echo i18n('Tag');?>: <?php echo $tag->title;?></span>
		<span class="social-navigation feed-link"><a href="<?php echo $tag->url;?>/feed"><span class="screen-reader-text">RSS</span></a></span>
	</header>
<?php endif;?>
<?php if (isset($is_archive)):?>
    <header class="page-header">
		<span class="paper-title"><?php echo i18n('Archives');?>: <?php echo $archive->title;?></span>
		<span class="social-navigation feed-link"><a href="<?php echo $archive->url;?>/feed"><span class="screen-reader-text">RSS</span></a></span>
	</header>
<?php endif;?>
<?php if (isset($is_search)):?>
    <header class="page-header">
		<span class="paper-title"><?php echo i18n('Search');?>: <?php echo $search->title;?></span>
		<span class="social-navigation feed-link"><a href="<?php echo $search->url;?>/feed"><span class="screen-reader-text">RSS</span></a></span>
	</header>
<?php endif;?>
<?php if (isset($is_type)):?>
    <header class="page-header">
		<span class="paper-title">Type: <?php echo ucfirst($type->title);?></span>
		<span class="social-navigation feed-link"><a href="<?php echo $type->url;?>/feed"><span class="screen-reader-text">RSS</span></a></span>
	</header>
<?php endif;?>
<?php $teaserType = config('teaser.type'); $readMore = config('read.more');?>
<?php 
$i = 0;
$i_max = count($posts);
foreach ($posts as $p):?>
<article class="post <?php if ($p->type == 'post') {echo 'format-standard';} else { echo 'format-' . $p->type;} ?> hentry single">

    <header class="entry-header">
        <?php if (!empty($p->link)) {?>
            <div class="post-link"><a target="_blank" href="<?php echo $p->link;?>"><span class="paper-title"><?php echo $p->title;?></span></a></div>
        <?php } else { ?>
            <a href="<?php echo $p->url;?>"><span class="paper-title"><?php echo $p->title;?></span></a>
        <?php } ?>
    </header><!-- .entry-header -->

    <?php if (!empty($p->image)):?>
    <a class="post-thumbnail" href="<?php echo $p->url;?>"><img alt="<?php echo $p->title;?>" src="<?php echo $p->image;?>" width="100%"/></a>
    <?php endif;?>

	<?php if (authorized($p)) { echo '<span class="edit-link"><a href="'. $p->url .'/edit?destination=post">Edit</a></span>'; } ?>
	<span class="posted-on"><?php echo i18n('Posted_on');?> <time class="entry-date published"><?php echo format_date($p->date) ?></time></span>
    <b>Рубрика:</b> <?php echo $p->category;?> | 
    <b>Метки: </b> <?php echo $p->tag;?>
        

    <?php if (!empty($p->quote)):?>
        <blockquote><?php echo $p->quote;?></blockquote>
    <?php endif;?>
    <?php if (!empty($p->video)):?>
    <span class="embed-youtube"><iframe width="100%" height="315px" class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo get_video_id($p->video); ?>" frameborder="0" allowfullscreen></iframe></span>
    <?php endif; ?>
    <?php if (!empty($p->audio)):?>
    <span class="embed-soundcloud"><iframe width="100%" height="200px" class="embed-responsive-item" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=<?php echo $p->audio;?>&amp;auto_play=false&amp;visual=true"></iframe></span>
    <?php endif; ?>
    <?php echo get_teaser($p->body, $p->url);?>
    <?php if ($teaserType === 'trimmed'):?>[...] <a class="more-link" href="<?php echo $p->url; ?>"><?php echo $readMore; ?></a><?php endif;?>

    <footer class="entry-footer">
        <?php if (disqus_count()) { ?>
            <span class="comments-link"><a href="<?php echo $p->url ?>#disqus_thread"> <?php echo i18n('Comments');?></a></span>
        <?php } ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
<?php $i++; if ($i != $i_max): ?>
	<p>&nbsp;</p>
	<hr>
<?php endif; ?>

<?php endforeach;?>

<?php if (!empty($pagination['prev']) || !empty($pagination['next'])): ?>
<div class="navigation pagination">
    <div class="nav-links">
        <?php if (!empty($pagination['prev'])): ?>
            <a class="prev page-numbers" href="?page=<?php echo $page - 1 ?>">«</a>
        <?php endif; ?>
        <span class="page-numbers"><?php echo $pagination['pagenum'];?></span>
        <?php if (!empty($pagination['next'])): ?>
            <a class="next page-numbers" href="?page=<?php echo $page + 1 ?>">»</a>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<?php if (disqus_count()): ?>
    <?php echo disqus_count() ?>
<?php endif; ?>