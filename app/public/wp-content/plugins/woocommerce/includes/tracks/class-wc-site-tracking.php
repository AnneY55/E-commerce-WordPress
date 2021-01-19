<?php
/**
 * Nosara Tracks for WooCommerce
 *
 * @package WooCommerce\Tracks
 */

defined( 'ABSPATH' ) || exit;

/**
 * This class adds actions to track usage of WooCommerce.
 */
class WC_Site_Tracking {
	/**
	 * Check if tracking is enabled.
	 *
	 * @return bool
	 */
	public static function is_tracking_enabled() {
		/**
		 * Don't track users if a filter has been applied to turn it off.
		 * `woocommerce_apply_tracking` will be deprecated. Please use
		 * `woocommerce_apply_user_tracking` instead.
		 */
		if ( ! apply_filters( 'woocommerce_apply_user_tracking', true ) || ! apply_filters( 'woocommerce_apply_tracking', true ) ) {
			return false;
		}

		// Check if tracking is actively being opted into.
		$is_obw_opting_in = isset( $_POST['wc_tracker_checkbox'] ) && 'yes' === sanitize_text_field( $_POST['wc_tracker_checkbox'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.ValidatedSanitizedInput

		/**
		 * Don't track users who haven't opted-in to tracking or aren't in
		 * the process of opting-in.
		 */
		if ( 'yes' !== get_option( 'woocommerce_allow_tracking' ) && ! $is_obw_opting_in ) {
			return false;
		}

		if ( ! class_exists( 'WC_Tracks' ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Register scripts required to record events from javascript.
	 */
	public static function register_scripts() {
		wp_register_script( 'woo-tracks', 'https://stats.wp.com/w.js', array( 'wp-hooks' ), gmdate( 'YW' ), false );
	}

	/**
	 * Add scripts required to record events from javascript.
	 */
	public static function enqueue_scripts() {
		wp_enqueue_script( 'woo-tracks' );
	}

	/**
	 * Adds the tracking function to the admin footer.
	 */
	public static function add_tracking_function() {
		?>
		<!-- WooCommerce Tracks -->
		<script type="text/javascript">
			window.wcTracks = window.wcTracks || {};
			window.wcTracks.isEnabled = <?php echo self::is_tracking_enabled() ? 'true' : 'false'; ?>;
			window.wcTracks.recordEvent = function( name, properties ) {
				if ( ! window.wcTracks.isEnabled ) {
					return;
				}

				var eventName = '<?php echo esc_attr( WC_Tracks::PREFIX ); ?>' + name;
				var eventProperties = properties || {};
				eventProperties.url = '<?php echo esc_html( home_url() ); ?>'
				eventProperties.products_count = '<?php echo intval( WC_Tracks::get_products_count() ); ?>';
				if ( window.wp && window.wp.hooks && window.wp.hooks.applyFilters ) {
					eventProperties = window.wp.hooks.applyFilters( 'woocommerce_tracks_client_event_properties', eventProperties, eventName );
					delete( eventProperties._ui );
					delete( eventProperties._ut );
				}
				window._tkq = window._tkq || [];
				window._tkq.push( [ 'recordEvent', eventName, eventProperties ] );
			}
		</script>
		<?php
	}

	/**
	 * Adds a function to load tracking scripts and enable them client-side on the fly.
	 * Note that this function does not update `woocommerce_allow_tracking` in the database
	 * and will not persist enabled tracking across page loads.
	 */
	public static function add_enable_tracking_function() {
		global $wp_scripts;

		if ( ! isset( $wp_scripts->registered['woo-tracks'] ) ) {
			return;
		}

		$woo_tracks_script = $wp_scripts->registered['woo-tracks']->src;

		?>
		<script type="text/javascript">
			window.wcTracks.enable = function( callback = null ) {
				window.wcTracks.isEnabled = true;

				var scriptUrl = '<?php echo esc_url( $woo_tracks_script ); ?>';
				var existingScript = document.querySelector( `script[src="${ scriptUrl }"]` );
				if ( existingScript ) {
					return;
				}

				var script = document.createElement('script');
				script.src = scriptUrl;
				document.body.append(script);

				// Callback after scripts have loaded.
				script.onload = function() {
					if ( 'function' === typeof callback ) {
						callback( true );
					}
				}

				// Callback triggered if the script fails to load.
				script.onerror = function() {
					if ( 'function' === typeof callback ) {
						callback( false );
					}
				}
			}
		</script>
		<?php
	}

	/**
	 * Init tracking.
	 */
	public static function init() {

		// Define window.wcTracks.recordEvent in case it is enabled client-side.
		self::register_scripts();
		add_filter( 'admin_footer', array( __CLASS__, 'add_tracking_function' ), 24 );

		if ( ! self::is_tracking_enabled() ) {
			add_filter( 'admin_footer', array( __CLASS__, 'add_enable_tracking_function' ), 24 );
			return;
		}

		self::enqueue_scripts();

		include_once WC_ABSPATH . 'includes/tracks/events/class-wc-admin-setup-wizard-tracking.php';
		include_once WC_ABSPATH . 'includes/tracks/events/class-wc-extensions-tracking.php';
		include_once WC_ABSPATH . 'includes/tracks/events/class-wc-importer-tracking.php';
		include_once WC_ABSPATH . 'includes/tracks/events/class-wc-products-tracking.php';
		include_once WC_ABSPATH . 'includes/tracks/events/class-wc-orders-tracking.php';
		include_once WC_ABSPATH . 'includes/tracks/events/class-wc-settings-tracking.php';
		include_once WC_ABSPATH . 'includes/tracks/events/class-wc-status-tracking.php';
		include_once WC_ABSPATH . 'includes/tracks/events/class-wc-coupons-tracking.php';
		include_once WC_ABSPATH . 'includes/tracks/events/class-wc-order-tracking.php';
		include_once WC_ABSPATH . 'includes/tracks/events/class-wc-coupon-tracking.php';

		$tracking_classes = array(
			'WC_Extensions_Tracking',
			'WC_Importer_Tracking',
			'WC_Products_Tracking',
			'WC_Orders_Tracking',
			'WC_Settings_Tracking',
			'WC_Status_Tracking',
			'WC_Coupons_Tracking',
			'WC_Order_Tracking',
			'WC_Coupon_Tracking',
		);

		foreach ( $tracking_classes as $tracking_class ) {
			$tracker_instance    = new $tracking_class();
			$tracker_init_method = array( $tracker_instance, 'init' );

			if ( is_callable( $tracker_init_method ) ) {
				call_user_func( $tracker_init_method );
			}
		}
	}
}
