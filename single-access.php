<?php
/**
 * Single post template for access items
 * 
 * @package KCSU
 * @file    single_access.php
 * @author  Gideon Farrell <me@gideonfarrell.co.uk>
 * @license BSD 3-Clause
 */
?>

<div class="container news post">
    <header>
        <h1><?php the_title(); ?></h1>
        <p>Posted <span class="date relative" title="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('Y/m/d H:i:s'); ?></span> by <span class="author"><?php the_author_link(); ?></span></p>
    </header>
    <hr />
    <div class="row">
        <div class="span8">            
            <article>
                <?php the_content(); ?>
            </article>
        </div>
        <section class="roll news span4">
            <h2>Hot off the press</h2>
            <ul class="posts-list news">
            <?php
                # Need to loop through posts with cat=news
                
                query_posts( array ( 'category_name' => 'access', 'posts_per_page' => 10 ) );
                
                while (have_posts()){
                    the_post();
                    echo string_format(
                        '<li><!-- {id} --><a href="{link}" title="{title}">{title}</a></li>',
                        array(
                            'id'    =>  get_the_ID(),
                            'link'  =>  get_permalink(),
                            'title' =>  get_the_title()
                        )
                    );
                }

                wp_reset_query();
            ?>
            </ul>
        </section>
    </div>
</div>