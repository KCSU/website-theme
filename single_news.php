<?php
/**
 * Single post template for news items
 * 
 * @package KCSU
 * @file    single_news.php
 * @author  Gideon Farrell <me@gideonfarrell.co.uk>
 * @license BSD 3-Clause
 */
?>

<div class="container">
    <article class="news">
        <header>
            <h1><?php the_title(); ?></h1>
            <p>Posted <span class="date relative"><?php echo get_the_date('Y/m/d H:i:s'); ?></span> by <span class="author"><?php echo the_author_link(); ?></span></p>
        </header>

    </article>
</div>