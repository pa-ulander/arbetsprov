<?php
/**
 * Autoprependfile - contains the lowlevel stuff
 *
 * @author PA Ulander, pa@kabelkultur.se
 * @since August 2010
 * @package arbetsprov
 */

/**
 * error reporting
 */
#error_reporting(E_ALL);
ini_set ( 'display_errors', 0 );
ini_set ( "log_errors", 1 );

/**
 * paths and constants
 */
define ( 'CONFIG_INI_PATH', dirname ( __FILE__ ) . '/config/config.ini' );
define ( 'LIBRARY_PATH', dirname ( __FILE__ ) . '/lib/' );
define ( 'APPLICATION_PATH', dirname ( __FILE__ ) . '/' );
define ( 'CONTROLLER_PATH', dirname ( __FILE__ ) . '/controllers/' );
define ( 'VIEW_PATH', dirname ( __FILE__ ) . '/view/' );
define ( 'SITE_PATH', realpath ( dirname ( __FILE__ ) ) );
define ( 'VIEW_EXT', '.phtml' );
define ( 'SLASH', '/' );

/**
 * generic include path
 */
set_include_path ( ini_get ( 'include_path' ) . PATH_SEPARATOR . LIBRARY_PATH . PATH_SEPARATOR . APPLICATION_PATH );

spl_autoload_register ( function ($p_sClassName) {
	$sClass = ltrim ( $p_sClassName, "\\" );
	preg_match ( '/^(.+)?([^\\\\]+)$/U', $sClass, $aMatch );
    $sClass = str_replace("\\", "/", $aMatch[1])
        . str_replace(array("\\", "_"), "/", $aMatch[2])
        .
	".php";
	include_once $sClass;
} );

/**
 * core
 */
include_once ('debug.php');
include_once ('Config.php');
require_once ('Template.php');
include_once ('Registry.php');
require_once ('Router.php');

/**
 * application
 */
include_once ('db.php');
include_once ('Util.php');
include_once ('xmlUtil.php');
include_once ('models/program.php');

/**
 * required base controller
 */
require_once (CONTROLLER_PATH . 'controllerBase.php');

/**
 * lowlevel file involved in rendering various displays
 */
require_once ('pageFragments/pageFragmentBase.php');

/**
 * default registry objects
 */
if (! Registry::isRegistered ( 'oRouter' )) {
	Registry::set ( 'oRouter', new Router () );
}
if (! Registry::isRegistered ( 'oTemplate' )) {
	Registry::set ( 'oTemplate', new Template () );
}

?>