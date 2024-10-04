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
define('DB_NAME', 'phvideo');

/** MySQL database username */
//define('DB_USER', 'root');//original
define('DB_USER', 'learningZone');

/** MySQL database password */
//define('DB_PASSWORD', '');//original
define('DB_PASSWORD', 'LearnPHstore.72');

/** MySQL hostname */
define('DB_HOST', 'localhost');
//define('DB_HOST', '172.30.0.13');

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
define('AUTH_KEY',         '$q#SP!S`Jth~C>U+GGfI0j./!s?Sl5]o=](Z6mdeaky-&qAw1s;W4&}5rbWm3b,-');
define('SECURE_AUTH_KEY',  'S0rWHP*%H5OL,/sJw(Up~h)6;CKyJ{Jig*o0VR![Y]^I}`e~O+3[d=vW%WBaMEu#');
define('LOGGED_IN_KEY',    '>JGGAY+2VHpO|Bbn?!iv|5z0V&5tfhOuUAOv1^BL ukqe|hzT:i/GrYN!cZK??y,');
define('NONCE_KEY',        '|^q]tZ1<PKjwEeSW=<7B@OoG!F><9 m=7PCEkbXc%RtA;?>?V%?eK||t9EA,k}<r');
define('AUTH_SALT',        'aVb}x)qcjN17/<sCkLDD=lg~TAYJA2|9m,&{=!RKIA_:raS(fUN~&V_6{.>rq<MJ');
define('SECURE_AUTH_SALT', ')O}C~9P(?i;X5VWRytu[B-g0qz*FG}NNulEKz>?ym^*I)4p{:x_0xb?nLR-xbdK>');
define('LOGGED_IN_SALT',   'EKN0`{n62(a#li=y=X W^9@KaW=F|gDGJedNAc,=H]C*zx^uIHJ+A<Fj6FJ-m0kJ');
define('NONCE_SALT',       'MUw:b6-GB&e}$Yh7c.:f=SBV|C&N,:|FG1W~<DOiD-U>o ){QeJqt/S>PI6bY13<');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'phV_';

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
