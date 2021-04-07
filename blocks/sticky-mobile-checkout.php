<div class="mobile-only sticky-mobile-checkout">
  <div class="grid sticky-mobile-checkout__grid">
    <div class="grid__col sticky-mobile-checkout__col sticky-mobile-checkout__col--left">
      <div class="sticky-mobile-checkout__inner">
        <span class="label-text sticky-mobile-checkout__label"><?php esc_html_e( 'Total', 'woocommerce' ); ?>:</span>
        <span class="sticky-mobile-checkout__value">
          <?php wc_cart_totals_order_total_html(); ?>
        </span>
      </div>
    </div>
    <div class="grid__col sticky-mobile-checkout__col sticky-mobile-checkout__col--right">
      <?php the_block('button', array(
        'button' => esc_html__('Place order', 'woocommerce'),
        'attr' => ' data-checkout-page-trigger',
        'type' => 'primary',
        'class' => 'w100 sticky-mobile-checkout__button'
      )); ?>
    </div>
  </div>
</div>
