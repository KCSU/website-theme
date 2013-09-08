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
                <ul class="where-and-when">
                    <li class="date"><i class="icon-calendar"></i><?php 
                        echo DateTime::createFromFormat('Ymd', get_field('date'))->format('l, jS F Y'); ?></li>
                    <li class="time"><i class="icon-time"></i><?php echo get_field('time'); ?></li>
                    <li class="location"><i class="icon-map-marker"></i><?php echo get_field('location'); ?></li>
                </ul>
            </section>
            <section class="roll events">
                <h2>Coming up</h2>
                <ul class="posts-list events">
                <?php
                    $events = kcsu_get_upcoming_events(date('Ymd', strtotime('+1 month')));
                    
                    foreach ($events as $event)
                    {
                        echo string_format(
                                           '<li><!-- {id} --><a href="{link}" title="{title}">{title}</a> <span class="aux date">{date}</span><span class="aux"> - </span><span class="aux location">{location}</span></li>',
                                           $event
                                           );
                    }
                ?>
                </ul>
            </section>
        </div>
</div>

<?php endwhile; get_footer(); ?>