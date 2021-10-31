<!DOCTYPE html>
<html>
  <head>
    <?php wp_head(); ?>
  </head>
  <body>
  <header class="header__base">
    <div class="header__container">
      <div class="navigation__base">
        <a class="logo__base" href="./index.html">
          <i class="logo__icon icon" uk-icon="uikit"></i>
        </a>
        <nav class="navigation__container uk-navbar-container" uk-navbar>
          <div class="navigation__wrapper uk-navbar-right">
            <i class="navigation__toggle icon" uk-icon="menu" uk-toggle="target: #offcanvas-nav-primary"></i>
            <ul class="navigation__list uk-navbar-nav">
              <li class="navigation__item">
                <a class="navigation__link" href="./index.html">Home</a>
              </li>
              <li class="navigation__item">
                <a class="navigation__link" href="./work.html">Work</a>
              </li>
              <li class="navigation__item">
                <a class="navigation__link" href="./about.html">About</a>
              </li>
            </ul>

            <div class="navigation__offcanvas-container" id="offcanvas-nav-primary" uk-offcanvas="overlay: true">
              <div class="navigation__offcanvas-wrapper uk-offcanvas-bar uk-flex uk-flex-column">

                <button class="uk-offcanvas-close" type="button" uk-close></button>

                <ul class="navigation__offcanvas-list uk-nav uk-nav-primary uk-nav-center uk-margin-auto-vertical">
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
                </ul>
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