<?php
/**
 * Base class for page fragment classes
 *
 * @author PA Ulander, pa@kabelkultur.se
 * @since Aug 2010
 * @package arbetsprov
 */
abstract class PageFragmentBase {

	/**
     * Constant for the newline character
     */
	const NL = "\n";

	/**
     * Adds an extra string to the specified registry entry.
     *
     * Intended to be called from methods needing to append strings to texts
     * sent to the clients or for general display area build-up.
     *
     * @param string $p_sStringToAdd String to add to the registry
     * @param string $p_sRegistryKey Registry key, may be defined in the calling methods, defaults to mainContent
     * @return bool Always true in lieu of void
     */
	public static function appendToRegistry ($p_sStringToAdd, $p_sRegistryKey = 'mainContent') {
		$sExtraReg = '';
		if (Registry::isRegistered($p_sRegistryKey)) {
			$sExtraReg = Registry::get($p_sRegistryKey);
		}
		Registry::set($p_sRegistryKey, $sExtraReg . $p_sStringToAdd . self::NL);

		return true;
	}

	/**
     * Fetches the content of a registry
     *
     * @param string $p_sRegistryKey
     * @return string Registry content, or empty string if not defined
     */
	public static function getRegistry ($p_sRegistryKey) {
		$sRegistry = '';
		if (Registry::isRegistered($p_sRegistryKey)) {
			$sRegistry = Registry::get($p_sRegistryKey);
		}

		return $sRegistry;
	}

	/**
     * Sets (replaces) the content of a registry
     *
     * The registry key is mandatory in order to minimize the risk of
     * unintentionally replacing a registry
     *
     * @param string $p_sRegistryKey
     * @param string $p_sContent
     */
	public static function setRegistry ($p_sRegistryKey, $p_sContent) {
		Registry::set($p_sRegistryKey, $p_sContent);
	}

}