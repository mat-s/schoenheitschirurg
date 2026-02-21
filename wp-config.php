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
define('DB_NAME', 'wordpress');
define('DB_USER', 'wordpress');
define('DB_PASSWORD', 'wordpress123');
define('DB_HOST', 'db');

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
define('AUTH_KEY',         '|27 a{d.F~st-]u,hT2&h3ej|EvIHK!=U68u{=f[N]AQ-(lT;jfsr_>/J!J}O#v`');
define('SECURE_AUTH_KEY',  ';.ue0S 48+y;2tP$-pjnU9qLm9P+RJDT-,8/P.iwEb)l1e>_F-mu-f1E~UPj}e*t');
define('LOGGED_IN_KEY',    ':$gj4&SvasPn1zEx=J~x%w)sO`vDHbp+mM9O 9ag|+3Tr[:8yUd,+X_6iIi(D!|M');
define('NONCE_KEY',        'x@4(6}br8>,<&8PC4oGOn{ `xHa,D]<ngm:j&2PCLxcjl z 4P<%.Qsymv[x@aJ?');
define('AUTH_SALT',        '..90s6^Gl*$5}cbmdXGCR/:=sL*gKW9=vhG8pmVb;/+0aN}7_)%|l}ahUoHox1r[');
define('SECURE_AUTH_SALT', '[%Kg~Iz675GUPdCB=JeCRs&xqBtW0(c2s*0.vqK}2Cl{F~y.,03oN6`#<3qQIA)%');
define('LOGGED_IN_SALT',   'I|-lr(4a~B)`qr].=l(xYO0CP.,|O}K+=o4+A88ClTzts-Tb4(aaM6ec(?.=:-y^');
define('NONCE_SALT',       'F^9LQf_||fw}&j^fye`Yk2-A|2zFv3iOT+~o6l9_IjMpk)4^7UYTG|cQ_+p|C)NS');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'j3a12_';

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
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
  define('ABSPATH', __DIR__ . '/wp/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
