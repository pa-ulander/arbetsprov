<?php
/**
 * Databean like class representing a row of program data
 *
 * @author PA Ulander, pa@kabelkultur.se
 * @since Aug 2010
 * @package arbetsprov
 */
class program {

	/**
	 * Holder for pkey
	 *
	 * @var int
	 */
	private $iPkey;

	/**
	 * Holder for date
	 *
	 * @var string
	 */
	private $sDate;

	/**
	 * Holder for start_time
	 *
	 * @var string
	 */
	private $sStartTime;

	/**
	 * Holder for leadtext
	 *
	 * @var string
	 */
	private $sLeadText;

	/**
	 * Holder for name
	 *
	 * @var string
	 */
	private $sName;

	/**
	 * Holder for b_line
	 *
	 * @var string
	 */
	private $sBline;

	/**
	 * Holder for synopsis
	 *
	 * @var string
	 */
	private $sSynopsis;

	/**
	 * Holder for Url
	 *
	 * @var string
	 */
	private $sUrl;

	/**
     * Maps the column names to the names used in this bean
     *
     * @var array
     */
	private static $aDataMapping = array (
	'pkey' => 'Pkey',
	'date' => 'Date',
	'start_time' => 'StartTime',
	'leadtext' => 'LeadText',
	'name' =>'Name',
	'b-line' => 'Bline',
	'synopsis' => 'Synopsis',
	'url' => 'Url'
	);

	/**
	 * Getter for Pkey
	 *
	 * @return int $iPkey
	 */
	public function getPkey() {
		return $this->iPkey;
	}

	/**
	 * Setter for Pkey
	 *
	 * @param int $p_iPkey
	 */
	public function setPkey($p_iPkey) {
		$this->iPkey = $p_iPkey;
	}

	/**
	 * Getter for date
	 *
	 * @return string
	 */
	public function getDate () {
		return $this->sDate;
	}

	/**
	 * Setter for date
	 *
	 * @param string $p_sDate
	 */
	public function setDate($p_sDate) {
		$this->sDate = $p_sDate;
	}

	/**
	 * Getter for Starttime
	 *
	 * @return string $sStartTime
	 */
	public function getStartTime() {
		return $this->sStartTime;
	}

	/**
	 * Setter for StartTime
	 *
	 * @param time $p_sStartTime
	 */
	public function setStartTime($p_sStartTime) {
		$this->sStartTime = $p_sStartTime;
	}

	/**
	 * Getter for Leadtext
	 *
	 * @return string $sLeadText
	 */
	public function getLeadText() {
		return $this->sLeadText;
	}

	/**
	 * Setter for LeadText
	 *
	 * @param string $sLeadText
	 */
	public function setLeadText($p_sLeadText) {
		$this->sLeadText = $p_sLeadText;
	}

	/**
	 * Getter for Name
	 *
	 * @return string $sName
	 */
	public function getName() {
		return $this->sName;
	}

	/**
	 * Setter for Name
	 *
	 * @param string $sName
	 */
	public function setName($p_sName) {
		$this->sName = $p_sName;
	}

	/**
	 * Getter for Bline
	 *
	 * @return string $sBline
	 */
	public function getBline() {
		return $this->sBline;
	}

	/**
	 * Setter for Bline
	 *
	 * @param string $p_sBline
	 */
	public function setBline($p_sByline) {
		$this->sBline = $p_sByline;
	}

	/**
	 * Getter for Synopsis
	 *
	 * @return string $sSynopsis
	 */
	public function getSynopsis() {
		return $this->sSynopsis;
	}

	/**
	 * Setter for Synopsis
	 *
	 * @param string $sSynopsis
	 */
	public function setSynopsis($p_sSynopsis) {
		$this->sSynopsis = $p_sSynopsis;
	}

	/**
	 * Getter for Url
	 *
	 * @return string $sUrl
	 */
	public function getUrl() {
		return $this->sUrl;
	}

	/**
	 * Setter for Url
	 *
	 * @param string $sUrl
	 */
	public function setUrl($p_sUrl) {
		$this->sUrl = $p_sUrl;
	}

	/**
     * Constructor - sets the member fields if relevant data is passed as parameter
     *
     * @param array $p_aData Hash with data from some database
     */
	public function __construct ($p_aData = null) {
		if (is_array($p_aData)) {
			$this->populateData($p_aData);
		}
	}

	/**
     * Populates the list data fields
     *
     * @param array $p_aData Hash with key => value pairs
     * @return int Number of populated member fields
     */
	public function populateData ($p_aData) {
		$iNumPopulated = 0;
		if (is_array($p_aData)) {
			foreach ($p_aData as $sKey => $mValue) {
				if (isset($p_aData[$sKey]) && isset(self::$aDataMapping[$sKey]) && method_exists($this, 'set' . ucfirst(self::$aDataMapping[$sKey]))) {
					$this->{'set' . ucfirst(self::$aDataMapping[$sKey])}($mValue);
					$iNumPopulated++;
				}
			}
		}

		return $iNumPopulated;
	}
}