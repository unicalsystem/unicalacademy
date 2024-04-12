<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'LP_PMS_Background_Single_Course' ) ) {
	/**
	 * Class LP_PMS_Background_Single_Course
	 *
	 * Single to run not schedule, run one time and done when be call
	 *
	 * @version 1.0.0
	 * @since 4.0.2
	 * @author minhpd
	 */
	class LP_PMS_Background_Single_Course extends LP_Async_Request {
		protected $prefix = 'lp_pms';
		protected $action = 'create_lp_order_when_change_membership';
		protected static $instance;

		protected function handle() {

			$params = array(
				'level_id'   => LP_Request::get_param( 'level_id', 0, 'int', 'post' ),
				'total_page' => LP_Request::get_param( 'total_page', 0, 'int', 'post' ),
				'p'          => LP_Request::get_param( 'p', 0, 'int', 'post' ),
				'limit'      => LP_Request::get_param( 'limit', 0, 'int', 'post' ),
			);

			if ( ! empty( $_POST['level_course_ids'] ) ) {
				$params['lp_orders']        = LP_Helper::sanitize_params_submitted( $_POST['lp_orders'] ?? array() );
				$params['level_course_ids'] = LP_Helper::sanitize_params_submitted( $_POST['level_course_ids'] );

				$this->handleAddItemsToLpOrdersBackgroundWhenCoursesLevelChange( $params );
			} else {
				$params['user_id']     = LP_Request::get_param( 'user_id', 0, 'int', 'post' );
				$params['lp_order_id'] = LP_Request::get_param( 'lp_order_id', 0, 'int', 'post' );

				$this->handleAddItemsToLpOrderBackground( $params );
			}

		}

		/**
		 * handle add course to lp_order
		 *
		 * @param array $params
		 */

		protected function handleAddItemsToLpOrderBackground( array $params ) {

			$lp_pms_order = new LP_PMS_Order();

			$courses = LP_PMS_DB::getInstance()->getCoursesByLevel( $params['level_id'], $params['p'], $params['limit'] );

			if ( is_array( $courses ) && count( $courses ) > 0 ) {
				$course_ids = array_keys( $courses );
				$params_rs  = $lp_pms_order->addItemsToLpOrder( $params, $course_ids );

				if ( isset( $params_rs['p'] ) && $params_rs['p'] < $params_rs['total_page'] ) {
					++ $params_rs['p'];
					$this->data( $params_rs )->dispatch();
				}
			}
		}

		/**
		 * handle add courses to Lp orders when change courses on level
		 *
		 * @param array $params
		 */
		protected function handleAddItemsToLpOrdersBackgroundWhenCoursesLevelChange( array $params ) {

			$lp_pms_order = new LP_PMS_Order();

			$level_course_ids = $params['level_course_ids'];
			$limit            = $params['limit'];
			$end              = $params['p'] * $limit + $limit;
			$i                = $params['p'];
			$lp_orders        = $params['lp_orders'];

			$lp_orders_limit = array_slice( $lp_orders, $i, $end );

			foreach ( $lp_orders_limit as $lp_order ) {
				// Get course ids on Lp order
				$order_course_ids = LP_PMS_DB::getInstance()->getCourseIdsOnLpOrder( absint( $lp_order['order_id'] ) );

				$order_course_ids = array_keys( $order_course_ids );

				$remove_course_ids = array_diff( $order_course_ids, $level_course_ids );
				$add_course_ids    = array_diff( $level_course_ids, $order_course_ids );

				// Delete courses on Order
				if ( count( $remove_course_ids ) > 0 ) {
					$lp_pms_order->deleteCoursesOnOrder( absint( $lp_order['order_id'] ), $remove_course_ids );
				}

				// Add courses to Order
				if ( count( $add_course_ids ) > 0 ) {
					$params['lp_order_id'] = absint( $lp_order['order_id'] );
					$params['user_id']     = absint( $lp_order['user_id'] );
					$param_results         = $lp_pms_order->addItemsToLpOrder( $params, $add_course_ids );

					if ( isset( $param_results['p'] ) && $param_results['p'] < $param_results['total_page'] ) {
						++ $param_results['p'];
						$this->data( $param_results )->dispatch();
					}
				}
			}
		}

		/**
		 * @return LP_PMS_Background_Single_Course
		 */
		public static function instance(): self {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}
	}

	// Must run instance to register ajax.
	LP_PMS_Background_Single_Course::instance();
}
