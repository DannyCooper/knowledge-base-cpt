<?php
/**
 * Knowledge Base CPT
 *
 * Plugin Name: Knowledge Base CPT
 * Plugin URI:  https://wordpress.org/plugins/knowledge-base-cpt/
 * Description: Enables a knowledge base post type and section taxonomy.
 * Version:     1.0.5
 * Author:      Danny Cooper
 * Author URI:  http://olympusthemes.com/
 * Text Domain: ot-knowledge
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 *
 * @package knowledge-base-cpt
 */

/**
 * Main Olympus_Knowledge Class
 *
 * @since 1.0.0
 */
class Olympus_Knowledge {

	/**
	 * Initialize plugin.
	 */
	function __construct() {

		$this->includes();
		
		add_action( 'init', array( $this, 'ot_check_version' ) );
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		update_option( 'ot_knowledge_version', 105 );

	}

	/**
	 * Load plugin files.
	 */
	function includes() {

		// Required files for registering the post type, taxonomies. settings and widget.
		require plugin_dir_path( __FILE__ ) . 'includes/register-cpt.php';
		require plugin_dir_path( __FILE__ ) . 'includes/register-taxonomy.php';
		require plugin_dir_path( __FILE__ ) . 'includes/register-settings.php';
		require plugin_dir_path( __FILE__ ) . 'includes/register-recent-widget.php';

	}

	/**
	 * Load plugin textdomain.
	 *
	 * @since 1.0.0
	 */
	function load_textdomain() {

		load_plugin_textdomain( 'ot-knowledge', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

	}

	/**
	 * Flush rewrites.
	 */
	public static function flush_rewrites() {

		ot_knowledge_cpt();
		ot_knowledge_section();
		flush_rewrite_rules();

	}

	/**
	 * Check if rewrite rules need to be flushed after update as updates don't trigger register_activation_hook().
	 */
	function ot_check_version() {

		$db_version = get_option( 'ot_knowledge_version' );

		if ( $db_version < 104 ) {

			$this->flush_rewrites();
			update_option( 'ot_knowledge_version', 105 );

		}

	}
}

$olympus_knowledge = new Olympus_Knowledge();

register_activation_hook( __FILE__, array( 'Olympus_Knowledge', 'flush_rewrites' ) );
