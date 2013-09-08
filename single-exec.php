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

<div class="container exec post">
<div class="exec-member">
    <?php
        $exec = kcsu_get_exec_member(basename(get_permalink()));
        echo string_format(
            '<!-- {id} -->
              <div class="mugshot">
                {users_avatars}
                <div class="clearfix"></div>
              </div>
              <div class="info">
                <span class="title">{title}</span><br/>
                <span class="name">{users_display}</span><br/>
                <span class="email"><a href="mailto:{email}">{email}</a></span>
              </div>
            ',
            $exec
        );
    ?>
</div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="span8">            
                <article>
                    <?php the_content(); ?>
                </article>
            </div>
        </div>
</div>

<?php
get_footer();
?>