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
define('DB_NAME', 'drugsandalcoholassesment');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'sbr@2018');

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
define('AUTH_KEY',         'dxVZk~w/bacI|O/}@S.Jpun$BVv~=A=Q_I@IA9~L.uUTX;Y#)nkZu@+<(0t-^[.2');
define('SECURE_AUTH_KEY',  'W?m/rpy$}T;X42f@m4U);h9b(B0a`!.Qi+*(@?YIK5u+A4ek f&s^sbNXXjV]qdi');
define('LOGGED_IN_KEY',    'PtlmqNhF3nn~qy?>#CwNlo?28,%?oEi}yXj|TP<I27.u<LUzn`]5g:#x&2P=S+Oj');
define('NONCE_KEY',        '^?RM>C(G<Z&D;0Cl$%XFv3TsCe18N7O{Z:bG]xdf32[]gC1DH3^A82]E`-R:6t#V');
define('AUTH_SALT',        'jmD2?R,U45?lp[U?p%:l3!7Z~Qa1?$xUV}&xFCQhTf:lF#os]:qlzs-5Kg$05psF');
define('SECURE_AUTH_SALT', '><#C0FF>mLqm2i%]j4BD78iZf!T{N[nyQDjj`fIEQ2CwT;eo2QS0`VfE;G=.peu!');
define('LOGGED_IN_SALT',   'DR>%Ss@Qur`>AcNv) /1W5;Z,k!=k4J`>tXE=((tci3:^K=*pW%@W;we3NPT:.*7');
define('NONCE_SALT',       '_cujBGoRW##XM^WoF^-,q|F,;}=OqY2vAaYhNqF)o?Kf1O09|AL{b[z(~;Fu?}4)');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'drg_';

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
