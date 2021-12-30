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
define( 'DB_NAME', 'wppratical' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'FXDi]lhBPdFKnxKq3E^+H9o)eb``(!J%AJ^)VB(1b|0%qfXa~#;ZfPx^=X(I}L0U' );
define( 'SECURE_AUTH_KEY',  'CptO5@B^Mq]X_+kz8s*Mj8ImVSm`,8pbB9ymW%IsER7?MfuZ&dHq@R+j</?dM42.' );
define( 'LOGGED_IN_KEY',    '@bcBra$f=}%~5/H><Vo6+t?X{c0;V9T(KptV<;bk#u0G69O9m_#&3 V/Ug#s{gA?' );
define( 'NONCE_KEY',        '@UpExUjjW%T=I3.EoDE9(z`&u]RpXIns%:-ZjLFrZA:Vt0%5NX:W|fb5t_DWHe!K' );
define( 'AUTH_SALT',        'l+lafofxuEs>@86akAZ@|]6i=#VZAlqI;yQ=Jt-,HA)o-{!yu&&ZFb@--adia=A7' );
define( 'SECURE_AUTH_SALT', '8p]`_9Hda?9s} 0YRmFe_z1Om(%|ozbwo:W9jsFfY11=s~-,ds@*BH 5KI;-FYxy' );
define( 'LOGGED_IN_SALT',   'I?-#{:ut`S>~;lDVfor@>dRZ]Sdi`O#:C0B$R5ae_5gS=#lN>(WW}BNsNC]sslN@' );
define( 'NONCE_SALT',       '=TDa*ae^c~5hFMLmu Er2VB9lz2q5mef }<7[:6jJ~F|g~]mJ9T8&tex#UfY}|nx' );

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
