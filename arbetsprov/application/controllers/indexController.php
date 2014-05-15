<?php

/**
 * Controller class for all common pages
 *
 * @author PA Ulander pa@kabelkultur.se
 * @since Aug 2010
 * @package arbetsprov
 */
class indexController extends controllerBase {
	/**
     * Main action delegation method of this class
     *
     * @return void
     */
	public function index() {

//		new debug(get_included_files());

		// no action, render default view
		$this->renderView();
	}



}