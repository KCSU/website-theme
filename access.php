<?php
    
    /**
     * Template Name: Access
     * Description: A Page Template to display the access blog.
     */
    
    ?>
<?php
    /**
     * Access list page
     *
     * @package KCSU
     * @file    access.php
     * @author  Gideon Farrell <me@gideonfarrell.co.uk>
     * @license BSD 3-Clause
     */
    get_header();
    
    ?>

<div class="container">
<div class="row">
<!-- News -->
<div id="NewsColumn" class="span8">
<h2>The Access Blog</h2>
<!-- the list -->
<ul class="posts-list posts news">
<?php
    # Need to loop through posts with cat=news
    
    query_posts( array ( 'category_name' => 'access', 'posts_per_page' => 10 ) );
    
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
</div>
</div>

<?php get_footer(); ?>