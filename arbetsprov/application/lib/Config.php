<?php
/**
 * Class used to initiate the application configuration object
 *
 * @author PA Ulander, pa@kabelkultur.se
 * @since Aug 2010
 * @package arbetsprov
 */
class Config {

	/**
	 * Holds this instance
	 *
	 * @var object Config
	 */
    private static $oInstance;

    /**
     * Holds the configuration settings
     *
     * @var string
     */
    private $aConfig;

    /**
     * Constructor - initiates the configuration settings
     *
     * @access private since this is a singleton class
     * @param string $p_sIniFilePath
     * @param string $p_sResourceKey
     */
    private function __construct($p_sIniFilePath, $p_sResourceKey = null) {
        $this->aConfig = parse_ini_file($p_sIniFilePath, true);
    }

    /**
     * Handler to access this instance. Instansiates this class when needed.
     *
     * @param string $p_sIniFilePath
     * @return Config
     * @see Config::__construct()
     */
    public static function getInstance($p_sIniFilePath) {
        if(! isset(self::$oInstance)) {
            self::$oInstance = new Config ($p_sIniFilePath);
        }
        return self::$oInstance;
    }

    /**
     * Magic getter for the configuration settings found in the ini file
     *
     * @param string $p_sConfigKey
     * @return string
     */
    public function __get($p_sConfigKey) {
        if (array_key_exists($p_sConfigKey, $this->aConfig)) {
            return $this->aConfig[$p_sConfigKey];
        } else {
            foreach($this->aConfig as $aConfigBlock) {
                if (is_array($aConfigBlock) && array_key_exists($p_sConfigKey, $aConfigBlock)) {
                    return $aConfigBlock[$p_sConfigKey];
                }
            }
        }
    }

}
