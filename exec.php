<?php
    
    /**
     * Template Name: Exec
     * Description: A Page Template to display the exec.
     */
    
?>
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
  <ul class="exec-list">
    <?php
        $execs = kcsu_get_exec();
        
        foreach ($execs as $exec)
        {
            echo string_format(
                               '<li>
                               <article><!-- {id} -->
                               <header>
                               <a href="{link}" title="{name}" class="title">{name}</a>
                               </header>
                               <div class="span7 excerpt">{excerpt}</div>
                               </article><div class="clearfix"></div>
                               </li>',
                               $exec
                               );
        }
    ?>
  </ul>
</div>

<?php
get_footer();
?>