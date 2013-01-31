<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package KCSU
 * @file content-page.php
 * @author Conor Burgess <Burgess.Conor@gmail.com>
 * @license BSD 3-Clause
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
        <?php edit_post_link( 'Edit', '<span class="btn edit-link">', '</span>' ); ?>
	</header><!-- .entry-header -->
    
	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	<footer class="entry-meta">
		
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
