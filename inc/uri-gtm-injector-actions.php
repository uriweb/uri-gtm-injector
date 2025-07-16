<?php
/**
 * Include the actions for the GTM Injector plugin
 *
 * @package uri-gtm-injector
 */


/**
 * Add the Google Tag Manager code to <head>
 */
function uri_gtm_injector() {
	$gtm = get_site_option( 'uri_gtm_injector_id' );
	if ( ! empty( $gtm ) ) :
	?>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?php echo $gtm; ?>');</script>
	<?php
	endif;
}
add_action( 'wp_head', 'uri_gtm_injector' );

/**
 * Add the GTM noscript to <body>
 */
function uri_gtm_injector_noscript() {
	$gtm = get_site_option( 'uri_gtm_injector_id' );
	if ( ! empty( $gtm ) ) {
		echo '<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=' . $gtm . '" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>';
	}
}
add_action( 'wp_body_open', 'uri_gtm_injector_noscript' );