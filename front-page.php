<?php get_header(); ?>

<div class="container">
    <div class="row">
        <!-- News -->
        <div id="NewsColumn" class="span4 home-column">
            <h2>News</h2>
            <img data-src='holder.js/370x150' class='media-object' />
            <?php
                # Need to loop through posts with cat=news
            ?>
        </div>
        <!-- Events -->
        <div id="EventsColumn" class="span4 home-column">
            <h2>Events</h2>
            <img data-src='holder.js/370x150' class='media-object' />
            <?php
                # Need to loop through posts with cat=event?
            ?>
        </div>
        <!-- Other Links -->
        <div id="OtherLinksColumn" class="span4 home-column">
            <h2>Other</h2>
            <img data-src='holder.js/370x150' class='media-object' />
            <?php
                # Need a wordpress menu here, one with links to things like
                #   info for prospective students
                #   formal booking (requires raven)
                #   kords (requires raven)
                #   pnyx (requires raven)
                #   sports and societies
                #   the exec (about us)
                #   KCSU: a history
                #   
                #   other links will go in the navbar
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>