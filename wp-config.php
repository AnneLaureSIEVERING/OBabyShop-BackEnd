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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'obabyshop');
/** MySQL database username */
define('DB_USER', 'obabyshop');
/** MySQL database password */
define('DB_PASSWORD', 'obabyshop');
/** MySQL hostname */
define('DB_HOST', 'ec2-54-167-89-221.compute-1.amazonaws.com');
/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');
/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'o>t`YkQ6LZDMK`=cI{7uP(kU35(^Rkb+A.TVN$|gJdy(}Ay/Vv=lEwE/;!< !6~{');
define('SECURE_AUTH_KEY',  '69bfaD,kpR5I|ou1!*p!o<7*pZN*CiKR NlI+-nUPAfJ+U:<B6?Ik$ 3 (K;f8mr');
define('LOGGED_IN_KEY',    'b-`oO;C=s$b>#gx8:;^b+cFnH|s0U_v>zD`;|7I^l6K?/McU1#IIuIOGsyz9.=S_');
define('NONCE_KEY',        'Tes|U0.|_+@!0kG#T<FPTr*/DlI2J{0nacJ>KHGOFKe1bE;ssd>T!.$:)o1jl8H=');
define('AUTH_SALT',        'Uuej[;6RuayP-9q#0[Llp~n]w/+Bi]mahFPzNSzwY)KpF}W+}4wT@zcXJ2%z6_}<');
define('SECURE_AUTH_SALT', 'G)ZC~4$N<}fe>fLXUVQ&DZGjYnAU5!EdOO{_uc}&U=k)OeK&$|K$|!]R=*5sZg>S');
define('LOGGED_IN_SALT',   'xQl a3[ysZjV(=>W|3Csf>KLTeK[D|+|+6~O3(F2rH|0dV>}wk[?<b2g)f4Kt+ma');
define('NONCE_SALT',       '#knxz>6Nd:0c6$bao^6%!` iXuaNmJfMMmL)E-0}|<|XQ!qZ%OL%^-?zKN_TCHAj');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';
define('FS_METHOD', 'direct');

define(
    'WP_HOME',
    rtrim('http://localhost/Apotheose/Back-End/projet-vente-materiel-puericulture', '/')
);

define(
    'WP_SITEURL',
    WP_HOME . '/wp'
);


define(
    'WP_CONTENT_URL',
    WP_HOME . '/wp-content'
);


define(
    'WP_CONTENT_DIR',
    __DIR__ . '/wp-content'
);




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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
