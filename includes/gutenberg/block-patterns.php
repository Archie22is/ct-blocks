<?php

class CT_Blocks_Gutenberg_Block_Patterns
{
    /**
     * Singleton instance
     *
     * @var CT_Blocks_Gutenberg_Block_Patterns
     */
    private static $instance;

    /**
     * Get singleton instance.
     *
     * @return CT_Blocks_Gutenberg_Block_Patterns
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
		$this->block_patterns = array(
			array(
				'id' => 'hero-two-up-image',
				'title' => __('Hero Two Up Image'),
				'content' => file_get_contents(CODETOT_BLOCKS_DIR . '/block-patterns/hero-two-up-image.html')
			),
			array(
				'id' => 'pricing-card',
				'title' => __('Pricing Card', 'ct-blocks'),
				'content' => file_get_contents(CODETOT_BLOCKS_DIR . '/block-patterns/pricing-card.html')
			),
			array(
				'id' => 'icon-card',
				'title' => __('Icon Card', 'ct-blocks'),
				'content' => file_get_contents(CODETOT_BLOCKS_DIR . '/block-patterns/icon-card.html')
			)
		);

		add_action('init', array($this, 'register_block_category'));
		add_action('init', array($this, 'register_block_patterns'));
    }

	public function register_block_category() {
		register_block_pattern_category(
			'ct-blocks',
			array(
				'label' => __('CT Blocks')
			)
		);
	}

	public function register_block_patterns() {
		if ( !empty($this->block_patterns) ) {
			foreach ($this->block_patterns as $block_pattern) {
				$block_pattern['id '] = 'ct-blocks/' . sanitize_key($block_pattern['id']);
				$block_pattern['categories'] = array('ct-blocks');
				$block_properties = $block_pattern;
				unset($block_properties['id']);

				register_block_pattern($block_pattern['id'], $block_properties);
			}
		}
	}
}

CT_Blocks_Gutenberg_Block_Patterns::instance();
