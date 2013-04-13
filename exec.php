<?php
/**
 * Exec list page
 * 
 * @package KCSU
 * @file    exec.php
 * @author  Gideon Farrell <me@gideonfarrell.co.uk>
 * @license BSD 3-Clause
 */

get_header();
?>

<div class="container">
    <?php
        $execs = kcsu_get_exec();
        
        foreach ($execs as $exec)
        {
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
                               $exec
                               );
        }
    ?>

    <?php
    endwhile;
    ?>
</div>

<?php
get_footer();
?>