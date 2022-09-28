<?php
/**
 * Museum functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Rommel
 * @subpackage Museum
 * @since 1.0.0
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function pre($var) {
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}

/**
 * Define text domain.
 */
define( 'THEME_TEXTDOMAIN', 'museum' );

/**
 * Register supported features.
 */
add_action( 'after_setup_theme', 'theme_register_supported_features' );
function theme_register_supported_features() {

	// Register theme translations.
	load_theme_textdomain( THEME_TEXTDOMAIN, get_template_directory() . '/languages' );

	// Let WordPress manage the document title.
	// By adding theme support, we declare that this theme does not use a
	// hard-coded <title> tag in the document head, and expect WordPress to
	// provide it for us.
	add_theme_support( 'title-tag' );

	// Switch default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support(
		'html5',
		[
			'caption',
		]
	);

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Enqueue editor styles.
	add_editor_style( 'editor-styles.css' );

	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	// Set the content width in pixels, based on the theme's design and stylesheet.
	// This variable is intended to be overruled from themes.
	$GLOBALS['content_width'] = apply_filters( 'theme_content_width', 1024 );
}

/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'theme_scripts_and_styles' );
function theme_scripts_and_styles() {

	// Enqueue style reset and base stylesheet.
	wp_enqueue_style( 'theme-reset', get_stylesheet_directory_uri() . '/assets/css/reset.css', [], wp_get_theme()->get( 'Version' ) );

	wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/style.css', [], wp_get_theme()->get( 'Version' ) );

	//@TODO: Enqueue the JavaScript.
}

add_action('wp_head', 'theme_fonts');
function theme_fonts() {
	?>

	<style>
		@font-face {
			font-family: "Articulat CF v2";
			src: url("<?= get_template_directory_uri(); ?>/assets/fonts/ArticulatCFv2-DemiBold.otf");
			font-weight: 400;
		}
		@font-face {
			font-family: "Articulat CF v2";
			src: url("<?= get_template_directory_uri(); ?>/assets/fonts/ArticulatCFv2-Bold.otf");
			font-weight: 700;
		}

		@font-face {
			font-family: "Articulat CF";
			src: url("<?= get_template_directory_uri(); ?>/assets/fonts/ArticulatCF-Medium.otf");
			font-weight: 400;
		}
		@font-face {
			font-family: "Articulat CF";
			src: url("<?= get_template_directory_uri(); ?>/assets/fonts/ArticulatCF-ExtraBold.otf");
			font-weight: 800;
		}
	</style>

	<?php
}

/**
 * Include custom blocks handler.
 */
require_once get_template_directory() . '/blocks/functions-blocks.php';
