<?php
/**
 * The main template file.
 *
 * @package KCSU
 * @file index.php
 * @author Conor Burgess <Burgess.Conor@gmail.com>
 * @author Gideon Farrell <me@gideonfarrell.co.uk>
 * @license BSD 3-Clause
 *
 */

get_header(); ?>
		<div id="primary" class="container">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title">Nothing Found</h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p>Apologies, but no results were found for the requested archive.</p>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->
<?php get_footer(); ?>