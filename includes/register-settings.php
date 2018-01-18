<?php
/**
 * Create Permalink Setting.
 *
 * @package     knowledge-base-cpt
 * @copyright   Copyright (c) 2015, Danny Cooper
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Main OT_Permalink_Setting Class
 *
 * @since 1.0.0
 */
class OT_Permalink_Setting {

	/**
	 * Initialize class.
	 */
	public function __construct() {
		$this->init();
		$this->settings_save();
	}

	/**
	 * Call register fields.
	 */
	public function init() {
		add_filter( 'admin_init', array( &$this, 'register_fields' ) );
	}

	/**
	 * Add setting to permalinks page.
	 */
	public function register_fields() {
		register_setting( 'permalink', 'ot_knowledge_slug', 'esc_attr' );
		add_settings_field( 'ot_knowledge_slug_setting', '<label for="ot_knowledge_slug">' . __( 'Knowledge Base', 'ot-knowledge' ) . '</label>', array( &$this, 'fields_html' ), 'permalink', 'optional' );
	}

	/**
	 * HTML for permalink setting.
	 */
	public function fields_html() {
		$value = get_option( 'ot_knowledge_slug' );
		wp_nonce_field( 'ot-knowledge', 'ot_knowledge_slug_nonce' );
		echo '<input type="text" class="regular-text code" id="ot_knowledge_slug" name="ot_knowledge_slug" placeholder="kb" value="' . esc_attr( $value ) . '" />';
	}

	/**
	 * Save permalink settings.
	 */
	public function settings_save() {

		if ( ! is_admin() ) {
			return;
		}

		// We need to save the options ourselves; settings api does not trigger save for the permalinks page.
		if ( isset( $_POST['permalink_structure'] ) ||
			 isset( $_POST['category_base'] ) &&
			 isset( $_POST['ot_knowledge_slug'] ) &&
			 wp_verify_nonce( wp_unslash( $_POST['ot_knowledge_slug_nonce'] ), 'ot-knowledge' ) ) { // WPCS: input var ok, sanitization ok.

			$ot_knowledge_slug = sanitize_title( wp_unslash( $_POST['ot_knowledge_slug'] ) );
			update_option( 'ot_knowledge_slug', $ot_knowledge_slug );
		}
	}
}


$ot_permalink_setting = new OT_Permalink_Setting();
