<?php
    
    require_once('lib/home_side_menu_nav_walker.php');
    get_header();

?>

<div class="container">
    <div class="row">
        <!-- News -->
        <div id="NewsColumn" class="span4 home-column">
            <h2>News</h2>
            <img data-src='holder.js/370x150' class='media-object' />
            <?php
                # Need to loop through posts with cat=news
                
                query_posts( array ( 'category_name' => 'news', 'posts_per_page' => 10 ) );
                
                while (have_posts()) : the_post();?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>
                   	<header class="entry-header">
                        <h1 class="entry-title entry-title-home"><a href="<?php the_permalink(); ?>" title="<?php printf( 'Permalink to %s', the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                        </h1>
                        <span class="entry-date-home"><?php kcsu_posted_on(); ?>
                    </header><!-- .entry-header -->
                </article><!-- #post-<?php the_ID(); ?> -->
                endwhile;

                wp_reset_query();
            ?>
        </div>
        <!-- Events -->
        <div id="EventsColumn" class="span4 home-column">
            <h2>Events</h2>
            <img data-src='holder.js/370x150' class='media-object' />
            <?php
                # Need to loop through posts with cat=event?
                add_filter('posts_where', 'kcsu_events_filter_where');
                query_posts( array ( 'category_name'    => 'event',
                                     'posts_per_page'   => 10,
                                     'post_status'      => 'future',
                                     'orderby'          => 'date',
                                     'order'            => 'ascending'
                                    ) );
                
                while (have_posts()) : the_post();?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>
                   	<header class="entry-header">
                        <h1 class="entry-title entry-title-home"><a href="<?php the_permalink(); ?>" title="<?php printf( 'Permalink to %s', the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                        </h1>
                        <span class="entry-date-home"><?php kcsu_posted_on(); ?>
                    </header><!-- .entry-header -->
                </article><!-- #post-<?php the_ID(); ?> -->
                endwhile;
                remove_filter('posts_where', 'kcsu_events_filter_where');
                wp_reset_query();
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
                
                wp_nav_menu( array('theme_location'  => 'home_side_menu',
                                   'container'       => false,
                                   'menu_class'      => 'nav',
                                   'depth'           => 2,
                                   'echo'            => true,
                                   'walker'          => new home_side_menu_nav_walker() ) );
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>