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
		$this->load_blocks();
    }

	public function load_blocks() {
		require_once CODETOT_BLOCKS_DIR . 'components/accordions/accordions.php';
		require_once CODETOT_BLOCKS_DIR . 'components/code-toggle/code-toggle.php';
	}
}

CT_Blocks_Gutenberg_Custom_Blocks::instance();
