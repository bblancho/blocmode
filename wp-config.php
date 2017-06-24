<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'dressingbu2210');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'bEdAlnY1}xdLWu02ARM;Fh_ gzn8 hfKO$8/is}iq-NBF;~4Uuu<#V[z`gMz8B&]');
define('SECURE_AUTH_KEY',  'wlQnv^)R5QOAWgo< ;@zN@O$08`qUSE,Q|K]>JTKB#|h4NJ}i]*U}>gN0oZ{2b-T');
define('LOGGED_IN_KEY',    'Vyc2~|{A+!N;p6e#5Am#Psr$/y+cy4e?7>O^EnenoE*(&#sHfqU5/md)wF/vJZ2=');
define('NONCE_KEY',        'C ?(C=Z;N-A{1}nj=py{G+B|A9$Rp$F>XdwU0RJ,2tc--%Z[ff<~i.FDCcD9J$_,');
define('AUTH_SALT',        'L]r5[9xr*/n}=@~A@(sQHM<zpA{4YBKeAF=*#8;Yb}Se0Sy.ap?J+.y_ 8W<g%wI');
define('SECURE_AUTH_SALT', 'L?X@W|^ 7f]9Gk*Ap4x54($LfOn,k>I~n7n[8vNN/~ZA4,snJj>.ea>jI]f%rxDD');
define('LOGGED_IN_SALT',   'c]!yvjlfzpYR >L=WSVA!YBHZXhy-N>&_p&Va`8YZ#o):=)@UU8gByCrf:~; 2l6');
define('NONCE_SALT',       'wBl+Pt[1|Jcd~|Q.CY|I2/A%x{B%]{&]%#S&tg9-Z%1X&%L5;Y*sa &K?;.r(o:(');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wor3390_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');