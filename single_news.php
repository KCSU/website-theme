<?php
/**
 * Single post template for news items
 * 
 * @package KCSU
 * @file    single_news.php
 * @author  Gideon Farrell <me@gideonfarrell.co.uk>
 * @license BSD 3-Clause
 */
?>

<div class="container">
    <div class="row">
        <article class="news span8">
            <header>
                <h1><?php the_title(); ?></h1>
                <p>Posted <span class="date relative"><?php echo get_the_date('Y/m/d H:i:s'); ?></span> by <span class="author"><?php echo the_author_link(); ?></span></p>
            </header>

        </article>
        <section class="roll news span4">
            <h2>Hot off the press</h2>
            <ul class="posts-list news">
            <?php
                # Need to loop through posts with cat=news
                
                query_posts( array ( 'category_name' => 'news', 'posts_per_page' => 10 ) );
                
                while (have_posts()){
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

                wp_reset_query();
            ?>
            </ul>
        </section>
    </div>
</div>