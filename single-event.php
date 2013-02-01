<?php
/**
 * Single post template for events
 * 
 * @package KCSU
 * @file    single_events.php
 * @author  Gideon Farrell <me@gideonfarrell.co.uk>
 * @license BSD 3-Clause
 */

get_header();

while(have_posts()): the_post();
$custom_fields = get_post_custom();
?>

<div class="container events post">
    <header>
        <h1><?php the_title(); ?></h1>
    </header>
    <hr/>
    <div class="row">
        <div class="span8">
            <article>
                <?php the_content(); ?>
            </article>
        </div>
        <div class="span4">
            <section class="events extra">
                <div>
                    <p class="date"><?php echo get_the_date('l, jS F Y, H:i'); ?></p>
                    <p class="location"><?php echo $custom_fields['location'][0]; ?></p>
                </div>
            </section>
            <section class="roll events">
                <h2>Coming up</h2>
                <ul class="posts-list events">
                <?php
                # Need to loop through posts with post-type = events
                # Importantly need to insert date filtering
                query_posts( array (
                   'posts_per_page' => 10,
                   'order'          => 'ascending',
                   'post_type'      => 'event' 
                   ) );

                while (have_posts()) {
                    the_post();
                    echo string_format(
                        '<li><!-- {id} --><a href="{link}" title="{title}">{title}</a> <span class="aux date">{date}</span></li>',
                        array(
                            'id'    =>  get_the_ID(),
                            'link'  =>  get_permalink(),
                            'title' =>  get_the_title(),
                            'date'  =>  get_the_date('d/m/Y')
                            )
                        );
                }

                remove_filter('posts_where', 'kcsu_events_filter_where');
                wp_reset_query();
                ?>
                </ul>
            </section>
        </div>
</div>

<?php endwhile; get_footer(); ?>