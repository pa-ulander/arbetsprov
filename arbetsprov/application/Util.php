<?php
/**
 * Class containing some utility like methods
 *
 * @author PA Ulander, pa@kabelkultur.se
 * @since Aug 2010
 * @package arbetsprov
 */
class Util {

	/**
	 * Checks if a request is made via post or not
	 *
	 * @return bool
	 */
	public static function isHttpPost () {
		return ('post' == strtolower($_SERVER['REQUEST_METHOD']) ? true : false);
	}

	/**
	 * Returns current request as an array
	 *
	 * @return array
	 */
	public static function getReqParams () {
		$aReqParams = array();
		$aReqParams = explode('/', $_SERVER['REQUEST_URI']);

		return $aReqParams;
	}

	/**
	 * Returns requested url part
	 *
	 * @return array
	 */
	public static function getReqParam ($p_iKey) {
		$aParams = array();
		$sReturn = false;
		$aParams = explode('/', $_SERVER['REQUEST_URI']);
		if (array_key_exists($p_iKey, $aParams) && '' != $aParams[$p_iKey]) {
			$sReturn = $aParams[$p_iKey];
		}

		return $sReturn;
	}

	/**
	 * Checks if a given param exists at a given offset in a given context
	 *
	 * @param mixed $p_mParams
	 * @param mixed $p_mParam
	 * @param mixed $p_mOffset
	 * @return bool
	 */
	public static function paramExists ($p_mParams, $p_mParam, $p_mOffset) {
		$bStatus = false;
		if (is_array($p_mParams)) {
			$bStatus = (in_array($p_mParam, $p_mParams) && $p_mParam == $p_mParams[$p_mOffset] ? true : false);
		}

		return $bStatus;
	}

	/**
	 *
	 *
	 * @param  string $p_sUrl url to handle
	 * @return string         The base url
	 */
	public static function getBaseUrl ($p_sUrl) {
		$aBaseUrl = array();
		$aBaseUrl = explode('/', $p_sUrl);
		array_pop($aBaseUrl);

		return implode('/', $aBaseUrl);
	}


}