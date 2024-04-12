<?php
/*
Plugin Name: Unical WhatsApp Notification
Description: Integrates WhatsApp Business API with Forminator forms.
Author: Unicalsystems
*/

function enqueue_whatsapp_api_scripts() {

    // Define form and page identifiers dynamically for better maintainability
    $form_identifier = 'resume-assessment'; // Replace with actual Forminator form slug
    $page_identifier = 'interview-assistance'; // Replace with actual "raj" page slug
    $user_identifier = 'if-you-are-an-employer-post-your-requirements-here'; // Replace with actual Forminator form slug
    $contact_identifier = 'contact'; // Replace with actual "raj" page slug

    // Enqueue script for Forminator form
     if ( is_page( $user_identifier ) ) {
            wp_enqueue_script( 'whatsapp-api-script-' . $user_identifier, plugin_dir_url( __FILE__ ) . 'whatsapp-api-script.js', array( 'jquery' ), null, true );
        }

    if ( is_page( $form_identifier ) ) {
            wp_enqueue_script( 'whatsapp-api-script-' . $form_identifier, plugin_dir_url( __FILE__ ) . 'resume-whatsapp-api-script.js', array( 'jquery' ), null, true );
        }
    
        // Enqueue script for Forminator form
    if ( is_page( $contact_identifier ) ) {
            wp_enqueue_script( 'whatsapp-api-script-' . $contact_identifier, plugin_dir_url( __FILE__ ) . 'contact-whatsapp-api-script.js', array( 'jquery' ), null, true );
        }
    
        // Enqueue script for "raj" page
          // Enqueue script for Forminator form
    if ( is_page( $page_identifier ) ) {
            wp_enqueue_script( 'whatsapp-api-script-' . $page_identifier, plugin_dir_url( __FILE__ ) . 'interview-whatsapp-api-script.js', array( 'jquery' ), null, true );
        }
}
add_action( 'wp_enqueue_scripts', 'enqueue_whatsapp_api_scripts' );