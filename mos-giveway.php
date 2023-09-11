<?php
/**
 * Plugin Name:       Mos Giveway
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       mos-giveway
 *
 * @package           create-block
 */
function create_block_mos_giveway_block_init() {
	register_block_type( __DIR__ . '/build/row' );
	register_block_type( __DIR__ . '/build/column' );
	register_block_type( __DIR__ . '/build/section' );
	register_block_type( __DIR__ . '/build/recent-posts', array(
        'render_callback' => 'gutenberg_examples_dynamic_render_callback'
    ) );
}
add_action( 'init', 'create_block_mos_giveway_block_init' );

function gutenberg_examples_dynamic_render_callback( $attr , $content ) {
	$html = '';
    $recent_posts = wp_get_recent_posts( array(
        'numberposts' => (@$attr['numberOfItems'])?$attr['numberOfItems']:3,
        'post_status' => 'publish',
    ) );
    if ( count( $recent_posts ) === 0 ) {
        return 'No posts';
    }
	$html .= '<ul>';
	foreach($recent_posts as $post){
		$html .= '<li><a class="wp-block-my-plugin-latest-post" href="'.get_permalink( $post['ID'] ).'">'.get_the_title($post['ID']).'</a></li>';
	}
	$html .= '<ul>';
	return $html;
}
function register_mos_giveway_blocks_category( $categories ) {
	
	$categories[] = array(
		'slug'  => 'mos-giveway-blocks',
		'title' => 'Mos Blocks'
	);

	return $categories;
}

if ( version_compare( get_bloginfo( 'version' ), '5.8', '>=' ) ) {
	add_filter( 'block_categories_all', 'register_mos_giveway_blocks_category' );
} else {
	add_filter( 'block_categories', 'register_mos_giveway_blocks_category' );
}