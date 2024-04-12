<?php



/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u489122148_KdXcg' );

/** Database username */
define( 'DB_USER', 'u489122148_ch5NF' );

/** Database password */
define( 'DB_PASSWORD', '8MQZim0zWj' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '_cuA58gipJM?p: X!p90r3OmoZilab[a<T`8:b{X3O:1awiwwKM#w$}CCr@:H_!+' );
define( 'SECURE_AUTH_KEY',   'IwoG2l$A`PPatJ`{s7~?vM7/c0s4v&`h>>77lbymY<N(skdBSV&V5<^k_5I:Bj6@' );
define( 'LOGGED_IN_KEY',     '+[b=&>:Tkb;_1w/)65S%{Mu>{z}AYBo5WLr@N%CbREQQv(9gCTI[O-Kw7Lbx19E4' );
define( 'NONCE_KEY',         'HaSbKdz5T9t,0>[G*<]UKTUDqLU=>ej5#I.]6w8DGY!<pXnBkVt1DMWNPEjwH~wU' );
define( 'AUTH_SALT',         '^)*7S}&&IqUZ7J.Ubrs=,;,@2A$Vt-~}.GSK:3#e` (D+~LH<DAMACB-NPPvbiR>' );
define( 'SECURE_AUTH_SALT',  '(`~c>S KjL!atTC0*bPT3~|#T!yN4b1FE8iYZg_LIaLm.ArFgTSO Y,`v^bFD+z2' );
define( 'LOGGED_IN_SALT',    'L3!wP6GbovSQ x[&1c,.H2ayfbrj%,%czMkZ_@<sVU7g9/wUT%Yhi`tC|:/O5Xba' );
define( 'NONCE_SALT',        'cfVg;cKZ=_V`UnbG|kw3[NYl&hHMye!c+{%M<lPiJYGV~~D>KG=BFMYvJLtC{].R' );
define( 'WP_CACHE_KEY_SALT', 'fFY,RDE0 /s+Sbv4B)i:4FA`f FIH^?FiXFklUCuD2jhD^kj~m6)cSj! P*}PP!@' );


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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */



define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
