<?php
/**
 * Templating base class
 *
 * @author PA Ulander, pa@kabelkultur.se
 * @since Aug 2010
 * @package arbetsprov
 */
class Template {

	/**
	* Holder for variables
	*
	* @access private
	*/
	private $aVars = array();

	/**
	 * Holder for HelperPath
	 *
	 * @var string
	 */
	private $sHelperPath = 'helpers';


	private $bUseHelpers = true;


	public function getUseHelpers () {
		return $this->bUseHelpers;
	}

	public function setUseHelpers ($p_bUseHelpers = true) {
		$this->bUseHelpers = $p_bUseHelpers;
	}

	/**
	 * Getter for HelperPath
	 *
	 * @return string
	 */
	public function getHelperPath () {
		return $this->sHelperPath;
	}

	/**
	 * Setter for HelperPath
	 *
	 * @param string $p_sHelperPath
	 */
	public function setHelperPath ($p_sHelperPath) {
		$this->sHelperPath = $p_sHelperPath;
	}

	/**
 	* Magic setter for the template variables
 	*
 	* @param string $p_sIndex The index
 	* @param mixed $p_mVal The value
 	* @return void
 	*/
	public function __set($p_sIndex, $p_mVal) {
		$this->aVars[$p_sIndex] = $p_mVal;
	}

	public function view($p_sController, $p_sMethod = 'index') {
		$sPath = VIEW_PATH . $p_sController . SLASH . $p_sMethod . VIEW_EXT;

		if (!file_exists($sPath)) {
//			$sPath = VIEW_PATH . 'index/index' . VIEW_EXT;
			throw new Exception('Template not found in '. $sPath);
		}

		// Load variables
		foreach ($this->aVars as $sKey => $mVal) {
			$$sKey = $mVal;
		}

		if ($this->getUseHelpers()) {
			include (VIEW_PATH . $this->getHelperPath() . SLASH . 'htmlHeader' . VIEW_EXT);
			include (VIEW_PATH . $this->getHelperPath() . SLASH . 'pageContent' . VIEW_EXT);
		}

		include ($sPath);

		if ($this->getUseHelpers()) {
			include (VIEW_PATH . $this->getHelperPath() . SLASH . 'pageFooter' . VIEW_EXT);
		}

		return true;
	}


}
