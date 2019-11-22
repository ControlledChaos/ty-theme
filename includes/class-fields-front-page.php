<?php
/**
 * Front page field groups
 *
 * @package    TY_Theme
 * @subpackage controlled-chaos\admin
 * @since      1.0.0
 */

namespace TY_Theme\Admin;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Front page field groups
 */
final class Fields_Front_Page {

	/**
	 * Instance of the class
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object Returns the instance.
	 */
	public static function instance() {

		// Varialbe for the instance to be used outside the class.
		static $instance = null;

		if ( is_null( $instance ) ) {

			// Set variable for new instance.
			$instance = new self;

			// Register fields.
    		$instance->fields();

		}

		// Return the instance.
		return $instance;

	}

	/**
	 * Constructor method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void Constructor method is empty.
	 *              Change to `self` if used.
	 */
	public function __construct() {}

	/**
	 * Register settings page fields.
	 *
	 * Uses the universal slug partial for admin pages. Set this
     * slug in the core plugin file.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function fields() {

		if ( function_exists( 'acf_add_local_field_group' ) ) :

			acf_add_local_field_group(array(
				'key' => 'group_5ba297ff1d629',
				'title' => 'Front Page',
				'fields' => array(
					array(
						'key' => 'field_5da1f06c91e8b',
						'label' => 'Intro Gallery',
						'name' => 'ryt_intro_gallery',
						'type' => 'gallery',
						'instructions' => '<p class="description">Slideshow appears under the intro text. If only one image is set then it will appear as a ststic image, no animation.</p>
			<p class="description" style="margin-top: 1em;">Images must be at least 1280 pixels wide by 720 pixels high, the HD video aspect ration. The images will be automatically cropped or the can be manually cropped in the Media Library by selecting the image then clicking on Crop Sizes.</p>',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
						'preview_size' => 'preview-video',
						'insert' => 'append',
						'library' => 'all',
						'min' => '',
						'max' => '',
						'min_width' => 1280,
						'min_height' => 720,
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => '',
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'page_type',
							'operator' => '==',
							'value' => 'front_page',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'acf_after_title',
				'style' => 'seamless',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => array(
					0 => 'the_content',
					1 => 'discussion',
					2 => 'comments',
					3 => 'revisions',
					4 => 'slug',
					5 => 'author',
					6 => 'format',
					7 => 'categories',
					8 => 'tags',
					9 => 'send-trackbacks',
				),
				'active'      => true,
				'description' => 'For the front page of the website.',
			));

		endif;

	}

}

/**
 * Put an instance of the class into a function.
 *
 * @since  1.0.0
 * @access public
 * @return object Returns an instance of the class.
 */
function typ_fields_front_page() {

	return Fields_Front_Page::instance();

}

// Run an instance of the class.
typ_fields_front_page();