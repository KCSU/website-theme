<?php
/**
 * Exec list page
 * 
 * @package KCSU
 * @file    exec.php
 * @author  Gideon Farrell <me@gideonfarrell.co.uk>
 * @license BSD 3-Clause
 */

get_header();
?>

<div class="container">
    <?php
    $args = array( 'post_type' => 'exec', 'posts_per_page' => 1000 ); // infinite posts per page (practically) since we want all the exec
    $loop = new WP_Query( $args );
    while ( $loop->have_posts() ) : $loop->the_post();
    ?>

    <?php
    endwhile;
    ?>
</div>

<?php
get_footer();
?>