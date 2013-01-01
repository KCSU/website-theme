<?php 
    /**
     * Template Name: Home
     * Description: A Page Template for the home page
     *
     * @package KCSU
     * @file page-home.php
     * @author  Gideon Farrell <me@gideonfarrell.co.uk>
     * @license BSD 3-Clause
     *
     */    

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content' , 'home'); ?>

				<?php endwhile; // end of the loop. ?>

                <h1 class="entry-title">Latest News:</h1>
                <?php query_posts('posts_per_page=10'); ?>
                <?php while (have_posts()) : the_post();?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                   	<header class="entry-header">
                        <h1 class="entry-title entry-title-home"><a href="<?php the_permalink(); ?>" title="<?php printf( 'Permalink to %s', the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                        </h1>

                        <?php if ( 'post' == get_post_type() ) : ?>
                        <div class="entry-meta-home entry-meta">
                            <?php kcsu_posted_on(); ?>
                        </div><!-- .entry-meta -->
                        <?php endif; ?>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <?php the_advanced_excerpt('length=100&use_words=1&no_custom=1&ellipsis=%26hellip;&finish_word=1&finish_sentence=1&read_more=Continue%20Reading&add_link=1'); ?>
                    </div><!-- .entry-summary -->

                </article><!-- #post-<?php the_ID(); ?> -->
                <?php endwhile; ?>
                
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>