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
                            '<a href="{link}" title="{title}"><li><!-- {id} -->{title} <span class="aux date">{date}</span></li></a>',
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
            <!-- Quick Links -->
            <div id="LinksColumn">
                <h2>Getting Around</h2>
                <ul class="links-list">
                    <?php /* need some sort of menu here (yes, I'm resurrecting it) */ ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>