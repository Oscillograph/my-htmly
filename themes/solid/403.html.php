<?php namespace myHTMLy; if (!defined('HTMLY')) die('HTMLy'); ?>
<article class="page type-page hentry">
    <header class="entry-header">
        <h1 class="entry-title"><span>403 -- доступ к этому разделу сайта запрещён</span></h1>
    </header>
    <div class="entry-content">
        <p>Пожалуйста, воспользуйтесь поиском или перейдите на <a href="<?php echo site_url() ?>">главную</a> страницу.</p>
        <form class="search-form" role="search" action="<?php echo site_url(); ?>">
            <label>
                <span class="screen-reader-text">Search for:</span>
                <input type="search" title="Search for:" name="search" value="" placeholder="Search …" class="search-field">
            </label>
            <button class="search-submit" type="submit"><span class="screen-reader-text">Search</span></button>
        </form>
    </div>
</article>