<?php
  $pageType = '';

  if(is_front_page()) {
    $pageType = 'front-page';
  } else if(is_post_type_archive('work_project')) {
    $pageType = 'archive-work_project-page';
  } else if(get_post_type() == 'work_project') {
    $pageType = 'single-work_project-page';
  }
?>

<!DOCTYPE html>
<html>
  <head <?php language_attributes(); ?> >
    <?php wp_head(); ?>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body data-js-page="<?php echo $pageType; ?>">
  <header class="header__base" data-js-component="header">
    <div class="header__container">
      <div class="navigation__base" data-js-component="navigation">
        <a class="logo__base" href="./index.html">
          <i class="logo__icon icon" uk-icon="uikit"></i>
        </a>
        <nav class="navigation__container uk-navbar-container" uk-navbar>
          <div class="navigation__wrapper uk-navbar-right">
            <span class="navigation__toggle" uk-toggle="target: #offcanvas-nav-primary">
              <span class="navigation__toggle-line-1"></span>
              <span class="navigation__toggle-line-2"></span>
              <span class="navigation__toggle-line-3"></span>
            </span>

            <?php 
            /**
             * 1. (string) Theme location to be used. Must be registered with register_nav_menu() in order to be selectable by the user.
             * 2. (string) CSS class to use for the ul element which forms the menu. Default 'menu'.
             * 3. (string) Whether to wrap the ul, and what to wrap it with. Default 'div'.
             */
              wp_nav_menu(array(
                'theme_location'    => 'header_menu-desktop',/* 1 */ 
                'menu_class'        => 'navigation__list uk-navbar-nav', /* 2 */  
                'container'         => ' ', /* 3 */ 
              ));
            ?>


            <div class="navigation__offcanvas-container" id="offcanvas-nav-primary" uk-offcanvas="overlay: true">
              <div class="navigation__offcanvas-wrapper uk-offcanvas-bar uk-flex uk-flex-column">
                <?php
              /**
               * 1. (string) Theme location to be used. Must be registered with register_nav_menu() in order to be selectable by the user.
               * 2. (string) CSS class to use for the ul element which forms the menu. Default 'menu'.
               * 3. (string) Whether to wrap the ul, and what to wrap it with. Default 'div'.
               */
                wp_nav_menu(array(
                  'theme_location'    => 'header_menu-overlay',/* 1 */ 
                  'menu_class'        => 'navigation__offcanvas-list uk-nav uk-nav-primary uk-nav-center uk-margin-auto-vertical', /* 2 */  
                  'container'         => ' ', /* 3 */ 
                ));
                ?>
                <!-- <ul class="navigation__offcanvas-list uk-nav uk-nav-primary uk-nav-center uk-margin-auto-vertical">
                  <li class="navigation__item navigation__offcanvas-item">
                    <a class="navigation__link navigation__offcanvas-link" href="./index.html">Home</a>
                  </li>
                  <li class="navigation__item navigation__offcanvas-item">
                    <a class="navigation__link navigation__offcanvas-link" href="./work.html">Work</a>
                  </li>
                  <li class="navigation__item navigation__offcanvas-item">
                    <a class="navigation__link navigation__offcanvas-link" href="./about.html">About</a>
                  </li>
                  <li class="uk-nav-divider"></li>
                </ul> -->
                <div class="footer__social">
                  <ul class="footer__social-list">
                    <li class="footer__social-icon">
                      <i class="logo__icon icon" data-svg="facebook"></i>
                    </li>
                    <li class="footer__social-icon">
                      <i class="logo__icon icon" data-svg="instagram"></i>
                    </li>
                    <li class="footer__social-icon">
                      <i class="logo__icon icon" data-svg="linkedin"></i>
                    </li>
                  </ul>
                </div>

        

              </div>
            </div>

          </div>
        </nav>
      </div>
    </div>
  </header>