<?php
/**
 * Register Section Taxonomy.
 *
 * @package     knowledge-base-cpt
 * @copyright   Copyright (c) 2015, Danny Cooper
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

/**
 * Register Taxonomy.
 */
function ot_knowledge_section() {

	$labels = array(
	'name'                       => _x( 'Sections', 'Taxonomy General Name', 'ot-knowledge' ),
	'singular_name'              => _x( 'Section', 'Taxonomy Singular Name', 'ot-knowledge' ),
	'menu_name'                  => __( 'Sections', 'ot-knowledge' ),
	'all_items'                  => __( 'All Sections', 'ot-knowledge' ),
	'parent_item'                => __( 'Parent Section', 'ot-knowledge' ),
	'parent_item_colon'          => __( 'Parent Section:', 'ot-knowledge' ),
	'new_item_name'              => __( 'New Section Name', 'ot-knowledge' ),
	'add_new_item'               => __( 'Add New Section', 'ot-knowledge' ),
	'edit_item'                  => __( 'Edit Section', 'ot-knowledge' ),
	'update_item'                => __( 'Update Section', 'ot-knowledge' ),
	'separate_items_with_commas' => __( 'Separate sections with commas', 'ot-knowledge' ),
	'search_items'               => __( 'Search Sections', 'ot-knowledge' ),
	'add_or_remove_items'        => __( 'Add or remove sections', 'ot-knowledge' ),
	'choose_from_most_used'      => __( 'Choose from the most used sections', 'ot-knowledge' ),
	'not_found'                  => __( 'Not Found', 'ot-knowledge' ),
	);
	$args = array(
	'labels'                     => $labels,
	'hierarchical'               => true,
	'public'                     => true,
	'show_ui'                    => true,
	'show_admin_column'          => true,
	'show_in_nav_menus'          => true,
	'show_tagcloud'              => false,
	);
	register_taxonomy( 'section', array( 'knowledge_base' ), $args );

}

add_action( 'init', 'ot_knowledge_section', 0 );

