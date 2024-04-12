<?php

/**
 * Class LP_PMPro_User_Hooks
 */
class LP_PMPro_User_Hooks {

	public function __construct() {
		// add hook for CAN ENROLL COURSE
		add_filter( 'learn_press_user_can_enroll_course', array( $this, 'can_enroll_course_callback' ), 11, 3 );
		add_filter( 'learnpress/course/template/button-enroll/can-show', array( $this, 'can_show_button_enroll_course_callback' ), 11, 3 );

		// add hook for CAN PURCHASE COURSE
		//add_filter( 'learnpress/course/template/button-purchase/can-show', array( $this, 'can_show_button_purchase_course_callback' ), 11, 3 );
		add_filter( 'learn-press/user/can-purchase-course', array( $this, 'can_purchase_course_callback' ), 11, 3 );

		// add hook for can_retake_course
		// add hook for can_retake_course
		// add_filter( 'learn_press_user_can_retake_course', array( $this, 'can_retake_course_callback' ), 11, 3 );
		// add_filter( 'learn_press_user_has_purchased_course', array( $this, 'has_purchased_course_callback' ), 11, 3 );
		// tungnx
	}

	/**
	 * @param $can_purchase
	 * @param $user_id
	 * @param $course_id
	 * @return bool
	 */
	public function can_purchase_course_callback( $can_purchase, $user_id, $course_id ) {
		if ( ! $course_id ) {
			return $can_purchase;
		}

		$course_levels  = learn_press_pmpro_get_course_levels( $course_id );
		$buy_membership = ( LearnPress::instance()->settings()->get( 'buy_through_membership' ) === 'yes' );

		$has_membership_level = learn_press_pmpro_hasMembershipLevel( $course_levels, $user_id );

		if ( $has_membership_level ) {
			return $can_purchase;
		}

		if ( ! empty( $course_levels ) ) {
			if ( $buy_membership ) {
				$can_purchase = false;
			}
		}

		return $can_purchase;
	}

	/**
	 * @param $can_show
	 * @param $user
	 * @param $course
	 * @return bool
	 */
	public function can_show_button_enroll_course_callback( $can_show, $user, $course ) {

		if ( ! $course || ! $user ) {
			return $can_show;
		}

		$user_id        = $user->get_id();
		$course_id      = $course->get_id();
		$course_levels  = learn_press_pmpro_get_course_levels( $course_id );
		$buy_membership = ( LearnPress::instance()->settings()->get( 'buy_through_membership' ) === 'yes' );

		$has_membership_level = learn_press_pmpro_hasMembershipLevel( $course_levels, $user_id );

		if ( $has_membership_level ) {
			return $can_show;
		}

		if ( ! empty( $course_levels ) ) {
			if ( $buy_membership ) {
				$can_show = false;
			}
		}

		return $can_show;
	}

	// /**
	//  * @param $can_purchase
	//  * @param $user
	//  * @param $course
	//  * @return bool
	//  */
	// public function can_show_button_purchase_course_callback( $can_purchase, $user, $course ) {

	// 	if ( ! $course || ! $user ) {
	// 		return $can_purchase;
	// 	}
	// 	$user_id        = $user->get_id();
	// 	$course_id      = $course->get_id();
	// 	$course_levels  = learn_press_pmpro_get_course_levels( $course_id );
	// 	$buy_membership = LearnPress::instance()->settings()->get( 'buy_through_membership' ) === 'yes';

	// 	$has_membership_level = learn_press_pmpro_hasMembershipLevel( $course_levels, $user_id );

	// 	if ( $has_membership_level ) {
	// 		return $can_purchase;
	// 	}

	// 	if ( ! empty( $course_levels ) ) {
	// 		if ( $buy_membership ) {
	// 			$can_purchase = false;
	// 		}
	// 	}

	// 	return $can_purchase;
	// }

	public function can_retake_course_callback( $can_retake, $course_id, $user_id ) {
		if ( $can_retake ) {
			return $can_retake;
		}

		$course_levels = learn_press_pmpro_get_course_levels( $course_id );
		if ( empty( $course_levels ) ) {
			return $can_retake;
		}

		$has_membership_level = learn_press_pmpro_hasMembershipLevel( $course_levels, $user_id );
		if ( $has_membership_level ) {
			if ( ! $can_retake || $can_retake < 1 ) {
				$can_retake = 1;
			}
		}

		return $can_retake;
	}

	public function has_purchased_course_callback( $has_purchased, $course_id, $user_id ) {
		if ( $has_purchased ) {
			$user          = learn_press_get_user( $user_id );
			$course_status = $user->get_course_status( $course_id );

			if ( $course_status === 'canceled' ) {
				$has_purchased = false;
			} elseif ( $course_status === 'finished' && ! $user->can_retake_course( $course_id ) ) {
				$has_purchased = false;
			}
		}

		return $has_purchased;
	}
}

$pmpro_user = new LP_PMPro_User_Hooks();
