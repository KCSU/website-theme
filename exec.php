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
            '<li><!-- {id} -->
              <div class="mugshot">
                <img class="profile-pic" alt="{title}" src="holder.js/100x100" />
              </div>
              <div class="info">
                <span class="title"><a href="{link}" title="{title}">{title}</a></span><br/>
                <span class="name">{user.user_firstname} {user.user_lastname}</span><br/>
                <span class="email"><a href="mailto:{email}">{email}</a></span>
              </div>
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