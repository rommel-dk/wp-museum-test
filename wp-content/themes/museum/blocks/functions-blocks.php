<?php
/**
 * Museum blocks.
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the test block.
 */
function gutenberg_examples_01_register_block() {
    register_block_type( __DIR__ . '\block-test' );
}
add_action( 'init', 'gutenberg_examples_01_register_block' );