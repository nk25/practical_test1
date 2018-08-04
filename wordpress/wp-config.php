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
define('DB_NAME', 'practical_test');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         ':jsWz{j7]bgj-4a)<sXZw!6k6B }d,uUA><WZS>Cr/Z^-q(-`}8(D.h>DG#byq}f');
define('SECURE_AUTH_KEY',  'i5W.-;Wp|bTnCfmLeo kTQ9wP^?St-09l^eSU!Jili}2Rk(L~Rm[Clt~xy9C]B:g');
define('LOGGED_IN_KEY',    'y#0,;7t?1Kk5H1~PBJFfU*_U#.MyPTgB#$SgYBtKE7ulC_v*E>F}{B;p)=!Lw}Dp');
define('NONCE_KEY',        '6s2I:#W&rQKFt5LE%jsKN82Ps/u**1@7lI.eX?*Qza>zlQ{r2/IY,&B{`m(_S]~;');
define('AUTH_SALT',        '=#+bZ|Sf.CKQP#0_Hrv`s]ODi?mECF/8l(ptG0u)C=4db YpEiUH@!j!sufV-.m_');
define('SECURE_AUTH_SALT', 'ayd@!:UI$~JjfwuVeOj8>t,3 9ii`dIpUp!cf$0RX!{O(l,zrv[@D#eo<Jc:]=Gk');
define('LOGGED_IN_SALT',   '>dd`wWQ7yPYYt4USX1sFe@1&wcw3=3<rl#Z?oE@j6t@~F4^L*Id.^O {uNAbww>_');
define('NONCE_SALT',       'I3BY^Oy3V3=oy s@F412v8ku4FXA@_2&?Uh )5K&tZW)?jXW %/Fvxy*NMRF#iGg');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
