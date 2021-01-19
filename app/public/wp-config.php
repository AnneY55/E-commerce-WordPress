<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'c/0/Z5ehj1aoJdbLEvk9wYUUfnc61Fk+qw1MRn6vcnRIgZL2wA15vnTe3hkKbYIfRSu32W0l7M5OEXH7SAX7NA==');
define('SECURE_AUTH_KEY',  'bColPEfdXTc54lsTohaLp/w39LVjfr8qq7daBHWPC6SGRK1qH0bIodrkxMV+o6y9zprALC4NU2vq/T36bkNARw==');
define('LOGGED_IN_KEY',    'CwUbJGIW/vD+8gsHkODwqhk2x45iLfh7hTSv7WPCUXGGGysr95LjnHc6X0vLwHTG8/iAdxfs5PFQUx/rDh3TNA==');
define('NONCE_KEY',        'Bjoo91P5oHTMcJyBxHoDfejJeGZiRiLmCzX04hPIvzEKVhYDyNQeNcQPvgHDPHXZjv63eUYKo456QYGnHJLf9A==');
define('AUTH_SALT',        'LdWo1RCyHFbpZR4mcMc1cYqdw198+UupU49jIuB6rvRZ0QQc0/lhrq37zc/oI3FU+dfr2+P/YXUGGr3/n6Bs8A==');
define('SECURE_AUTH_SALT', 'WuTPwVjtACA6JNpX7aIacLLoabq+k0qHzB3NmYi/1vsjHrGeDD45qsm5na+NOCSQSipahXQn0HtJvxszb6Z6pg==');
define('LOGGED_IN_SALT',   'BSvtLEPWN41zBHPHrGTopqIbVE7iVIwkoypGw+h/2kE1zkr1BWhlBIpERkQZzBnkBm7mqL0WXhTLaaf4qz5aQw==');
define('NONCE_SALT',       'Ipt6mBq3yd5/7uaB6CGAsgWBQcS2YimfqyCQ+Y/BGkom5LHGhq6bVqSorIm4OVwbsvDdbXszNmMTLmGY59rPIg==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
