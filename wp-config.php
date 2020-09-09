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
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'x.(3c}unDW.<bMl#.bzE[xp`-Tx^9^D=c6hDtJv@K<,~J#sc?~=hWH0>![AC3c~;');
define('SECURE_AUTH_KEY',  '!#qnDDo=xga4 -~W(UC6e<9u> Dgq$#b!>[ok}2 iDGNv{4-U2gi[sj{1M|X+^*:');
define('LOGGED_IN_KEY',    'SgaTo78Qelmk$SfDwtaAqd-[q<7H:yj&3VFr&!S<(YtpNTez0oCC=U*F2Ss+yp,+');
define('NONCE_KEY',        'pv7-VK+#=?3q:9X2}Yan!DGmoCrWIoy[BMF_j:{^-yznY*#$*jv[)}2Si6IJph|M');
define('AUTH_SALT',        'H$bu[wpoiY_WW81Ecs#p(Axn;qivZ!1D$}]iih`V6i: (hOQAld+;l;m=St|d&R+');
define('SECURE_AUTH_SALT', '^(RPKo+52V@K.*$S9|S_owdhv/ f]uX;21PS^guMtg5_xKey)c16VL|<-;rz4t(|');
define('LOGGED_IN_SALT',   '1Hg;&_ZoEn|<y+7%ftm<QG7;3EAd=nK7Np/ /IP{ W%nX~[-M1fEZN.#4VSI#=q4');
define('NONCE_SALT',       '9Jtaj4 F?([)n4s-;IyrF!)9V]xH&cspH<$t[3U h[y!RE+>_A8+%2;0ejfo8y8.');

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
    rtrim('http://localhost/OBABYSHOP/projet-vente-materiel-puericulture', '/')
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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
