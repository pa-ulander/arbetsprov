<?php
/**
 * require base controller
 */
require ('abstractController.php');

/**
 * Base class for all controller actions
 *
 * @author PA Ulander, pa@kabelkultur.se
 * @since Aug 2010
 * @package arbetsprov
 */
abstract class controllerBase extends abstractController {

	/**
	 * @abstract all controllers must contain an index method
	 */
	abstract function index();

	/**
	 * Database representation
	 *
	 * @var db
	 */
	private $oDb;

	/**
	 * Setter for the database connection
	 *
	 * @param db $p_oDb
	 */
	protected function setDb(db $p_oDb) {
		if ($p_oDb instanceof db) {
			$this->oDb = $p_oDb;
		} else {
			$this->oDb = new db ();
		}
	}

	/**
	 * Getter for the database connection
	 *
	 * @return db
	 */
	protected function getDb() {
		return $this->oDb;
	}

	/**
	 * Initiates request handling and other basics common to all controllers and actions
	 *
	 * @see abstractController
	 */
	public function init() {

		// database
		try {
			if (! ($this->oDb instanceof db)) {
				$oDb = new db ();
				$this->setDb ( $oDb );
			}
		} catch ( Exception $oEx ) {
			PageFragmentBase::appendToRegistry('Caught exception: ' . $oEx->getMessage());
		}

		// registry
		Registry::set ( 'mainContent', '' );
	}

	/**
	 * Sends all content to the view to be rendered by the template
	 *
	 * @param string $p_sView The view to to call. Defaults to 'index'
	 * @return void
	 */
	public function renderView($p_sView = 'index') {
		try {
			Registry::get ( 'oTemplate' )->view ( $p_sView );
		} catch ( Exception $oEx ) {
			echo $oEx->getMessage ();
		}
	}

	/**
	 * Determines whether the request method was HTTP-Post or not
	 *
	 * @return bool True if HTTP-Post was used, false otherwise
	 */
	protected function isHttpPost() {
		return ('post' == strtolower ( $_SERVER ['REQUEST_METHOD'] ));
	}

}