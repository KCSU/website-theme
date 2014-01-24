<?php
/**
 * Single post template
 * 
 * @package KCSU
 * @file    single.php
 * @author  Gideon Farrell <me@gideonfarrell.co.uk>
 * @license BSD 3-Clause
 */

get_header();


while(have_posts()): the_post();

if(in_category('news')) {
    include('single-news.php');
}
else if(in_category('access')) {
    include('single-access.php');
}
else
{
?>
<div class="container news post">
<header>
<h1><?php the_title(); ?></h1>
<p>Posted <span class="date relative" title="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('Y/m/d H:i:s'); ?></span> by <span class="author"><?php the_author_link(); ?></span></p>
</header>
<hr />
<div class="row">
<div class="span8">
<article>
<?php the_content(); ?>
</article>
</div>
</div>
</div>
<?php
}

endwhile;

get_footer();
?>