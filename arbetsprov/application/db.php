<?php
/**
 * Simple connection wrapper for using with PDO
 *
 * @author PA Ulander, pa@kabelkultur.se
 * @since Aug 2010
 * @package arbetsprov
 */
class db {

	/**
	 * Holds the connection handle
	 *
	 * @var PDO
	 */
	public $oConnection;

	/**
	 * Holder for the PDO Statement object
	 *
	 * @var PDOStatement
	 */
	public $oStmt;

	/**
	 * Connects to PDO - Connection settings are located in config.ini
	 *
	 * @return PDO
	 */
	public function __construct() {
		$oConfig = Config::getInstance ( CONFIG_INI_PATH );
		try {
			$this->oConnection = new PDO ( "$oConfig->databasedriver:host=$oConfig->databasehost;dbname=$oConfig->databasename", $oConfig->databaseuser, $oConfig->databasepasswd, array (PDO::ATTR_PERSISTENT => true, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'' ) );
			$this->oConnection->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		} catch ( PDOException $oEx ) {
			die ( 'Caught PDOException : ' . utf8_encode ( $oEx->getMessage() ) );
		}
		return $this->oConnection;
	}

	/**
	 * Sets an attribute on the db handle
	 *
	 * @param string $p_sAttribute
	 * @param string $p_sAtributeValue
	 * @return bool TRUE on success, FALSE on failure
	 */
	public function setAttribute($p_sAttribute, $p_sAtributeValue) {
		return $this->oConnection->setAttribute ( $p_sAttribute, $p_sAtributeValue );
	}

	/**
	 * Prepares a statement for execution and returns a statement object
	 *
	 * @param string $p_sSql A valid SQL-statement is expected
	 * @return PDOStatement
	 */
	public function prepare($p_sSql) {
		try {
			$this->oStmt = $this->oConnection->prepare ( $p_sSql );
		} catch ( PDOException $oEx ) {
			echo 'Caught PDOException : ' . utf8_encode ( $oEx->getMessage () );

		}

		return $this->oStmt;
	}

}