<?php
/**
 * Simple not so fancy router class
 *
 * @author PA Ulander, pa@kabelkultur.se
 * @since Aug 2010
 * @package arbetsprov
 */
class Router {

	/**
	 * Holds passed parameters
	 *
	 * @var array
	 */
	private $aParams = array();

	/**
	 * Holds controller path
	 *
	 * @var string
	 */
	public $sControllerPath;

	/**
	 * Holds controller name
	 *
	 * @var string
	 */
	public $sController;

	/**
	 * Holds action name
	 *
	 * @var string
	 */
	public $sControllerAction;


	private static $aAllowedRoutes = array ('/','program');


	/**
	 * Loads the controller
	 *
	 * @return void
	 */
	public function load() {
		$this->getController();
		if (!is_readable($this->sControllerPath)) {
			$this->sControllerPath = CONTROLLER_PATH .'/error404.php';
			$this->sController = 'error404';
		}
		if ($this->isAllowedRoute($this->sController)) {
			include_once($this->sControllerPath);
			$oClass = $this->sController . 'Controller';
			$oController = new $oClass();
		} else {
			include_once(CONTROLLER_PATH . 'indexController.php');
			$oClass = 'indexController';
			$oController = new $oClass();
		}
		if (!is_callable(array($oController, $this->sControllerAction))) {
			$sAction = 'index';
		} else {
			$sAction = $this->sControllerAction;
		}

		return $oController->$sAction();
	}

	/**
	 * Private getter for the controller
	 *
	 * @return string
	 */
	private function getController() {
		$sRoute = $_SERVER['REQUEST_URI'];

		if (empty($sRoute)) {
			$sRoute = 'index';
		} else {
			$aParts = explode('/', $sRoute);
			$this->sController = $aParts[1];
			if (isset($aParts[2])) {
				$this->sControllerAction = $aParts[2];
			}
		}

		if (empty($this->sControllerAction)) {
			$this->sControllerAction = 'index';
		}

		if ($this->isAllowedRoute($aParts[1])) {
			return $this->sControllerPath = CONTROLLER_PATH . $this->sController . 'Controller.php';
		} else {
			return $this->sControllerPath = CONTROLLER_PATH . 'indexController.php';
		}
	}


	/**
	 * Checks if a route is among the allowed / registered ones to be served
	 *
	 * @param string $p_sRoute
	 * @return bool $bStatus True if the route is valid, false otherwise
	 * @todo implement registered routes to be fetched from the xxx_config database table
	 */
	private function isAllowedRoute ($p_sRoute) {
		$bStatus = false;
		if (in_array($p_sRoute, self::$aAllowedRoutes)) {
			$bStatus = true;
		}
		return $bStatus;
	}

}
?>
