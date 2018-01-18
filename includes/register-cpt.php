<?php
/**
 * Register Knowledge Base Custom Post Type.
 *
 * @package     knowledge-base-cpt
 * @copyright   Copyright (c) 2015, Danny Cooper
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Register Custom Post Type.
 */
function ot_knowledge_cpt() {

	$ot_knowledge_slug = get_option( 'ot_knowledge_slug', 'kb' );

	$labels = array(
		'name'               => esc_html_x( 'Articles', 'Post Type General Name', 'ot-knowledge' ),
		'singular_name'      => esc_html_x( 'Article', 'Post Type Singular Name', 'ot-knowledge' ),
		'menu_name'          => esc_html__( 'Knowledge Base', 'ot-knowledge' ),
		'parent_item_colon'  => esc_html__( 'Parent Articles:', 'ot-knowledge' ),
		'all_items'          => esc_html__( 'All Articles', 'ot-knowledge' ),
		'view_item'          => esc_html__( 'View Article', 'ot-knowledge' ),
		'add_new_item'       => esc_html__( 'Add New Article', 'ot-knowledge' ),
		'add_new'            => esc_html__( 'Add New', 'ot-knowledge' ),
		'edit_item'          => esc_html__( 'Edit Article', 'ot-knowledge' ),
		'update_item'        => esc_html__( 'Update Article', 'ot-knowledge' ),
		'search_items'       => esc_html__( 'Search Article', 'ot-knowledge' ),
		'not_found'          => esc_html__( 'Not found', 'ot-knowledge' ),
		'not_found_in_trash' => esc_html__( 'Not found in Trash', 'ot-knowledge' ),
	);

	$args = array(
		'label'               => esc_html__( 'knowledge_base', 'ot-knowledge' ),
		'description'         => esc_html__( 'Knowledge Base', 'ot-knowledge' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'page-attributes' ),
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
