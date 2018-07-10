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
define('DB_NAME', 'doc_corner');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
global $h;
$h=array();

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'rU?wyQ15W@{(/)[8y<1<mt9+A+i58Pd:hw7FFCt&&nltO|T8%(*1^szS*.<d>Y+$');
define('SECURE_AUTH_KEY',  'C >plc#+KYcw5{9UDDId3~`GdD6=O(eVwj}Q6RP(id!xzL-A^wR=#k!-[O_F<Z ~');
define('LOGGED_IN_KEY',    '}%Mo048|qt}QIz_^z_dQs +fgFu21DT;Ib89(P}<1*j1f1i6A@`l8h`Y9G8V?d>i');
define('NONCE_KEY',        '4UutuvtPP,wYR]Rv)fnw`>dcO:C2:t>L8<|XUh`(OtAd#iVW;]gU?P+AermHeW#S');
define('AUTH_SALT',        '6%Gvue4e[kW9hO{~RvP#lU^ECMAZB()(mjk/pwk?lkG {nk N}r3qF:.FS8y`Bf^');
define('SECURE_AUTH_SALT', '(VpuL|,MvO x#OH108I0&=~wBf]G|j^U?W]f+rx*.k-5eYQ|~~V:Y!;BSPDA|M:K');
define('LOGGED_IN_SALT',   '=DM_nJ}MhlZtIsl$*nt`JjiUx7@+B7#VObxbNX4;%>vEhN`yzReI`j*GTxtoM.c<');
define('NONCE_SALT',       'Z{!8D,*0-J*T#]VjFPC`iSzr#c@5ihm|NGFcfS*G%a/TZ=?_sKE#m<#$m3=KYtr5');

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
// ini_set('log_errors','On');

// ini_set('display_errors','Off');

// ini_set('error_reporting', E_ALL );

// define('WP_DEBUG', false);

// define('WP_DEBUG_LOG', true);

// define('WP_DEBUG_DISPLAY', false);

define( 'FS_METHOD', 'direct' );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
