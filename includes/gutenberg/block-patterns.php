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
		$this->block_patterns_sections = array(
			array(
				'id' => 'hero-two-up-image',
				'title' => __('Hero Two Up Image')
			),
			array(
				'id' => 'faq-section',
				'title' => __('FAQ Section', 'ct-blocks')
			),
			array(
				'id' => 'video-center',
				'title' => __('Video Center', 'ct-blocks')
			)
		);

		$this->block_patterns_elements = array(
			array(
				'id' => 'pricing-card',
				'title' => __('Pricing Card', 'ct-blocks'),
				'categories' => array('ct-blocks-element')
			),
			array(
				'id' => 'icon-card',
				'title' => __('Icon Card', 'ct-blocks'),
				'categories' => array('ct-blocks-element')
			),
			array(
				'id' => 'faq-item',
				'title' => __('FAQ Item', 'ct-blocks'),
				'categories' => array('ct-blocks-element')
			)
		);

		add_action('init', array($this, 'register_block_category'));
		add_action('init', array($this, 'register_block_patterns'));
    }

	public function register_block_patterns_section() {

	}

	public function register_block_category() {
		register_block_pattern_category(
			'ct-blocks-section',
			array(
				'label' => __('CT Blocks - Sections')
			)
		);

		register_block_pattern_category(
			'ct-blocks-element',
			array(
				'label' => __('CT Blocks - Elements')
			)
		);
	}

	public function register_block_patterns() {
		if ( !empty($this->block_patterns_sections) ) {
			foreach ($this->block_patterns_sections as $block_pattern) {
				$this->register_patterns($block_pattern, 'ct-blocks-section');
			}
		}

		if ( !empty($this->block_patterns_elements) ) {
			foreach ($this->block_patterns_elements as $block_pattern) {
				$this->register_patterns($block_pattern, 'ct-blocks-element');
			}
		}
	}

	public function register_patterns($block_pattern, $category) {
		$block_pattern['id '] = 'ct-blocks/' . sanitize_key($block_pattern['id']);
		$block_properties = $block_pattern;
		$block_properties['categories'] = array($category);

		if (empty($block_properties['content'])) {
			$block_properties['content'] = file_get_contents(CODETOT_BLOCKS_DIR . '/block-patterns/' . esc_html($block_pattern['id']) .'.html');
		}

		unset($block_properties['id']);

		register_block_pattern($block_pattern['id'], $block_properties);
	}
}

CT_Blocks_Gutenberg_Block_Patterns::instance();
