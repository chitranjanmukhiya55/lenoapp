<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'project' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'v8 l8S?z_> #=_eRD*zXD#/^Ow;dPinHZ8cY|A8It6nxy(y>+9raGC*,r)~Zkefd' );
define( 'SECURE_AUTH_KEY',  '#YY0O I72?~!.8T6V3g6zj^cK.enxlEUu@TR/H_4%]K)g_Yh=+$272X)EPBrR)fJ' );
define( 'LOGGED_IN_KEY',    'kF`48C3AT%YRaS^ ]Qg} !TI]!&v&Dg?kYnp(akg;iwz~.[L2G0(6VJ=]xbUO@GG' );
define( 'NONCE_KEY',        '@_8Z5,WgNY*N?s*<_q{<o^{08; Wh>2+fPgj ?DT8;_|(fvl &s>sdw=1 26*O]v' );
define( 'AUTH_SALT',        'O)@kbih+XP]cR<=b;d:!h9(yN7X8#iE_*R>D)Yj9bF}o6KdpM:k[r@f`nU<T,RRx' );
define( 'SECURE_AUTH_SALT', '}#uh!NCVJbo!-dHq`A:4[el~=?qFT|THG2y*M h1oK[j(R2Iyf{){$(-eFl[)a~O' );
define( 'LOGGED_IN_SALT',   'v[<MA*A?z!?DLS}v:VV3Y# X8?+CP<|n809dBY[bBea@C=x&AIa7Ez5YfjW#n#!5' );
define( 'NONCE_SALT',       ';G77l`+w[A(ANmwd$PYULk/KU?=YFBWvX;.A-]/6lq.lz+5^%`s}6V8TM^V)J!Xt' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
