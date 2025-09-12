<?php
/**
 * Create admin settings menu for the GTM Injector plugin
 *
 * @package uri-gtm-injector
 */


/**
 * Register settings
 */
function uri_gtm_injector_register_settings() {

	register_setting(
		'uri_gtm_injector',
		'uri_gtm_injector_id',
		'sanitize_text_field'
	);

	add_settings_section(
		'uri_gtm_injector_settings',
		__( 'GTM Injector Settings', 'uri' ),
		'uri_gtm_injector_settings_section',
		'uri_gtm_injector'
	);


	// register field
	add_settings_field(
		'uri_gtm_injector_id', // id: as of WP 4.6 this value is used only internally
		__( 'GTM ID', 'uri' ), // title
		'uri_gtm_injector_id_field', // callback
		'uri_gtm_injector', // page
		'uri_gtm_injector_settings', //section
		array( //args
			'label_for' => 'uri-gtm-injector-field-id',
			'class' => 'uri_gtm_injector_row',
		)
	);
}
add_action( 'admin_init', 'uri_gtm_injector_register_settings' );



/**
 * Callback for a settings section
 * @param arr $args has the following keys defined: title, id, callback.
 * @see add_settings_section()
 */
function uri_gtm_injector_settings_section( $args ) {
	$intro = 'A GTM injector for WordPress sites.';
	echo '<p id="' . esc_attr( $args['id'] ) . '">' . esc_html_e( $intro, 'uri' ) . '</p>';
}


/**
 * Add the settings page to the settings menu
 * @see https://developer.wordpress.org/reference/functions/add_submenu_page/
 */
function uri_gtm_injector_settings_page() {
	add_submenu_page(
		'settings.php',
		__( 'URI GTM Injector Settings', 'uri' ),
		__( 'URI GTM Injector', 'uri' ),
		'manage_network_options',
		'uri-gtm-injector-settings',
		'uri_gtm_injector_settings_page_html'
	);
}
add_action( 'network_admin_menu', 'uri_gtm_injector_settings_page' );



/**
 * callback to render the HTML of the settings page.
 * renders the HTML on the settings page
 */
function uri_gtm_injector_settings_page_html() {
	// check user capabilities
	// on web.uri, we have to leave this pretty loose
	// because web com doesn't have admin privileges.
	if ( ! current_user_can( 'manage_options' ) ) {
		echo '<div id="setting-message-denied" class="updated settings-error notice is-dismissible">
<p><strong>You do not have permission to save this form.</strong></p>
<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
		return;
	}
	?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<form action="edit.php?action=save_gtm" method="post">
				<?php
					// output security fields for the registered setting
					settings_fields( 'uri_gtm_injector' );
					// output setting sections and their fields
					do_settings_sections( 'uri_gtm_injector' );
					// output save settings button
					submit_button( 'Save Settings' );
				?>
			</form>
		</div>
	<?php
}


/**
 * Field callback
 * outputs the field
 * @see add_settings_field()
 */
function uri_gtm_injector_id_field( $args ) {
	// get the value of the setting we've registered with register_setting()
	$setting = get_site_option( 'uri_gtm_injector_id' );
	// output the field
	?>
		<input type="text" class="regular-text" aria-describedby="uri-gtm-injector-field-id" name="uri_gtm_injector_id" id="uri-gtm-injector-field-id" value="<?php print ($setting!==FALSE) ? esc_attr($setting) : ''; ?>">
		<p class="uri-gtm-injector-field-id">
			<?php
				esc_html_e( 'Provide the Google Tag Manager property ID (e.g. GTM-XXXXXX)', 'uri' );
			?>
		</p>
	<?php
}


/**
* Save the Settings
*/

add_action('network_admin_edit_save_gtm', 'uri_gtm_injector_save_options');
function uri_gtm_injector_save_options() {

	update_site_option( 'uri_gtm_injector_id', $_POST['uri_gtm_injector_id'] );

	wp_redirect( add_query_arg( array(
		'page' => 'uri-gtm-injector-settings',
		'updated' => true ), network_admin_url('settings.php')
	));
	exit;
}

/**
 * Add admin notice
 */

 add_action( 'network_admin_notices', 'uri_gtm_injector_custom_notices' );

function uri_gtm_injector_custom_notices(){

	if( isset($_GET['page']) && $_GET['page'] == 'uri-gtm-injector-settings' && isset( $_GET['updated'] )  ) {
		echo '<div id="message" class="updated notice is-dismissible"><p>Settings updated.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
	}

}
