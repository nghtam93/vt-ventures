<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package    WordPress
 * @subpackage Dntheme
 * @version 1.0
 */
$logo_img = get_field('logo', 'option');
?>
 <footer class="footer">
      <div class="container text-center position-relative">
        <div class="row">
          <div class="col-lg-3 col-md-12">
            <div class="footer__logo">
              <a href="<?php echo site_url(); ?>" class="" title="<?php bloginfo("name"); ?>">
                <?php echo wp_get_attachment_image( $logo_img, 'full' ); ?>
              </a>
            </div>
          </div>
          <div class="col-lg-6 col-md-12">
            <?php
              wp_nav_menu(
                array(
                    'theme_location'  => 'footer_nav1',
                    'container'       => '',
                    'container_class' => '',
                    'menu_id'         => '',
                    'menu_class'      => 'footer__list',
                ));
            ?>
            <div class="copyright">
              <p><?php the_field('copyright', 'option') ?></p>
            </div>
          </div>
          <div class="col-lg-3 col-md-12">
            <div class="text-center text-lg-start">
              <div class="footer__text mb-3">
                <p class="-text"><?php _e('Keep In Touch','dntheme'); ?></p>
                <p><a href="mailto:<?php the_field('email', 'option') ?>"><?php the_field('email', 'option') ?></a></p>
              </div>
              <ul class="footer__socical">
                <li><a href="<?php the_field('fb', 'option') ?>" target="_blank"><span class="icon-facebook"></span></a></li>
                <li><a href="<?php the_field('twitter', 'option') ?>" target="_blank"><span class="icon-twitter"></span></a></li>
                <li><a href="<?php the_field('telegram', 'option') ?>" target="_blank"><span class="icon-telegram"></span></a></li>
                <li><a href="<?php the_field('linkin', 'option') ?>" target="_blank"><span class="icon-linkin"></span></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <nav id="menu__mobile" class="nav__mobile">
        <div class="nav__mobile__header">
          <a href="<?php echo site_url(); ?>" class="" title="<?php bloginfo("name"); ?>">
            <?php echo wp_get_attachment_image( $logo_img, 'full' ); ?>
          </a>
          <div class="nav__mobile--close ms-auto"><span class="icon-close"></span></div>
        </div>
        <div class="nav__mobile__content">
          <?php
            wp_nav_menu(
            array(
               'theme_location'  => 'primary',
               'container'       => 'ul',
               'container_class' => '',
               'menu_id'         => '',
               'menu_class'      => 'nav__mobile--ul',
            ));
          ?>
        </div>
    </nav>
</div> <!-- end .wrapper -->
<?php wp_footer(); ?>
</body>
</html>
