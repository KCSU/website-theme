<?php
/**
 * Single post template
 * 
 * @package KCSU
 * @file    single.php
 * @author  Gideon Farrell <me@gideonfarrell.co.uk>
 * @license BSD 3-Clause
 */

get_header();


while(have_posts()): the_post();

if(in_category('news')) {
    include('single-news.php');
}
if(in_category('access')) {
    include('single-access.php');
}

endwhile;

get_footer();
?>