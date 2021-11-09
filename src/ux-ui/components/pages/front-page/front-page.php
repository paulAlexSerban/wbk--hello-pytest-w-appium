<?php get_header();
themeFiles('/front-page/', true);?>
<main class="main__base" data-js-component="main" data-js-page="front-page">
  <div class="carousel__base uk-position-relative uk-visible-toggle" data-js-component="carousel" tabindex="-1" uk-slideshow="animation: fade">
    <ul class="carousel__list uk-slideshow-items">
      <li class="carousel__item">
        <div
          class="carousel__slide uk-position-cove uk-animation-reverse uk-transform-origin-center-left">
          <img class="carousel__image" data-src="<?php echo get_theme_file_uri('../../uploads/2021/11/24MP-full-300dpiDSC_5707-HDR-1536x1024.jpg') ?>" alt="" uk-cover uk-img
            uk-img="target: !* -*, !* +*">
        </div>
      </li>
      <li class="carousel__item">
        <div
          class="carousel__slide uk-position-cove uk-animation-reverse uk-transform-origin-center-left">
          <img class="carousel__image" data-src="<?php echo get_theme_file_uri('../../uploads/2021/11/24MP-full-300dpiDSC_5807-HDR-1536x1024.jpg') ?>" alt="" uk-cover uk-img
            uk-img="target: !* -*, !* +*">
        </div>
      </li>
      <li class="carousel__item">
        <div
          class="carousel__slide uk-position-cove uk-animation-reverse uk-transform-origin-center-left">
          <img class="carousel__image" data-src="<?php echo get_theme_file_uri('../../uploads/2021/11/24MP-full-300dpiDSC_5853-HDR-1024x1536.jpg') ?>" alt="" uk-cover uk-img
            uk-img="target: !* -*, !* +*">
        </div>
      </li>
      <li class="carousel__item">
        <div
          class="carousel__slide uk-position-cove uk-animation-reverse uk-transform-origin-center-left">
          <img class="carousel__image" data-src="<?php echo get_theme_file_uri('../../uploads/2021/11/24MP-full-300dpiDSC_5961-HDR-1536x1024.jpg') ?>" alt="" uk-cover uk-img
            uk-img="target: !* -*, !* +*">
        </div>
      </li>
      <li class="carousel__item">
        <div
          class="carousel__slide uk-position-cove uk-animation-reverse uk-transform-origin-center-left">
          <img class="carousel__image" data-src="<?php echo get_theme_file_uri('../../uploads/2021/11/24MP-full-300dpiDSC_6000-HDR-Edit-1024x1536.jpg') ?>" alt="" uk-cover uk-img
            uk-img="target: !* -*, !* +*">
        </div>
      </li>
      <li class="carousel__item">
        <div
          class="carousel__slide uk-position-cove uk-animation-reverse uk-transform-origin-center-left">
          <img class="carousel__image" data-src="<?php echo get_theme_file_uri('../../uploads/2021/11/20200720_7_lq-1536x1086.jpg') ?>" alt="" uk-cover uk-img
            uk-img="target: !* -*, !* +*">
        </div>
      </li>
    </ul>
    <a class="carousel__control uk-position-center-left uk-position-small uk-hidden-hover" href="#"
      uk-slidenav-previous uk-slideshow-item="previous"></a>
    <a class="carousel__control uk-position-center-right uk-position-small uk-hidden-hover" href="#"
      uk-slidenav-next uk-slideshow-item="next"></a>
    <div class="uk-position-bottom-center uk-position-small">
      <ul class="uk-dotnav">
          <li uk-slideshow-item="0"><a href="#">Item 1</a></li>
          <li uk-slideshow-item="1"><a href="#">Item 2</a></li>
          <li uk-slideshow-item="2"><a href="#">Item 3</a></li>
          <li uk-slideshow-item="3"><a href="#">Item 4</a></li>
          <li uk-slideshow-item="4"><a href="#">Item 5</a></li>
          <li uk-slideshow-item="5"><a href="#">Item 6</a></li>
      </ul>
    </div>
  </div>
</main>

<?php get_footer(); ?>