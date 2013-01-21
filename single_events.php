<?php
/**
 * Single post template for events
 * 
 * @package KCSU
 * @file    single_events.php
 * @author  Gideon Farrell <me@gideonfarrell.co.uk>
 * @license BSD 3-Clause
 */
?>

<div class="container">
    <div class="row">
        <article class="events span8">
            <header>
                <h1><?php the_title(); ?></h1>
            </header>

            <div>
                <?php the_content(); ?>
            </div>
        </article>
        <div class="span4">
            <section class="events extra">
                <div>
                    <p class="date"><?php echo get_the_date('l, jS F Y, H:i'); ?></p>
                    <p class="location"><?php /* we need a location */ ?></p>
                </div>
            </section>
            <section class="roll events">
                <h2>Coming up</h2>
                <ul class="posts-list events">
                <?php
                            # Need to loop through posts with cat=events
                            # TODO: get location of event
                add_filter('posts_where', 'kcsu_events_filter_where');
                query_posts( array ( 'category_name'    => 'events',
                   'posts_per_page'   => 10,
                   'post_status'      => 'future',
                   'orderby'          => 'date',
                   'order'            => 'ascending'
                   ) );

                while (have_posts()) {
                    the_post();
                    echo string_format(
                        '<li><!-- {id} --><a href="{link}" title="{title}">{title}</a> <span class="date">{date}</span></li>',
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