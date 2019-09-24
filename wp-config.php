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
define( 'AUTH_KEY',         '~.{q7C[<tSkjNQPVyxpS_oa,2aP[#b`sjT+CAd:|-ryj^A*9]-:Bl6{D&(1Xo[.e' );
define( 'SECURE_AUTH_KEY',  'TX%rmYoiBQP&vv]<-Av3m:BP@p@umc#4dlCS-tR/&s0OgA_yTN-#i`m do3|0@&-' );
define( 'LOGGED_IN_KEY',    'T!}W:~tNQ[K`D-<r<J^~eUjz~`Lr#NXlW8_!i_$-RZB`45DDPtUZXy(0xSTR;y1i' );
define( 'NONCE_KEY',        'R&Y0g1Mry|P{G#>k];34irFLQcyFUUx{;&+[YUmQn3#)1y9=?@CsB>`w&0EK+?9-' );
define( 'AUTH_SALT',        'g T D1~ydejA|RP3]8EC,1oj!%|7X7B;5So$>;4u(kc;6&9H/1lWDY[$!t)tyFFo' );
define( 'SECURE_AUTH_SALT', 'os;O?bWW4c2 ;)7*<g;~2y>mEWRk45L<>i%toi9*sH+M9- HXb-*J1V@j`CT}pxP' );
define( 'LOGGED_IN_SALT',   '*W4!K&RX?; XNKo1-bv`9o~Q6W@vF/aAP$HkMM3)pA^nE?fex/r->H&1U8*_U?7e' );
define( 'NONCE_SALT',       '$h4/<S.|Qa(0+G(XDXlO=?C!gs{8@<lK`QsE`0d4t$|ex9/5S,$A4NU3|}/Ps65B' );

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
