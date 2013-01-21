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

if (in_category('events')) {
  include(TEMPLATEPATH.'/single_events.php');
} elseif (in_category('news')) {
  include(TEMPLATEPATH.'/single_news.php');
} else{
  include(TEMPLATEPATH.'/single_default.php');
}

endwhile;

get_footer();
?>