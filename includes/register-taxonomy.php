<?php
/**
 * Register Section Taxonomy.
 *
 * @package     knowledge-base-cpt
 * @copyright   Copyright (c) 2015, Danny Cooper
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Register Taxonomy.
 */
function ot_knowledge_section() {

	$labels = array(
		'name'                       => esc_html_x( 'Sections', 'Taxonomy General Name', 'ot-knowledge' ),
		'singular_name'              => esc_html_x( 'Section', 'Taxonomy Singular Name', 'ot-knowledge' ),
		'menu_name'                  => esc_html__( 'Sections', 'ot-knowledge' ),
		'all_items'                  => esc_html__( 'All Sections', 'ot-knowledge' ),
		'parent_item'                => esc_html__( 'Parent Section', 'ot-knowledge' ),
		'parent_item_colon'          => esc_html__( 'Parent Section:', 'ot-knowledge' ),
		'new_item_name'              => esc_html__( 'New Section Name', 'ot-knowledge' ),
		'add_new_item'               => esc_html__( 'Add New Section', 'ot-knowledge' ),
		'edit_item'                  => esc_html__( 'Edit Section', 'ot-knowledge' ),
		'update_item'                => esc_html__( 'Update Section', 'ot-knowledge' ),
		'separate_items_with_commas' => esc_html__( 'Separate sections with commas', 'ot-knowledge' ),
		'search_items'               => esc_html__( 'Search Sections', 'ot-knowledge' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove sections', 'ot-knowledge' ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used sections', 'ot-knowledge' ),
		'not_found'                  => esc_html__( 'Not Found', 'ot-knowledge' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => false,
	);

	register_taxonomy( 'section', array( 'knowledge_base' ), $args );

}

add_action( 'init', 'ot_knowledge_section', 0 );
