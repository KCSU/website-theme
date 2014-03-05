<?php
    
    /**
     * Template Name: Events
     * Description: A Page Template to display the events.
     */
    
    ?>
<?php
    /**
     * Eents list page
     *
     * @package KCSU
     * @file    events.php
     * @author  Gideon Farrell <me@gideonfarrell.co.uk>
     * @license BSD 3-Clause
     */
    get_header();
    
    ?>

<div class="container">
<div class="row">
<!-- Events -->
<div id="EventsColumn">
<h2>Coming Up</h2>
<ul class="posts-list posts events">
<?php
    $events = kcsu_get_upcoming_events(date('Ymd', strtotime('+2 months')));
    
    foreach ($events as $event)
    {
        echo string_format(
                           '<li><!-- {id} --><a href="{link}" title="{title}">{title}</a> <span class="aux date">{date}</span><span class="aux"> - </span><span class="aux location">{location}</span></li>',
                           $event
                           );
    }
    ?>
</ul>
</div>
</div>
</div>

<?php get_footer(); ?>