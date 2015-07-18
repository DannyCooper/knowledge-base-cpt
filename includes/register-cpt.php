<?php
/**
 * Register Knowledge Base Custom Post Type.
 *
 * @package     knowledge-base-cpt
 * @copyright   Copyright (c) 2015, Danny Cooper
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

/**
 * Register Custom Post Type.
 */
function ot_knowledge_cpt() {

	$ot_knowledge_slug = get_option( 'ot_knowledge_slug', 'kb' );

	$labels = array(
	'name'                => _x( 'Articles', 'Post Type General Name', 'ot-knowledge' ),
	'singular_name'       => _x( 'Article', 'Post Type Singular Name', 'ot-knowledge' ),
	'menu_name'           => __( 'Knowledge Base', 'ot-knowledge' ),
	'parent_item_colon'   => __( 'Parent Articles:', 'ot-knowledge' ),
	'all_items'           => __( 'All Articles', 'ot-knowledge' ),
	'view_item'           => __( 'View Article', 'ot-knowledge' ),
	'add_new_item'        => __( 'Add New Article', 'ot-knowledge' ),
	'add_new'             => __( 'Add New', 'ot-knowledge' ),
	'edit_item'           => __( 'Edit Article', 'ot-knowledge' ),
	'update_item'         => __( 'Update Article', 'ot-knowledge' ),
	'search_items'        => __( 'Search Article', 'ot-knowledge' ),
	'not_found'           => __( 'Not found', 'ot-knowledge' ),
	'not_found_in_trash'  => __( 'Not found in Trash', 'ot-knowledge' ),
	);
	$args = array(
	'label'               => __( 'knowledge_base', 'ot-knowledge' ),
	'description'         => __( 'Knowledge Base', 'ot-knowledge' ),
	'labels'              => $labels,
	'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions' ),
	'taxonomies'          => array( 'section' ),
	'hierarchical'        => false,
	'public'              => true,
	'show_ui'             => true,
	'show_in_menu'        => true,
	'show_in_nav_menus'   => true,
	'show_in_admin_bar'   => true,
	'menu_position'       => 20,
	'can_export'          => true,
	'has_archive'         => true,
	'exclude_from_search' => false,
	'publicly_queryable'  => true,
	'capability_type'     => 'page',
	'rewrite'             => array( 'slug' => $ot_knowledge_slug ),
	);
	register_post_type( 'knowledge_base', $args );

}

add_action( 'init', 'ot_knowledge_cpt', 0 );
