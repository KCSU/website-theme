<?php
/**
 * The template for displaying all pages.
 *
 * @package KCSU
 * @file page.php
 * @author Conor Burgess <Burgess.Conor@gmail.com>
 * @license BSD 3-Clause
 *
 */

get_header(); ?>
<div class="container">
    <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'content', 'page' ); ?>

    <?php endwhile; // end of the loop. ?>
</div>
<?php get_footer(); ?>