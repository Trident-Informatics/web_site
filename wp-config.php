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
define( 'DB_NAME', 'tridentInformatics' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'dqqCAlpt-_H: aZ%&Z4133~r-<CLU@*^.PnE7;lQYxmZJ^*#0-i+3BR2Pxr_g5se' );
define( 'SECURE_AUTH_KEY',  'J^w( xOf{HdmuIQ$=_ X %YnW(qQoP448Hm.u;g(4po i]X]`l?4~9)11+Sp,#5T' );
define( 'LOGGED_IN_KEY',    '_}]s|e+f#kNm{Y0 `5q%d1uaAz,L!HSqpK9uQrLoKqI`C^W,Uj>/LH+GnoYV}H7.' );
define( 'NONCE_KEY',        'M1*Wq~`Iy._U$UraM.aqI#AH+q~jG7`:E;h-!WQV..c6JR~iT<+*5C~eiIwNt(k=' );
define( 'AUTH_SALT',        'cMZn`3 ^wcLT6~xIOuJ3{VOmHVA Cj$m;zB+p%Yd5;mrj}eJPIo1^/Yd~4Av//@U' );
define( 'SECURE_AUTH_SALT', 'STgdKovCi(4==pRS+UWI,g^hjfWac}(6DFj4?!mBpn&66ef|?b`ICJ(v/EDqLg^L' );
define( 'LOGGED_IN_SALT',   '@O(Xf6rvCc22.!TE#YEc8INB5nL_,2A~M7!Q j_eu*Qu)f}pD`5;&**?C</^5xk)' );
define( 'NONCE_SALT',       'B&3-=n_h8G!1CXHy Y3+*CsWWq(lfG:YH`A|vP*o[8U)i@[_lRg4_f1j{=)$K~H#' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
