<?php
/**
 * Plugin load class.
 *
 * @author   ThimPress
 * @package  LearnPress/Students-List/Classes
 * @version  3.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'LP_Addon_Students_List' ) ) {
	/**
	 * Class LP_Addon_Students_List
	 */
	class LP_Addon_Students_List extends LP_Addon {

		/**
		 * @var string
		 */
		public $version = LP_ADDON_STUDENTS_LIST_VER;

		/**
		 * @var string
		 */
		public $require_version = LP_ADDON_STUDENTS_LIST_REQUIRE_VER;

		/**
		 * Path file addon
		 *
		 * @var string
		 */
		public $plugin_file = LP_ADDON_STUDENTS_LIST_FILE;

		/**
		 * LP_Addon_Students_List constructor.
		 */
		public function __construct() {
			parent::__construct();
		}

		/**
		 * Define Learnpress Students List constants.
		 *
		 * @since 3.0.0
		 */
		protected function _define_constants() {
			define( 'LP_ADDON_STUDENTS_LIST_PATH', dirname( LP_ADDON_STUDENTS_LIST_FILE ) );
			define( 'LP_ADDON_STUDENTS_LIST_INC', LP_ADDON_STUDENTS_LIST_PATH . '/inc/' );
			define( 'LP_ADDON_STUDENTS_LIST_TEMPLATE', LP_ADDON_STUDENTS_LIST_PATH . '/templates/' );
		}

		/**
		 * Includes.
		 */
		protected function _includes() {
			include_once LP_ADDON_STUDENTS_LIST_PATH . '/inc/widgets.php';
			include_once LP_ADDON_STUDENTS_LIST_PATH . '/inc/shortcodes.php';
		}

		/**
		 * Init hooks.
		 */
		protected function _init_hooks() {
			add_filter(
				'lp/course/meta-box/fields/general',
				function( $data ) {
					$data['_lp_hide_students_list'] = new LP_Meta_Box_Checkbox_Field(
						esc_html__( 'Students List', 'learnpress-students-list' ),
						esc_html__( 'Hide the students list in each individual course.', 'learnpress-students-list' ),
						'no'
					);

					return $data;
				}
			);

			// add student list tab in single course
			add_filter( 'learn-press/course-tabs', array( $this, 'add_single_course_students_list_tab' ), 5 );

			// Enqueue scripts
			add_filter( 'learn-press/frontend-default-scripts', array( $this, 'enqueue_js' ) );
		}

		/**
		 * Register or enqueue js
		 *
		 * @param array $scripts
		 * @author tungnx
		 * @since 4.0.1
		 * @return array
		 */
		public function enqueue_js( array $scripts ): array {
			$url = $this->get_plugin_url( 'assets/js/lp-students-list.min.js' );
			if ( LP_Debug::is_debug() ) {
				$url = $this->get_plugin_url( 'assets/js/lp-students-list.js' );
			}

			$scripts['addon-lp-students-list'] = new LP_Asset_Key(
				$url,
				array( 'jquery' ),
				array( LP_PAGE_SINGLE_COURSE ),
				0,
				1,
				LP_ADDON_STUDENTS_LIST_VER
			);

			return $scripts;
		}

		/**
		 * Assets.
		 */
		/*protected function _enqueue_assets() {
			if ( LP_Debug::is_debug() ) {
				wp_enqueue_style( 'learnpress-students-list', $this->get_plugin_url( 'assets/css/styles.css' ), array(), uniqid() );
				wp_enqueue_script( 'learnpress-students-list', $this->get_plugin_url( 'assets/js/scripts.js' ), array( 'jquery' ), uniqid() );
			} else {
				wp_enqueue_style( 'learnpress-students-list', $this->get_plugin_url( 'assets/css/styles.min.css' ), array(), LP_ADDON_STUDENTS_LIST_VER );
				wp_enqueue_script( 'learnpress-students-list', $this->get_plugin_url( 'assets/js/scripts.min.js' ), array( 'jquery' ), LP_ADDON_STUDENTS_LIST_VER );
			}
		}*/

		/**
		 * Add students list settings in course meta box.
		 *
		 * @param $meta_box
		 *
		 * @return mixed
		 */
		public function add_meta_box( $meta_box ) {
				$meta_box['fields'][] = array(
					'name' => __( 'Students List', 'learnpress-students-list' ),
					'id'   => '_lp_hide_students_list',
					'std'  => 'yes',
					'desc' => __( 'Hide the students list in each individual course.', 'learnpress-students-list' ),
					'type' => 'yes_no',
				);

				return $meta_box;
		}


		/**
		 * Students list tab in single course page.
		 *
		 * @param $tabs
		 *
		 * @return mixed
		 */
		public function add_single_course_students_list_tab( $tabs ) {
			$course = LP_Global::course();
			if ( ! $course ) {
				return $tabs;
			}

			$hide_students_list = get_post_meta( $course->get_id(), '_lp_hide_students_list', true );
			if ( $hide_students_list != 'yes' ) {

				$tabs['students-list'] = array(
					'title'    => __( 'Students List', 'learnpress-announcements' ),
					'priority' => 40,
					'callback' => array( $this, 'single_course_students_list_tab_content' ),
				);

			}

			return $tabs;
		}

		/**s
		 * Students list tab content in single course page.
		 */
		public function single_course_students_list_tab_content() {
			$course = LP_Global::course();
			learn_press_get_template( 'students-list.php', array( 'course' => $course ), learn_press_template_path() . '/addons/students-list/', LP_ADDON_STUDENTS_LIST_TEMPLATE );
		}
	}
}
