<?php
/**
 * Plugin load class.
 *
 * @author   ThimPress
 * @package  LearnPress/Content-Drip/Classes
 * @version  3.0.0
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'LP_Addon_Content_Drip' ) ) {
	/**
	 * Class LP_Addon_Content_Drip
	 */
	class LP_Addon_Content_Drip extends LP_Addon {
		/**
		 * Addon version
		 *
		 * @var string
		 */
		public $version = LP_ADDON_CONTENT_DRIP_VER;

		/**
		 * Require LP version
		 *
		 * @var string
		 */
		public $require_version = LP_ADDON_CONTENT_DRIP_REQUIRE_VER;

		/**
		 * Path file addon
		 *
		 * @var string
		 */
		public $plugin_file = LP_ADDON_CONTENT_DRIP_FILE;

		/**
		 * Metabox data
		 *
		 * @var null
		 */
		protected $_meta_box = null;

		/**
		 * @var array
		 */
		protected $_drip_items = array();

		/**
		 * LP_Addon_Content_Drip constructor.
		 */
		public function __construct() {
			parent::__construct();
		}

		/**
		 * Include files.
		 */
		protected function _includes() {
			require_once LP_ADDON_CONTENT_DRIP_INC_PATH . 'admin/class-drip-items-list-table.php';
			//api
			require_once LP_ADDON_CONTENT_DRIP_INC_PATH . 'admin/api/class-lp-content-drip-api.php';
			// Hooks
			require_once LP_ADDON_CONTENT_DRIP_INC_PATH . '/class-lp-content-drip-hooks.php';
			LP_Content_Drip_Hooks::instance();
		}

		/**
		 * It converts the time into seconds.
		 *
		 * @param int|float $number The number of units you want to convert.
		 * @param string $unit The unit of time you want to convert to seconds.
		 *
		 * @return float|int
		 */
		public function lpcd_data_to_seconds( $number, $unit ) {
			$weight_number = '';
			$seconds       = 60;
			if ( $unit == 'minute' ) {
				$weight_number = 60;
			} elseif ( $unit == 'hour' ) {
				$weight_number = $seconds * 60;
			} elseif ( $unit == 'day' ) {
				$weight_number = $seconds * 60 * 24;
			} elseif ( $unit == 'week' ) {
				$weight_number = $seconds * 60 * 24 * 7;
			}

			return $number * $weight_number;
		}

		/**
		 * This function is used to create an array of drip types
		 */
		public function lp_content_drip_types() {
			$types = array(
				'specific_date' => esc_html__( '1. Specific time after enrolled course', 'learnpress-content-drip' ),
				'sequentially'  => esc_html__( '2. Open the course items sequentially', 'learnpress-content-drip' ),
				'prerequisite'  => esc_html__( '3. Open item bases on prerequisite items', 'learnpress-content-drip' ),
			);

			return apply_filters( ' learn-press/content-drip/drip-types', $types );
		}

		/**
		 * Add email classes.
		 * Todo : not use
		 */
		public function add_content_drip_emails() {
			LP_Emails::instance()->emails['LP_Email_Drip_Item_Available'] = include( 'class-lp-email-drip-item-available.php' );
		}

		/**
		 * @param     $item_id
		 * @param int $course_id
		 * @param int $user_id
		 *
		 * @return bool|mixed
		 */
		/*public function get_drip_item( $item_id, $course_id = 0, $user_id = 0 ) {
			$items = $this->get_drip_items( $course_id, $user_id );
			if ( $items ) {
				return $items[ $item_id ] ?? false;
			}

			return false;
		}*/

		/**
		 * Get all items for dripping from cache, if there is no items then calculate.
		 *
		 * @param int $course_id
		 * @param int $user_id
		 *
		 * @return array|bool|mixed
		 */
		/*public function get_drip_items( $course_id = 0, $user_id = 0 ) {
			if ( ! $course_id ) {
				$course_id = get_the_ID();
			}
			if ( ! $user_id ) {
				$user_id = get_current_user_id();
			}

			$items = wp_cache_get( 'drip-item-' . $course_id, 'drip-items-' . $user_id );
			if ( false === $items ) {
				$items = $this->calculate_items( $course_id, $user_id );
				wp_cache_set( 'drip-item-' . $course_id, $items, 'drip-items-' . $user_id );
			}
			return $items;
		}*/

		/**
		 * Calculate time to open items in a course.
		 *
		 * @param int $course_id
		 * @param int $user_id
		 *
		 * @return array
		 */
		//      public function calculate_items( $course_id = 0, $user_id = 0 ) {
		//          $items = array();
		//          if ( ! is_user_logged_in() ) {
		//              return $items;
		//          }
		//
		//          $course = learn_press_get_course( $course_id );
		//          $user   = $user_id ? learn_press_get_user( $user_id ) : learn_press_get_current_user();
		//
		//          if ( ! $user || ! $course ) {
		//              return $items;
		//          }
		//
		//          // check enable drip item
		//          if ( get_post_meta( $course_id, '_lp_content_drip_enable', true ) != 'yes' ) {
		//              return $items;
		//          }
		//
		//          $drip_items = get_post_meta( $course_id, '_lp_drip_items', true );
		//          if ( ! $drip_items ) {
		//              return $items;
		//          }
		//
		//          /*$course_items = $course->get_item_ids();
		//          $course_items = array_map(
		//              function ( $item_id ) {
		//                  return (string) $item_id;
		//              },
		//              $course_items
		//          );*/
		//          $course_data = $user->get_course_data( $course_id );
		//          if ( ! $course_data ) {
		//              return $items;
		//          }
		//
		//          $start_course_time = $course_data->get_start_time();
		//          $drip_type         = get_post_meta( $course_id, '_lp_content_drip_drip_type', true );
		//          switch ( $drip_type ) {
		//              // open the course items sequentially
		//              case 'sequentially':
		//                  $items = $this->drip_type_sequentially( $drip_items, $course_data );
		//                  break;
		//              // specific time after enrolled course
		//              case 'specific_date':
		//                  $items = $this->drip_type_specific_date( $drip_items, $course_data );
		//                  break;
		//              // open item bases on prerequisite items
		//              case 'prerequisite':
		//                  $items = $this->drip_type_prerequisite( $drip_items, $course_data );
		//                  break;
		//              default:
		//                  do_action( 'learn-press/content-drip/calculate-items', $course_id, $user_id, $drip_type );
		//                  break;
		//          }
		//
		//          return apply_filters( 'lp_calculate_time_drip_items', $items, $course_id, $user_id );
		//      }

		/**
		 * Check drip item
		 *
		 * @param LP_Course_Item $item
		 * @param LP_Course $course
		 * @param LP_Abstract_User $user
		 *
		 * @return array
		 */
		public function check_drip_item( LP_Course_Item $item, LP_Course $course, LP_Abstract_User $user ): array {
			$rs = [
				'locked'  => 0,
				'message' => '',
			];

			try {
				$item_author_id = get_post_field( 'post_author', $item->get_id() );
				// No apply for admin and author of course, author of item.
				if ( current_user_can( 'administrator' ) ||
					$course->get_author( 'id' ) === $user->get_id() ||
					$item_author_id === $user->get_id() ) {
					return $rs;
				}

				$course_id = $course->get_id();

				// Check content drip is enable.
				$enable = 'yes' === get_post_meta( $course_id, '_lp_content_drip_enable', true );
				if ( ! $enable ) {
					return $rs;
				}

				// If course is preview, set block
				if ( $item->is_preview() && $user instanceof LP_User_Guest ) {
					$rs['locked']  = 1;
					$rs['message'] = __( 'This item is locked', 'learnpress-content-drip' );

					return $rs;
				}

				// Check has settings for each item of course.
				$drip_items = get_post_meta( $course_id, '_lp_drip_items', true );
				if ( ! $drip_items ) {
					return $rs;
				}

				// Get drip type
				$drip_type = get_post_meta( $course_id, '_lp_content_drip_drip_type', true );

				$user_course = $user->get_course_data( $course_id );
				if ( ! $user_course ) {
					return $rs;
				}

				$drip_item = $drip_items[ $item->get_id() ] ?? false;
				if ( ! $drip_item ) {
					return $rs;
				}

				switch ( $drip_type ) {
					case 'sequentially':
						$args = compact( 'course', 'item', 'user_course', 'drip_item' );
						$this->drip_type_sequentially( $rs, $args );
						break;
					case 'specific_date':
						$args = compact( 'user_course', 'drip_item' );
						$this->drip_type_specific_date( $rs, $args );
						break;
					case 'prerequisite':
						$args = compact( 'course', 'item', 'user_course', 'drip_item' );
						$this->drip_type_prerequisite( $rs, $args );
						break;
					default:
						do_action( 'learn-press/content-drip/check-item', $course, $item, $user, $drip_type, $this );
						break;
				}
			} catch ( Throwable $e ) {
				error_log( 'check_drip_item_err: ' . $e->getMessage() );
			}

			return $rs;
		}

		/**
		 * Drip type Specific date
		 * Check delay time for each item of course.
		 *
		 * @param array $rs
		 * @param array $args
		 *
		 * @return void
		 */
		private function drip_type_specific_date( array &$rs, array $args ) {
			if ( ! isset( $args['user_course'] ) || ! $args['user_course'] instanceof LP_User_Item_Course ) {
				return;
			}
			$user_course = $args['user_course'];
			$drip_args   = $args['drip_item'] ?? [];

			$start_course_time            = $user_course->get_start_time()->getTimestamp();
			$drip_args['timestamp_point'] = $start_course_time;
			$this->delay_type( $rs, $drip_args );

			$rs = apply_filters( 'lp/content-drip/drip_type_specific_date', $rs, $args, $this );
		}

		/**
		 * Drip type Sequentially
		 * Check delay time for each item of course.
		 * Check item previous is completed.
		 *
		 * @param array $rs
		 * @param array $args
		 */
		private function drip_type_sequentially( array &$rs, array $args ) {
			if ( ! isset( $args['user_course'] ) || ! $args['user_course'] instanceof LP_User_Item_Course ||
				! isset( $args['course'] ) || ! $args['course'] instanceof LP_Course ||
				! isset( $args['item'] ) || ! $args['item'] instanceof LP_Course_Item ) {
				return;
			}

			$is_locked   = 0;
			$user_course = $args['user_course'];
			$course      = $args['course'];
			$item        = $args['item'];
			$drip_args   = $args['drip_item'] ?? [];

			$start_course_time = $user_course->get_start_time()->getTimestamp();
			$item_ids          = $course->get_item_ids();
			$item_id           = $item->get_id();

			$first_item_id_course = $course->get_first_item_id();

			$drip_args['timestamp_point'] = $start_course_time;

			if ( $first_item_id_course !== $item_id ) {
				$item_id_prev = $item_ids[ array_search( $item_id, $item_ids ) - 1 ];
				$user_item    = $user_course->get_item( $item_id_prev );

				if ( ! $user_item || ! $user_item->is_completed() ) {
					$is_locked = 1;
				}
				$is_locked = apply_filters( 'lp/content-drip/drip_type_sequentially/item-is-complete', $is_locked, $user_item, $args, $this );

				$rs['locked']  = $is_locked;
				$rs['message'] = sprintf(
					__( 'You must complete the item "<a href=%1$s>%2$s</a>" before this item is available.', 'learnpress-content-drip' ),
					$course->get_item_link( $item_id_prev ),
					get_the_title( $item_id_prev )
				);
			}

			// Check time delay
			if ( ! $rs['locked'] ) {
				$this->delay_type( $rs, $drip_args );
			}

			$rs = apply_filters( 'lp/content-drip/drip_type_sequentially', $rs, $args, $this );
		}

		/**
		 * Drip type: Prerequisite
		 * Check items required is completed.
		 * Check delay time for each item of course.
		 *
		 * @param array $rs
		 * @param array $args
		 *
		 * @return void
		 */
		private function drip_type_prerequisite( array &$rs, array $args ) {
			if ( ! isset( $args['user_course'] ) || ! $args['user_course'] instanceof LP_User_Item_Course ||
				! isset( $args['course'] ) || ! $args['course'] instanceof LP_Course ) {
				return;
			}

			$user_course                  = $args['user_course'];
			$course                       = $args['course'];
			$drip_args                    = $args['drip_item'] ?? [];
			$drip_args['timestamp_point'] = $user_course->get_start_time()->getTimestamp();
			$item_ids_must_completed      = $drip_args['prerequisite'] ?? [];
			$has_item_not_completed       = false;

			foreach ( $item_ids_must_completed as $item_must_complete ) {
				$user_item = $user_course->get_item( $item_must_complete );
				if ( ! $user_item || ! $user_item->is_completed() ) {
					$has_item_not_completed = true;
				}

				$has_item_not_completed = apply_filters(
					'lp/content-drip/drip_type_prerequisite/item-is-complete',
					$has_item_not_completed,
					$user_item,
					$args,
					$this
				);
			}

			if ( $has_item_not_completed ) {
				$item_must_completed = [];
				foreach ( $item_ids_must_completed as $item_must_complete_id ) {
					$item                  = get_post( $item_must_complete_id );
					$item_link             = $course->get_item_link( $item_must_complete_id );
					$item_must_completed[] = sprintf( '<a href="%s">%s</a>', $item_link, $item->post_title );
				}

				$item_must_completed_str = implode( ', ', $item_must_completed );

				$rs['locked']  = true;
				$rs['message'] = sprintf(
					__( 'You must complete the item: %s before this item is available.', 'learnpress-content-drip' ),
					$item_must_completed_str
				);
			}

			// Check time delay
			if ( ! $rs['locked'] ) {
				$this->delay_type( $rs, $drip_args );
			}

			$rs = apply_filters( 'lp/content-drip/drip_type_prerequisite', $rs, $args, $this );
		}

		/**
		 * Check delay time.
		 *
		 * @param array $rs
		 * @param array $drip_args
		 */
		private function delay_type( array &$rs, array $drip_args ) {
			try {
				$timestamp_point = $drip_args['timestamp_point'] ?? 0;
				$tz_offset       = get_option( 'gmt_offset' );
				if ( $tz_offset >= 0 ) {
					$tz_offset = '+' . $tz_offset;
				} else {
					$tz_offset = '-' . $tz_offset;
				}
				$wp_timezone = wp_timezone_string();
				$is_utc      = (int) $wp_timezone !== 0;
				$dateFormat  = get_option( 'date_format' );
				$timeFormat  = get_option( 'time_format' );

				if ( $is_utc ) {
					$wp_timezone = 'Timezone: UTC' . $wp_timezone;
				}

				//error_log( 'xxxx:' . print_r( $drip_args, true ) );
				switch ( $drip_args['type'] ?? '' ) {
					case 'specific':
						$date_str      = '';
						$timestamp_end = $drip_args['date'] ?? 0;
						$timestamp_now = time();
						$time_end      = new DateTime( '@' . $timestamp_end, new DateTimeZone( 'UTC' ) );
						$time_now      = new DateTime( 'now', new DateTimeZone( 'UTC' ) );
						$thirty_days   = 28 * 24 * 60 * 60;

						if ( $timestamp_now < $timestamp_end ) {
							$rs['locked'] = 1;

							if ( $timestamp_end - $timestamp_now > $thirty_days ) {
								$time_end_by_timezone_current = clone $time_end;
								$time_end_by_timezone_current->setTimezone( new DateTimeZone( $tz_offset ) );
								$date_str = $time_end_by_timezone_current->format( $dateFormat . ' ' . $timeFormat );
							} else {
								$date_str = 'around ' . self::format_human_time_diff( $time_now, $time_end );
							}

							$rs['message'] = sprintf(
								__( 'This item will be available in %1$s (%2$s)', 'learnpress-content-drip' ),
								$date_str,
								$wp_timezone
							);
						}
						break;
					case 'interval':
						$timestamp_duration = $drip_args['interval'][2] ?? 0;
						$timestamp_end      = $timestamp_point + $timestamp_duration;
						$time_end           = new DateTime( '@' . $timestamp_end, new DateTimeZone( 'UTC' ) );
						$timestamp_current  = time();
						$time_now           = new DateTime( 'now', new DateTimeZone( 'UTC' ) );

						if ( $timestamp_current < $timestamp_end ) {
							$rs['locked']  = 1;
							$rs['message'] = sprintf(
								__( 'This item will be available in around %1$s (%2$s)', 'learnpress-content-drip' ),
								$this->format_human_time_diff( $time_end, $time_now ),
								$wp_timezone
							);
						}
						break;
					default:
						break;
				}
			} catch ( Throwable $e ) {
				error_log( 'Delay calculate:' . $e->getMessage() );
			}
		}

		/**
		 * Display date human time diff.
		 * 1. Show number days, hours if >= 1 days
		 * 2. Show number hours, seconds if >= 1 hours
		 * 3. Show number seconds if < 1 hours
		 *
		 * @param DateTime $date_start
		 * @param DateTime $date_end
		 *
		 * @version 1.0.0
		 * @since 4.0.3
		 * @return string
		 */
		public static function format_human_time_diff( DateTime $date_start, DateTime $date_end ): string {
			$diff = $date_end->diff( $date_start );

			$format_date = '';
			if ( $diff->d > 0 ) {
				$format_date .= '%d days, ';

				if ( $diff->h > 0 ) {
					$format_date .= '%h hours';
				}
			} elseif ( $diff->h > 0 ) {
				$format_date .= '%h hours, ';

				if ( $diff->i > 0 ) {
					$format_date .= '%i minutes';
				}
			} elseif ( $diff->i > 0 ) {
				$format_date .= '<span class="minute">%i</span> minutes';
			} else {
				$format_date .= '<span class="second">%s</span> seconds';
			}

			return $diff->format( $format_date );
		}

		/**
		 * Calculate drip course item bases on enrolled course time
		 *
		 * @param $start_course_time LP_Datetime
		 * @param $args              'drip item args'
		 *
		 * @return array
		 * @deprecated 4.0.3
		 */
		private function _calculate_enrolled_course( $start_course_time, $args ) {
			if ( isset( $args['type'] ) ) {
				switch ( $args['type'] ) {
					case 'specific':
						$open_time = new LP_Datetime( $args['date'] );
						break;
					case 'interval':
						$open_time = new LP_Datetime( $start_course_time->getTimestamp() + $args['interval'][2] );
						break;
					default:
						$open_time = new LP_Datetime( $start_course_time->getTimestamp() );
						break;
				}
			} else {
				$open_time = new LP_Datetime( $start_course_time->getTimestamp() );
			}

			return array(
				'locked'    => $open_time->is_exceeded(),
				'open_item' => $open_time,
			);
		}

		/**
		 * @param       $course     LP_Course
		 * @param       $user       LP_User
		 * @param array $deps_items depends on items
		 * @param       $args       'drip item args'
		 *
		 * @return array
		 * @deprecated 4.0.3
		 */
		private function _calculate_dependent_items( $course, $user, $deps_items = array(), $args = null ) {

			$locked = false;

			foreach ( $deps_items as $deps_item_id ) {
				// get user depends item data
				$item_data = $user->get_item_data( $deps_item_id, $course->get_id() );
				if ( ! $item_data ) {
					$locked = true;
					continue;
				}
				$end_time = $item_data->get_end_time();

				$item_type   = get_post_type( $deps_item_id );
				$item_status = apply_filters( 'learn-press/content-drip/item-status', $user->get_item_status( $deps_item_id, $course->get_id() ), $deps_item_id, $course->get_id(), $user );
				if ( LP_QUIZ_CPT == $item_type && 'passed' !== $user->get_item_grade( $deps_item_id, $course->get_id() ) ) {
					$locked    = true;
					$open_time = false;
				} elseif ( $item_status != 'completed' ) {
					$locked = true;

					// return open time false for un-completed depends item
					$open_time = false;
				} else {
					switch ( $args['type'] ) {
						case 'specific':
							$open_time = new LP_Datetime( $args['date'] );
							break;
						case 'interval':
							$open_time = new LP_Datetime( $end_time->getTimestamp() + $args['interval'][2] );
							break;
						default:
							$open_time = false;
							break;
					}
				}

				$args['open_time'][ $deps_item_id ] = $open_time;

				if ( $open_time && $open_time->is_exceeded() ) {
					$locked = true;
				}
			}

			return array(
				'locked'  => $locked,
				'depends' => $args,
			);
		}

		/**
		 * Todo : not use
		 * @deprecated 4.0.3
		 */
		public function ctdrip_can_view( $view ) {
			$view->key     = null;
			$view->flag    = false;
			$view->message = 'test';
			return $view;
		}
	}
}
