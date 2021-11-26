<?php
/**
 * Template part for displaying posts with excerpts
 *
 * Used in Search Results and for Recent Posts in Front Page panels.
 *
 *
 * @package    WordPress
 * @subpackage Dntheme
 * @version 1.0
 */
?>
<div class="new__item ef--zoomin">
<a href="<?php the_permalink(); ?>">
  <div class="new__item__thumb">
    <div class="dnfix__thumb">
      <?php the_post_thumbnail('medium',array( 'class' => 'img-fluid','alt'   => get_the_title() )); ?>
    </div>
  </div>
  <div class="new__item__meta">
    <h3 class="new__item__title text__truncate -n2"><?php the_title() ?></h3>
    <p class="new__item__author"><?php echo get_the_time("d/m/Y"); ?></p>
    <div class="new__item__excerpt text__truncate -n3"><?php dn_excerpt(250); ?></div>
    <div class="new__item__readmore"><?php _e('Read more','dntheme'); ?></div>
  </div>
</a>
</div>