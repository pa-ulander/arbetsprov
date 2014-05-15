<?php
/**
 * Class used to initiate a registry object
 *
 * @author PA Ulander, pa@kabelkultur.se
 * @since Aug 2010
 * @package arbetsprov
 */
class Registry extends ArrayObject {

	/**
     * Holds the class name of this instance
     *
     * @var string
     */
	private static $sClassName = __CLASS__;

	/**
     * Holds the registry object
     *
     * @var Registry
     */
	private static $oRegistry = null;

	/**
     * Initialize this instance
     *
     * @return void
     */
	protected static function init() {
		self::setInstance(new self::$sClassName());
	}

	/**
     * Getter for Registry
     *
     * @return Registry
     */
	public static function getInstance() {
		if (!self::$oRegistry) {
			self::init();
		}
		return self::$oRegistry;
	}

	/**
     * Setter for Registry
     *
     * @param Registry $p_oRegistry
     */
	public static function setInstance($p_oRegistry) {
		if (self::$oRegistry !== null) {
			throw new Exception('Registry is already initialized');
		}
		self::setClassName(get_class($p_oRegistry));
		self::$oRegistry = $p_oRegistry;
	}

	/**
     * Setter for ClassName
     *
     * @param string $p_sClassName
     */
	public static function setClassName($p_sClassName = 'Registry') {
		if (self::$oRegistry !== null) {
			throw new Exception('Registry is already initialized');
		}
		if (!is_string($p_sClassName)) {
			throw new Exception("Argument is not a class name");
		}
		self::$sClassName = $p_sClassName;
	}

	/**
     * Unsets the registry
     *
     * @returns void
     */
	public static function unsetInstance() {
		self::$oRegistry = null;
	}

	/**
     * Getter method, synonymous to offsetGet()
     *
     * @param string $p_sIndex - get the value associated with $index
     * @return mixed
     * @throws Exception if no entry is registerd for $index.
     */
	public static function get($p_sIndex) {
		$oInstance = self::getInstance();
		if (!$oInstance->offsetExists($p_sIndex)) {
			throw new Exception("No entry is registered for key '$p_sIndex'");
		}
		return $oInstance->offsetGet($p_sIndex);
	}

	/**
     * Setter method, synonymous to offsetSet().
     *
     * @param string $p_sIndex The location in the ArrayObject in which to store the value.
     * @param mixed $p_mValue The object to store in the ArrayObject.
     * @return void
     */
	public static function set($p_sIndex, $p_mValue) {
		$oInstance = self::getInstance();
		$oInstance->offsetSet($p_sIndex, $p_mValue);
	}

	/**
     * Checks if a value is registered, synonymous to offsetExists()
     *
     * @param  string $p_sIndex
     * @return bool True if $p_sIndex is a named value in the registry, false otherwise
     */
	public static function isRegistered($p_sIndex) {
		if (self::$oRegistry === null) {
			return false;
		}
		return self::$oRegistry->offsetExists($p_sIndex);
	}

	/**
	 * Wrapper method for offsetExists
	 *
     * @param string $index
     * @returns mixed
     */
	public function offsetExists($p_sIndex) {
		return array_key_exists($p_sIndex, $this);
	}

}
?>
