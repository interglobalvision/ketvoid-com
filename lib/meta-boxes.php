<?php

/* Get post objects for select field options */
function get_post_objects( $query_args ) {
$args = wp_parse_args( $query_args, array(
    'post_type' => 'post',
) );
$posts = get_posts( $args );
$post_options = array();
if ( $posts ) {
    foreach ( $posts as $post ) {
        $post_options [ $post->ID ] = $post->post_title;
    }
}
return $post_options;
}


/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Hook in and add metaboxes. Can only happen on the 'cmb2_init' hook.
 */
add_action( 'cmb2_init', 'igv_cmb_metaboxes' );
function igv_cmb_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_igv_';

	/**
	 * Metaboxes declarations here
   * Reference: https://github.com/WebDevStudios/CMB2/blob/master/example-functions.php
	 */

  // HOME

  $home_meta = new_cmb2_box( array(
    'id'            => $prefix . 'home_meta',
    'title'         => __( 'Home Options', 'cmb2' ),
    'object_types'  => array( 'page', ), // Post type
    'show_on'      => array( 'key' => 'id', 'value' => array( get_id_by_slug('home') ) ),
  ) );

  $home_meta->add_field( array(
    'name'    => __( 'Home Images', 'cmb2' ),
    'desc' => __( 'Add 4 images for Home page. Images layout clockwise, with the first image at top.', 'cmb2' ),
    'button' => 'Edit images', // Optionally set button label
    'clear-button' => 'Clear images', // Optionally set clear button label
    'id'      => $prefix . 'home_imgs',
    'type' => 'pw_gallery',
    'preview_size' => array( 200, 200 ), // Set the size of the thumbnails
    'sanitization_cb' => 'pw_gallery_field_sanitise', // REQUIRED
  ) );

  $home_meta->add_field( array(
    'name' => __( 'Vimeo video ID', 'cmb2' ),
    'desc' => __( 'string of numbers from Vimeo URL: https://vimeo.com/#########', 'cmb2' ),
    'id'   => $prefix . 'home_video_id',
    'type' => 'text',
  ) );

  $home_meta->add_field( array(
    'name' => __( 'Video Aspect Ratio Width', 'cmb2' ),
    'desc' => __( '', 'cmb2' ),
    'id'   => $prefix . 'home_video_width',
    'default' => '16',
    'type' => 'text',
  ) );

  $home_meta->add_field( array(
    'name' => __( 'Video Aspect Ratio Height', 'cmb2' ),
    'desc' => __( '', 'cmb2' ),
    'id'   => $prefix . 'home_video_height',
    'default' => '9',
    'type' => 'text',
  ) );

  // COLLECTION

  $collection_meta = new_cmb2_box( array(
    'id'            => $prefix . 'collection_meta',
    'title'         => __( 'Collection Options', 'cmb2' ),
    'object_types'  => array( 'collection', ), // Post type
  ) );

  $collection_meta->add_field( array(
    'name' => __( 'Background image', 'cmb2' ),
    'desc' => __( '', 'cmb2' ),
    'id'   => $prefix . 'collection_bg',
    'type' => 'file',
  ) );

  $collection_meta->add_field( array(
    'name'    => __( 'Images', 'cmb2' ),
    'button' => 'Edit images', // Optionally set button label
    'clear-button' => 'Clear images', // Optionally set clear button label
    'id'      => $prefix . 'collection_imgs',
    'type' => 'pw_gallery',
    'preview_size' => array( 200, 200 ), // Set the size of the thumbnails
    'sanitization_cb' => 'pw_gallery_field_sanitise', // REQUIRED
  ) );

}
?>
