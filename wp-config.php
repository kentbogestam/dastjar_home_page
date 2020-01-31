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

define( 'DB_NAME', 'dastjarhome' );



/** MySQL database username */

define( 'DB_USER', 'root' );



/** MySQL database password */

define( 'DB_PASSWORD', '' );



/** MySQL hostname */

define( 'DB_HOST', 'localhost' );



/** Database Charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8mb4' );



/** The Database Collate type. Don't change this if in doubt. */

define( 'DB_COLLATE', '' );

/** All Updates OFF **/

define( 'AUTOMATIC_UPDATER_DISABLED', true );


/**#@+

 * Authentication Unique Keys and Salts.

 *

 * Change these to different unique phrases!

 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}

 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.

 *

 * @since 2.6.0

 */

define( 'AUTH_KEY',         'Rf{!^Y/#Ut>N1SHo5vcL0d(Q1.sHh`t}1|UFLgKMs%V)b}DaS2uP% 7f}eOED`eb' );

define( 'SECURE_AUTH_KEY',  '#}>+DW|lU+e~f.@f>/:{}NzZBQM]yzR;6Oj[h1S.K@[c}E914vF(S)A7_|[ AS/W' );

define( 'LOGGED_IN_KEY',    '?g6`^;nXxUMQ}>.ZC&!~])Rd:*QlUs;:A03r0ucxm5:*TdR<YQ9v&lcG}n8nG/5a' );

define( 'NONCE_KEY',        'Rp(^&bK[t:ab lEXAvMU,DZi-vi]RG.hE}c;7VY.E}M>C(9r@;|q]wSBL3u~,J7O' );

define( 'AUTH_SALT',        '+L0d<C+U9WTrI#EirsQh69|dg2bw&(6AL]^VFHO=H,`I<V~1@9(x5YI(vK*!hyl+' );

define( 'SECURE_AUTH_SALT', 'jRC2OM!bE%n6o$CT5OA&9b_p`Xre{l=8#>g]QyvOetk(HV$F&TG*J0dQF0Rs@%)d' );

define( 'LOGGED_IN_SALT',   'M$;kK.9MGn6FMnd6|!>x6>M4zkO5L~$FS ]LL(;M3]<J}<H~(h0Bq#~a}kT4AyN&' );

define( 'NONCE_SALT',       'MGA6&yA)j3v!iFRez{ ?.@]xXbw+N2Ma=)K?U(:sF^}V;)0}MF_1wEdhF#u0,)i?' );



/**#@-*/



/**

 * WordPress Database Table prefix.

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

 * visit the Codex.

 *

 * @link https://codex.wordpress.org/Debugging_in_WordPress

 */

define( 'WP_DEBUG', false );



/* That's all, stop editing! Happy publishing. */



/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

}



/** Sets up WordPress vars and included files. */

require_once( ABSPATH . 'wp-settings.php' );

