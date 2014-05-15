<?php
/**
 * Baseclass for all controllers and requests
 *
 * @author PA Ulander, pa@kabelkultur.se
 * @since Aug 2010
 * @package arbetsprov
 */
abstract class abstractController {

	/**
	 * Current request
	 *
	 * @var string
	 */
	protected $sRequest = null;

	/**
	 * Constructor for this instance
	 *
	 */
    public function __construct(){
    	$this->setRequest($_SERVER['REQUEST_URI']);
        $this->init();
    }

    /**
     * Initialize object
     *
     * Called from {@link __construct()} as final step of object instantiation.
     *
     * @return void
     */
    public function init() {

    }

    /**
     * Getter for Request
     *
     * @return string
     */
    public function getRequest() {
        return $this->sRequest;
    }

	/**
	 * Setter for Request
	 *
	 * @param string_type $p_sRequest
	 */
    public function setRequest($p_sRequest) {
        $this->sRequest = $p_sRequest;
    }



}