<?php wp_footer(); ?>
<footer class="footer__base <?php if(!is_front_page()) { ?> footer__base--is-visible <?php }?>" data-js-component="footer">
  <?php 
    if(!is_front_page()) { ?>
      <div>
        <p>Copyright © 2022  |  All rights reserved  |  <a href="<?php echo site_url('/privacy-policy')?>"> Privacy Policy</a></p>
      </div>
      <nav class="footer__navigation">
        <ul class="footer__navigation-list uk-iconnav">
          <li class="footer__navigation-item">
            <a class="footer__navigation-link" href="" uk-icon="icon: instagram"></a>
          </li>
          <li class="footer__navigation-item">
            <a class="footer__navigation-link" href="" uk-icon="icon: linkedin"></a>
          </li>
          <li class="footer__navigation-item">
            <a class="footer__navigation-link" href="" uk-icon="icon: google"></a>
          </li>
          <li class="footer__navigation-item">
            <a class="footer__navigation-link" href="" uk-icon="icon: mail"></a>
          </li>
          <li class="footer__navigation-item">
            <a class="footer__navigation-link" href="" uk-icon="icon: receiver"></a>
          </li>
        </ul>
      </nav>
    <?php }
  ?>
</footer>