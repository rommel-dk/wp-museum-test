<?php
/*
Plugin Name: 	Museum External Content
Plugin URI:		https://github.com/rommel-dk/wp-museum-test
Description: 	Get and store external content from Museum server
Version: 		1.0.0
Author: 		Jesper Nielsen
Author URI: 	https://github.com/rommel-dk/wp-museum-test
Text Domain: 	museum-external-content
Domain Path:	/languages
License: 		GPLv2 or later
License URI:	http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'MuseumExternalContent' ) ) {

	/**
	 * The main class
	 */
	class MuseumExternalContent {

		/**
		 * The base URL of external server
		 */
		public $base_URL = 'http://localhost/wp-museum-test';

		/**
		 * The data endpoint of external server
		 */
		public $data_endpoint = '/wp-content/plugins/museum-external-content/data-grid.json';

		/**
		 * The token endpoint of external server
		 */
		public $token_endpoint = '/fake/url/for/token';

		/**
		 * The authorization token
		 */
		private $token = '';

        /**
		 * A dummy constructor to ensure plugin is only setup once.
		 */
		public function __construct() {
			// Do nothing.
		}

		/**
		 * Sets up the plugin.
		 */
		public function initialize() {
            // Add actions.
			add_action( 'init', array( $this, 'init' ), 5 );
        }

        /**
		 * Completes the setup process on "init" of earlier.
		 */
		public function init() {
			// Bail early if called directly from functions.php or plugin file.
			if ( ! did_action( 'plugins_loaded' ) ) {
				return;
			}

			// Allow third party to alter endpoints
			$this->base_URL = apply_filters('museum_external_content_api_base_url', $this->base_URL);
			$this->data_endpoint = apply_filters('museum_external_content_api_data_endpoint', $this->data_endpoint);
			$this->token_endpoint = apply_filters('museum_external_content_api_token_endpoint', $this->token_endpoint);

			// Authorize the token
			// $this->auth_token();
        }

		/**
		 * Handle token authorization
		 */
		public function auth_token() {
			$token_data = get_transient('museum_external_content_saved_token');

			if (!$token_data) {
				$token_data = $this->get_token();
				$token_data = $token_data->token;
			}

			// error handling

			$this->token = $token_data;
        }

		/**
		 * Handle token authorization
		 */
		public function get_token() {
			$token_credentials = array(); // array of token credentials such as consumer key & secret
            $token_response = $this->curl_post($this->base_URL . $this->token_endpoint, $token_credentials);

			// error handling

			return $token_response;
        }

		/**
		 * Get data from external server
		 */
		public function get_data() {
			$data = get_transient('museum_external_content_saved_data');

			if (!$data) {
				$data = $this->curl_get($this->base_URL . $this->data_endpoint);
				$data = json_decode($data, true);

				if (!is_array($data) || !isset($data['tiles'])) {
					// Error handling
				}

				$data = $data['tiles'];

				set_transient('museum_external_content_saved_data', $data, HOUR_IN_SECONDS);
			}

            return $data;
        }

		/**
		 * Function handler for cURL GET method
		 */
		public function curl_get($url = '') {
            return $this->curl($url, 'GET');
        }

		/**
		 * Function handler for cURL POST method
		 */
		public function curl_post($url = '', $post_fields = array()) {
            return $this->curl($url, 'POST', $post_fields);
        }

		/**
		 * Main function handler for cURL requests
		 */
		public function curl($url = '', $method = '', $post_fields = array()) {
			// Authorize the token
			// $this->auth_token();


            // create curl resource
			$ch = curl_init();

			// set url
			curl_setopt($ch, CURLOPT_URL, $url);

			// set POST method
			if (strtolower($method) == 'post') {
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_fields));
			}

			// return the transfer as a string
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

			// $output contains the output string
			$response = curl_exec($ch);

			// close curl resource to free up system resources
			curl_close($ch); 

			// Error handling

			// Return response
			return $response;
        }

    }
        
	/**
	 * The main function responsible for returning the one true plugin Instance to functions everywhere.
	 * Use this function like you would a global variable, except without needing to declare the global.
	 */
	function museum_external_content() {
		global $museum_external_content;

		// Instantiate only once.
		if ( ! isset( $museum_external_content ) ) {
			$museum_external_content = new MuseumExternalContent();
			$museum_external_content->initialize();
		}

		return $museum_external_content;
	}

	// Instantiate.
	museum_external_content();

} // class_exists check
