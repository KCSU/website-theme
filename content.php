<?php
/**
 * The default template for displaying content
 *
 * @package KCSU
 * @file content.php
 * @author Conor Burgess <Burgess.Conor@gmail.com>
 * @license BSD 3-Clause
 *
 */
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( 'Permalink to %s', the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php kcsu_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>

		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">
		</footer><!-- #entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
