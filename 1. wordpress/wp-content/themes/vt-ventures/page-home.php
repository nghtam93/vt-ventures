<?php
/**
 * Template Name: Page Home
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package    WordPress
 * @subpackage Dntheme
 * @version 1.0
 */
global $dn_options;
get_header();?>
<?php while ( have_posts() ) : the_post(); ?>

  <?php $banner_img = get_field('header_image'); ?>
  <section class="home-banner">
    <div class="videoWrapper">
      <video src="<?php the_field('header_video') ?>" loop muted autoplay></video>
    </div>
    <div class="home-banner__wrap">
      <div class="container">
        <div class="row">
          <div class="col-sm-5 col-lg-6 order-sm-2">
            <div class="el__thumb wow fadeInRight">
              <?php echo wp_get_attachment_image( $banner_img, 'full' ); ?>
            </div>
          </div>

          <div class="col-sm-7 col-lg-6">
            <div class="el__meta wow fadeInUp">
              <div>
                <h2 class="el__title"><?php the_field('header_title') ?></h2>
                <div class="el__excerpt"><?php the_field('header_excerpt') ?></div>
                <a href="<?php the_field('header_link') ?>" class="btn -primary"><?php _e('Let’s Talk','dntheme'); ?> <span class="icon-arrow_forward"></span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="home-about" class="home-about">
    <div class="container">
      <div class="sc__header text-center wow fadeInUp">
        <h2 class="sc__header__title"><?php the_field('intro_title') ?></h2>
        <div class="sc__header__excerpt"><?php the_field('intro_excerpt') ?></div>
      </div>

      <div class="text-center">
        <div class="el__line"></div>
      </div>

      <div class="el__excerpt text-center wow fadeInUp"><?php the_field('intro_excerpt2') ?></div>

      <?php
      if( have_rows('intro_misson') ): $i=0; ?>
        <div class="el__boxs">
            <div class="row">
            <?php while( have_rows('intro_misson') ) : the_row(); $i++;
              $box_image = get_sub_field('image');
              $sub_title = get_sub_field('title');
              $sub_content = get_sub_field('content');
              ?>
              <div class="col-md-6 wow <?php echo ($i==1) ? 'fadeInLeft' : 'fadeInRight'; ?>">
                <div class="el__box">
                  <div class="el__box__thumb">
                    <?php echo wp_get_attachment_image( $box_image, 'full' ); ?>
                  </div>
                  <h3 class="el__box__title"><?php echo $sub_title ?></h3>
                  <div class="el__box__excerpt"><?php echo $sub_content ?></div>
                </div>
              </div>
            <?php endwhile; ?>
            </div>
        </div>
      <?php else :
        get_template_part( 'template-parts/content', 'none' );
      endif;
      ?>
    </div>
  </section>

  <section id="home-services" class="home-service">
    <div class="container">
      <div class="sc__header text-center">
        <h2 class="sc__header__title wow fadeInRight"><?php the_field('services_title') ?></h2>
        <div class="sc__header__excerpt wow fadeInLeft"><?php the_field('services_sub') ?></div>
      </div>

      <div class="row el wow fadeInUp justify-content-center">
        <?php
        if( have_rows('service_items') ): ?>

              <?php while( have_rows('service_items') ) : the_row();
                $service_img = get_sub_field('image');
                $sub_title = get_sub_field('title');
                ?>
                <div class="col-lg-4 col-md-6">
                  <div class="el__item">
                    <div class="el__item__thumb dnfix__thumb">
                      <?php echo wp_get_attachment_image( $service_img, 'full' ); ?>
                    </div>
                    <div class="el__item__meta">
                      <h3 class="el__item__title"><?php echo $sub_title ?></h3>
                    </div>
                  </div>
                </div>
              <?php endwhile; ?>

        <?php else :
          get_template_part( 'template-parts/content', 'none' );
        endif;
        ?>
        <div id="home-team" ></div>
      </div>

      <?php $banner_img = get_field('team_logo'); ?>
      <div class="el__boxs wow fadeInUp">
        <div class="row">
          <div class="el__col col-lg-6 col-md-12 col-lg-20 order-1 order-lg-2">
            <div class="el__box">
              <h3 class="el__box__title2"><?php the_field('team_title') ?></h3>
              <div class="el__box__thumb2">
                <?php echo wp_get_attachment_image( $banner_img, 'full' ); ?>
              </div>
            </div>
          </div>
          <?php
          if( have_rows('team_items') ): $i=0;?>
            <?php while( have_rows('team_items') ) : the_row(); $i++;
              $service_img = get_sub_field('image');
              $sub_title = get_sub_field('title');
              $sub_sub = get_sub_field('sub');
              $sub_excerpt = get_sub_field('excerpt');
              ?>
              <div class="el__col col-lg-4 col-6 col-lg-40 <?php echo ($i==1) ? 'order-lg-1':'order-lg-3' ?>">
                <div class="el__box">
                  <div class="el__box__thumb dnfix__thumb">
                    <?php echo wp_get_attachment_image( $service_img, 'full' ); ?>
                  </div>
                  <h3 class="el__box__title"><?php echo $sub_title ?></h3>
                  <div class="el__box__sub"><?php echo $sub_sub ?></div>
                  <div class="el__box__excerpt"><?php echo $sub_excerpt ?></div>
                </div>
              </div>
            <?php endwhile; ?>
          <?php else :
            get_template_part( 'template-parts/content', 'none' );
          endif;
          ?>
        </div>
      </div>

      <?php
      if( have_rows('team_items2') ): ?>
        <div class="el__boxs2 wow fadeInUp">
          <div class="home-service__slider">
            <?php while( have_rows('team_items2') ) : the_row();
              $service_img = get_sub_field('image');
              $sub_title = get_sub_field('title');
              $sub_sub = get_sub_field('sub');
              $sub_excerpt = get_sub_field('excerpt');
              ?>
              <div class="col-lg-3 col-md-6">
                <div class="el__box">
                  <div class="el__box__thumb dnfix__thumb">
                    <?php echo wp_get_attachment_image( $service_img, 'full' ); ?>
                  </div>
                  <h3 class="el__box__title"><?php echo $sub_title ?></h3>
                  <div class="el__box__sub"><?php echo $sub_sub ?></div>
                  <div class="el__box__excerpt"><?php echo $sub_excerpt ?></div>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
        </div>
      <?php else :
        get_template_part( 'template-parts/content', 'none' );
      endif;
      ?>
    </div>
  </section>

  <section id="home-work" class="home-work">
    <div class="container">
      <div class="sc__header text-center">
        <h2 class="sc__header__title wow fadeInLeft"><?php the_field('work_title') ?></h2>
        <div class="sc__header__excerpt wow fadeInRight"><?php the_field('work_excerpt') ?></div>
      </div>
      <?php
      if( have_rows('work_items') ): ?>
        <div class="home-work__slider row-md wow fadeInUp">
            <?php while( have_rows('work_items') ) : the_row();
              $box_image = get_sub_field('image');
              $sub_excerpt = get_sub_field('excerpt');
              $sub_telegram = get_sub_field('telegram');
              $sub_link = get_sub_field('link');
              ?>
              <div class="col-lg-3 col-md-4 d-md-flex">
                <div class="el__item">
                  <div class="el__item__thumb">
                    <?php echo wp_get_attachment_image( $box_image, 'full' ); ?>
                  </div>
                  <div class="el__item__excerpt"><?php echo $sub_excerpt ?></div>
                  <ul>
                    <li><a href="<?php echo $sub_title ?>" target="_blank"><span class="icon-telegram"></span></a></li>
                    <li><a href="<?php echo $sub_link ?>" target="_blank"><span class="icon-megaphone"></span></a></li>
                  </ul>
                </div>
              </div>
            <?php endwhile; ?>
        </div>
      <?php else :
        get_template_part( 'template-parts/content', 'none' );
      endif;
      ?>
    </div>
  </section>

  <section class="home-ready">
    <div class="container text-center wow fadeInUp">
      <div class="el__sub"><?php the_field('text_title') ?></div>
      <h2 class="el__title"><?php the_field('text_sub') ?></h2>
      <div class="wow fadeInUp">
        <a href="<?php the_field('text_link') ?>" class="btn"><?php _e('Contact Us','dntheme'); ?> <span class="icon-arrow_forward"></span></a>
      </div>
    </div>
  </section>


  <?php $banner_img = get_field('partners_logo'); ?>
  <section id="home-partners" class="home-partner">
    <div class="container">
      <div class="el__header text-center wow fadeInUp">
        <div class="el__thumb">
          <?php echo wp_get_attachment_image( $banner_img, 'full' ); ?>
        </div>
        <div class="el__title"><?php the_field('partners_title') ?></div>
        <div class="el__sub"><?php the_field('partners_excerpt') ?></div>
      </div>
      <?php
      $images = get_field('partners_items');
      $size = 'medium'; // (thumbnail, medium, large, full or custom size)
      if( $images ): ?>
          <div class="el__items text-center wow fadeInUp">
              <?php foreach( $images as $image_id ): ?>
                <div class="el__item">
                  <div class="el__item__thumb">
                    <?php echo wp_get_attachment_image( $image_id, $size ); ?>
                  </div>
                </div>
              <?php endforeach; ?>
          </div>
      <?php endif; ?>
    </div>
  </section>
<?php endwhile; ?>
<?php get_footer();