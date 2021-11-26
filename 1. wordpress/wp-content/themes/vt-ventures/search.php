<?php
/**
 * The template for displaying search results pages
 *
 * @package    WordPress
 * @subpackage Dntheme
 * @version 1.0
 */

get_header(); ?>

<section class="page__header text-center">
  <div class="container">
    <?php if ( have_posts() ) : ?>
		<h1 class="page-title"><?php printf( __( 'Tìm kiếm với từ khóa: %s', 'dntheme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	<?php else : ?>
		<h1 class="page-title"><?php _e( 'Nothing Found', 'dntheme' ); ?></h1>
	<?php endif; ?>
  </div>
</section>

<div class="page__content sc__wrap">

	<div class="archive__content">
		<div class="container">
			<?php
			if ( have_posts() ) :
				echo ' <div class="row">';
                while ( have_posts() ) : the_post(); ?>
                     <div class="col-md-6 col-lg-4">
                        <?php get_template_part( 'template-parts/content','archive'); ?>
                    </div>
                <?php
                endwhile;
                echo '</div>';
                dntheme_paging_nav();
			else : ?>
				<div class="box-search">
					<p class="mb-3 text-center"><?php _e( 'Rất tiếc, nhưng không có gì phù hợp với cụm từ tìm kiếm của bạn. Vui lòng thử lại với một số từ khóa khác nhau.', 'dntheme' ); ?></p>

					<?php get_search_form(); ?>
				</div>
			<?php endif; ?>
			</div>
		</div>
	</div>
</div><!-- .wrap -->

<?php get_footer();