<?php
/**
 * The template for displaying all single posts
 *
 * @package    WordPress
 * @subpackage Dntheme
 * @version 1.0
 */
get_header(); ?>
<section class="single__wrap">
  <div class="container">
    <?php
        while ( have_posts() ) : the_post();
            get_template_part( 'template-parts/content','single');
        endwhile;
    ?>
  </div>
</section>

<?php get_footer();
