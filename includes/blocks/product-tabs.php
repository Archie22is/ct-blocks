<?php

class Codetot_Block_Product_Tabs extends Codetot_Base_Block implements Codetot_Base_Block_Interface
{
  /**
   * @var string
   */
  public $block_name;
  /**
   * @var string|void
   */
  public $block_title;
  /**
   * @var string
   */
  public $block_slug;
  /**
   * @var array
   */
  public $fields;

  /**
   * Singleton instance
   *
   * @var Codetot_Block_Product_Tabs
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Product_Tabs
   */
  public final static function instance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'product-tabs';
    $this->block_slug = 'product_tabs';
    $this->block_title = esc_html__('Product Tabs', 'ct-blocks');
    $this->fields = [
      // Settings
      'enable_lazyload',
      'display_product_category_link_button',
      'button_target',
      'button_style',
      'class',
      'header_alignment',
      'footer_alignment',
      'numbers',
      'columns',
      'attribute',
      // Content
      'label',
      'title',
      'description',
      'categories'
    ];

    $this->svg_icon = '<svg id="product_tabs" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6 6h-6v-6h6v6zm9-6h-6v6h6v-6zm9 0h-6v6h6v-6zm0 8h-24v16h24v-16z"/></svg>';

    parent::__construct();

    add_action( 'rest_api_init', array($this, 'custom_rest_routes'));
  }

  public function custom_rest_routes() {
    register_rest_route('codetot/v1', 'get_product_tabs_html', array(
      'methods' => WP_REST_Server::READABLE,
      'callback' => array($this, 'get_product_tabs_html_callback'),
      'permission_callback' => '__return_true'
    ));
  }

  public function get_product_tabs_html_callback($request) {
    $category_id = isset($request['category_id']) && is_numeric($request['category_id']) ? esc_attr($request['category_id']) : null;
    $posts_per_page = isset($request['posts_per_page']) && is_numeric($request['posts_per_page']) ? esc_attr($request['posts_per_page']) : null;
    $product_query_type = isset($request['query_type']) ? esc_attr($request['query_type']) : null;

    if (empty($category_id) || empty($posts_per_page) || empty($product_query_type)) {
      return new \WP_Rest_Response(array(
        'errorCode' => 400,
        'errorMessage' => __('Bad request. Missing parameters.', 'ct-blocks')
      ), 200);
    }

    $product_args = codetot_get_product_query_by_type($product_query_type);
    $product_args = wp_parse_args(array(
      'posts_per_page' => $posts_per_page,
      'tax_query' => array(
        array(
          'taxonomy' => 'product_cat',
          'field' => 'id',
          'terms' => $category_id
        )
        ),
        'meta_query' => array (
          array(
            'key' => '_stock_status',
            'value' => 'instock'
          )
        )
    ), $product_args);

    $product_query = new WP_Query($product_args);

    if ($product_query->have_posts()) :

      ob_start();
      while ( $product_query->have_posts() ) :
        $product_query->the_post();
        wc_get_template_part( 'content', 'product' );
      endwhile; wp_reset_postdata();
      $html = ob_get_clean();

      $response = new \WP_Rest_Response();
      $data_args = array(
        'html' => $html
      );

      if ( empty( $request->get_param('cache') ) ) :
        $response->set_headers(array(
          'Cache-Control' => 'max-age=3600' // 1 hour
        ));
        $data_args['cache'] = true;
      else :
        $data_args['cache'] = false;
      endif;

      $response->set_data($data_args);
      $response->set_status(200);

      return $response;

    else :

      return new \WP_Rest_Response(array(
        'errorCode' => 404,
        'errorMessage' => __('There is no product to display.', 'ct-blocks'),
        'html' => get_block('message-block', array(
          'content' => esc_html__('There is no product to display.', 'ct-blocks')
        ))
      ), 200);

    endif;
  }
}

Codetot_Block_Product_Tabs::instance();
