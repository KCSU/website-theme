<?php
    
    require_once('lib/home_side_menu_nav_walker.php');
    get_header();

?>

<div class="container">
    <div class="row">
        <!-- News -->
        <div id="NewsColumn" class="span4 home-column">
            <!-- image header for anything bigger than a phone -->
            <img src="<?php echo get_template_directory_uri(); ?>/img/home_news.png" class='media-object hidden-phone' />
            <!-- on phones just have a title -->
            <h2 class="visible-phone">News</h2>
            <!-- the list -->
            <ul class="posts-list news">
            <?php
                # Need to loop through posts with cat=news
                
                query_posts( array ( 'category_name' => 'news', 'posts_per_page' => 10 ) );
                
                while (have_posts()){
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

                wp_reset_query();
            ?>
            </ul>
        </div>
        <!-- Events -->
        <div id="EventsColumn" class="span4 home-column">
            <!-- image header for anything bigger than a phone -->
                        <img src="<?php echo get_template_directory_uri(); ?>/img/home_events.png" class='media-object hidden-phone' />
                        <!-- on phones just have a title -->
                        <h2 class="visible-phone">Events</h2>
                        <!-- the list -->
            <ul class="posts-list events">
            <?php
                # Need to loop through posts with cat=events
                # TODO: get location of event
                query_posts( array ( 'posts_per_page'   => 10,
                                     'orderby'          => 'date',
                                     'order'            => 'ascending',
                                     'post_type'        => 'event'
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
                wp_reset_query();
            ?>
            </ul>
        </div>
        <!-- Other Links -->
        <div id="OtherLinksColumn" class="span4 home-column">
            <!-- image header for anything bigger than a phone -->
            <img src="<?php echo get_template_directory_uri(); ?>/img/home_about.png" class='media-object hidden-phone' />
            <!-- on phones just have a title -->
            <h2 class="visible-phone">About</h2>
            <!-- the list -->
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
                
                wp_nav_menu( array('theme_location'  => 'home_side_menu',
                                   'container'       => false,
                                   'menu_class'      => 'posts-list',
                                   'depth'           => 2,
                                   'echo'            => true) );
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>