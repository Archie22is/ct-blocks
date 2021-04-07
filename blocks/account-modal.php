<div class="account-modal" data-child-block="account-modal">
  <div class="account-modal__wrapper">
    <div class="account-modal__header">
      <p class="account-modal__title"><?php _e('Sign In', 'ct-peakshop'); ?></p>
    </div>
    <div class="account-modal__main">
      <?php woocommerce_login_form(); ?>
    </div>
    <button class="account-modal__button js-close-account-modal">
        <?php codetot_svg('close', true); ?>
    </button>
  </div>
  <div class="account-modal__overlay js-close-account-modal"></div>
</div>
