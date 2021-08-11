<?php

class Codetot_Block_Section_Product extends Codetot_Base_Block implements Codetot_Base_Block_Interface
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
   * @var Codetot_Block_Section_Product
   */
  private static $instance;

  /**
   * Get singleton instance.
   *
   * @return Codetot_Block_Section_Product
   */
  public final static function instance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {

    $this->block_name = 'section-product';
    $this->block_slug = 'section_product';
    $this->block_title = __('Section Product', 'ct-blocks');
    $this->fields = [
      // Settings
      'enable_lazyload',
      'class',
      'anchor_name',
      'background_type',
      'background_contract',
      'section_align',
      'numbers',
      'columns',
      'show_category',
      'show_shop_link',
      // Content
      'label',
      'title',
      'description',
      'categories',
      'attribute',
      'button_text',
      'button_url',
      'button_target',
      'button_style'
    ];

    $this->svg_icon = '<svg id="section_product" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M23 6.066v12.065l-11.001 5.869-11-5.869v-12.131l11-6 11.001 6.066zm-21.001 11.465l9.5 5.069v-10.57l-9.5-4.946v10.447zm20.001-10.388l-9.501 4.889v10.568l9.501-5.069v-10.388zm-5.52 1.716l-9.534-4.964-4.349 2.373 9.404 4.896 4.479-2.305zm-8.476-5.541l9.565 4.98 3.832-1.972-9.405-5.185-3.992 2.177z"/></svg>';

    parent::__construct();

    add_action( 'rest_api_init', array($this, 'custom_rest_routes'));
  }

  public function custom_rest_routes() {
    register_rest_route('codetot/v1', 'get_section_product_html', array(
      'methods' => WP_REST_Server::READABLE,
      'callback' => array($this, 'get_section_product_html_callback'),
      'permission_callback' => '__return_true'
    ));
  }

  public function get_section_product_html_callback($request) {
    $category_id_raw = isset($request['categories']) ? esc_attr($request['categories']) : null;
    $category_ids = !empty($category_id_raw) ? explode('|', $category_id_raw) : [];
    $posts_per_page = isset($request['posts_per_page']) && is_numeric($request['posts_per_page']) ? esc_attr($request['posts_per_page']) : null;
    $product_query_type = isset($request['query_type']) ? esc_attr($request['query_type']) : null;

    if (empty($category_ids) || !is_array($category_ids) || empty($posts_per_page) || empty($product_query_type)) {
      return new \WP_Rest_Response(array(
        'errorCode' => 400,
        'errorMessage' => __('Bad request. Missing or wrong parameters.', 'ct-blocks')
      ), 200);
    }

    $product_args = codetot_get_product_query_by_type($product_query_type);
    $product_args = wp_parse_args(array(
      'posts_per_page' => $posts_per_page,
      'tax_query' => array(
        array(
          'taxonomy' => 'product_cat',
          'field' => 'id',
          'terms' => $category_ids
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

      $response = new \WP_Rest_Response(array(
        'html' => $html
      ), 200);

      $response->set_headers(array(
        'Cache-Control' => 'max-age=3600' // 1 hour
      ));

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

Codetot_Block_Section_Product::instance();
