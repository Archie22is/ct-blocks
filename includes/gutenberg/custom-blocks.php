<?php

class CT_Blocks_Gutenberg_Custom_Blocks {
    /**
     * Singleton instance
     *
     * @var CT_Blocks_Gutenberg_Custom_Blocks
     */
    private static $instance;

    /**
     * Get singleton instance.
     *
     * @return CT_Blocks_Gutenberg_Custom_Blocks
     */
    final public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct()
    {
		add_filter('block_categories_all', array($this, 'custom_block_categories'), 10, 2);

		$this->load_blocks();
    }

	public function custom_block_categories($categories) {
		return array_merge( $categories, array(
			array(
				'slug' => 'ct-blocks',
				'title' => esc_html__('CT Blocks', 'ct-blocks')
			)
		));
	}

	public function load_blocks() {
		require_once CODETOT_BLOCKS_DIR . 'components/accordions/accordions.php';
		require_once CODETOT_BLOCKS_DIR . 'components/image-slider/image-slider.php';
	}
}

CT_Blocks_Gutenberg_Custom_Blocks::instance();
