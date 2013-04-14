<?php
    
    require_once('lib/home_side_menu_nav_walker.php');
    get_header();

?>

<div class="container">
    <div class="row">
        <!-- News -->
        <div id="NewsColumn" class="span8 home-column">
            <h2>The Latest</h2>
            <!-- the list -->
            <ul class="posts-list posts news">
            <?php
                # Need to loop through posts with cat=news
                
                query_posts( array ( 'category_name' => 'news', 'posts_per_page' => 10 ) );
                
                while (have_posts()){
                    the_post();
                    echo string_format(
                        '<li>
                            <article><!-- {id} -->
                                <header>
                                    <a href="{link}" title="{title}" class="title">{title}</a>
                                    <span class="aux date">{date}</span>
                                </header>
                                <div class="span7 excerpt">{excerpt}</div>
                            </article><div class="clearfix"></div>
                        </li>',
                        array(
                            'id'      =>  get_the_ID(),
                            'link'    =>  get_permalink(),
                            'title'   =>  get_the_title(),
                            'date'    =>  get_the_date('d/m/Y'),
                            'excerpt' =>  get_the_excerpt()
                        )
                    );
                }

                wp_reset_query();
            ?>
            </ul>
        </div>
        <div id="RHSColumn" class="span4 home-column">
            <!-- Events -->
            <div id="EventsColumn">
                <h2>Coming Up</h2>
                <ul class="posts-list events">
                <?php
                    $events = kcsu_get_upcoming_events();
                    
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
            <!-- Quick Links -->
            <div id="LinksColumn">
                <h2>Getting Around</h2>
                <ul class="links-list">
                    <?php
                        wp_nav_menu( array('theme_location'  => 'home_side_menu',
                                           'container'       => false,
                                           'menu_class'      => 'nav nav-list',
                                           'depth'           => 2,
                                           'echo'            => true) );
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>