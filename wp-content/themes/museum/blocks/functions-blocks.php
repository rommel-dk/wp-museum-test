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
 * Define our blocks.
 */
function museum_defined_blocks() {
    $museum_blocks = array(
        // '\block-test',
        '\block-text-layers',
    );

    $museum_blocks = apply_filters('museum_defined_blocks', $museum_blocks);

    return $museum_blocks;
}

/**
 * Register our blocks.
 */
add_action( 'init', 'museum_register_custom_blocks' );
function museum_register_custom_blocks() {
    $museum_blocks = museum_defined_blocks();

    if (empty($museum_blocks))
        return;
    
    
    foreach ($museum_blocks as $m_block) {
        register_block_type( __DIR__ . $m_block );
    }
}