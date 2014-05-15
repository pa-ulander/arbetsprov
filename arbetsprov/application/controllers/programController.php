<?php

/**
 * Controller class for programs
 *
 * @author PA Ulander pa@kabelkultur.se
 * @since Aug 2010
 * @package arbetsprov
 */
class programController extends controllerBase  {


	/**
     * Main action delegation method of this class
     *
     * @return void
     */
	public function index() {
		// explode request
		$aReqParams = Util::getReqParams();
		// look if a request corresponds to an existing method
		if (isset($aReqParams[2]) && method_exists($this, 'program' . ucfirst($aReqParams[2]))) {
			// call found method name
			$sContentToRender = $this->{'program' . ucfirst($aReqParams[2])}($aReqParams);
		} else {
			// no action, render default view
			PageFragmentBase::appendToRegistry('programController says hello');
			$this->renderView();
		}
	}

	/**
	 * Handles the listing of programdata
	 * Corresponds to the url /program/list/
	 *
	 * @param array $p_aReqParams Request parameters as exploded on / by the action delegation method
	 */
	public function programList ($p_aReqParams) {
		$aResult = array();

		try {
			// prepare statement
			$oStmt = $this->getDb()->prepare('SELECT `pkey`, `date`, `start_time`, `leadtext`, `name`, `b-line`, `synopsis`, `url` FROM `programs`');
			$oStmt->setFetchMode(PDO::FETCH_ASSOC);
			$oStmt->execute();
		} 	catch(PDOException $oEx) {
			PageFragmentBase::appendToRegistry('Caught exception: ' . $oEx->getMessage());
		}

		// include displyBlock
		include_once('pageFragments/displayBlocks/programDisplayBlock.php');

		// the displayBlock deals with html code rendering
		$oDisplay = new programDisplayBlock();

		// container for the list to render
		$oProgramList = new ArrayObject();

		// append data to model class
		$aResult = $oStmt->fetchAll(PDO::FETCH_ASSOC);

		foreach ($aResult as $iIdx => $aData ) {
			$oProgramList->append(new program($aData));
		}

		// create list and add it to the registry for later rendering
		PageFragmentBase::appendToRegistry($oDisplay->renderTable($oProgramList));

		// initiate view
		$this->renderView();
	}

	/**
	 * Handles the adding of new programs
	 * Corresponds to the url - /program/add/
	 *
	 * return void
	 */
	public function programAdd () {

		// look for postdata
		if ($this->isHttpPost()) {

			if (true === $this->validatePostData($_POST)) {

				try {
					// prepare insert statement
					$oStmt = $this->getDb()->prepare('INSERT INTO `programs`
				( `pkey`, `date`, `start_time`, `leadtext`, `name`, `b-line`, `synopsis`, `url`) VALUES
				( :iPkey, :sDate, :sStartTime, :leadtext, :name, :bline, :synopsis, :url)');

					// bind params and execute query
					$oStmt->execute(array(
					':iPkey'=> NULL,
					':sDate'=> $_POST['date'],
					':sStartTime'=> $_POST['start_time'],
					':leadtext' => $_POST['leadtext'],
					':name'=> $_POST['name'],
					':bline'=> $_POST['b-line'],
					':synopsis'=> $_POST['synopsis'],
					':url' => $_POST['url']
					));

				} catch(PDOException $e) {
					echo 'Error: ' . $e->getMessage();
				}

				if (1 === $oStmt->rowCount()) {
					// display message on successful add
					PageFragmentBase::appendToRegistry('<br class="clear"><div class="success">Din data har sparats</div>');
				}
			}
		}


		// include displyBlock
		include_once('pageFragments/displayBlocks/programDisplayBlock.php');

		// the displayBlock deals with html code rendering
		$oDisplay = new programDisplayBlock();

		// create addform and add it to the registry for later rendering
		PageFragmentBase::appendToRegistry($oDisplay->renderAddform());

		// initiate view
		$this->renderView();
	}

	/**
	 * Handles the updating of programdata
	 * Corresponds to the url /program/update/nn
	 *
	 * @param array $p_aReqParams Request parameters as exploded on / by the action delegation method
	 * @return void
	 */
	public function programUpdate ($p_aReqParams) {
		// look for postdata
		if ($this->isHttpPost()) {

			if (true === $this->validatePostData($_POST)) {

				try {
					// prepare update statment
					$oStmt = $this->getDb()->prepare('UPDATE programs SET date = :sDate, start_time = :sStartTime, leadtext = :leadtext, name = :name, `b-line` = :bline, synopsis = :synopsis, url = :url WHERE pkey = :iPkey');

					// map before updating, this is where validation should take place
					$sDate = $_POST['date'];
					$sStartTime = $_POST['start_time'];
					$sLeadtext = $_POST['leadtext'];
					$sName = $_POST['name'];
					$sBline = $_POST['b-line'];
					$sSynopsis = $_POST['synopsis'];
					$sUrl = $_POST['url'];
					$iPkey = $_POST['pkey'];

					// bind params and execute query
					$oStmt->execute(array(
					':sDate'   => $sDate,
					':sStartTime'   => $sStartTime,
					':leadtext' => $sLeadtext,
					':name' => $sName,
					':bline' => $sBline ,
					':synopsis' => $sSynopsis ,
					':url' => $sUrl ,
					':iPkey' => $iPkey
					));

				} catch(PDOException $oEx) {
					PageFragmentBase::appendToRegistry('Caught exception: ' . $oEx->getMessage());
				}

				if (1 === $oStmt->rowCount()) {
					// display message on successful update
					PageFragmentBase::appendToRegistry('<br class="clear"><div class="success">Rad #' . $iPkey . ' är uppdaterad.</div>');
				}
			}
		}


		try {
			// select the row to update
			$oStmt = $this->getDb()->prepare('SELECT pkey, date, start_time, leadtext, name, `b-line`, synopsis, url FROM programs where pkey = :id');

			// set PDO errormode to throw exeptions for everything
			$this->getDb()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// we want a associative array
			$oStmt->setFetchMode(PDO::FETCH_ASSOC);

			// execute the prepared statement
			$oStmt->execute(array(':id' => $p_aReqParams[3]));

			// initiate variable
			$aResult = array();

			// add sqlresult
			$aResult = $oStmt->fetch();

		} catch (PDOException $oEx) {
			PageFragmentBase::appendToRegistry('Caught exception: ' . $oEx->getMessage());
		}


		// include displyBlock
		include_once('pageFragments/displayBlocks/programDisplayBlock.php');

		// the displayBlock deals with html code rendering
		$oDisplay = new programDisplayBlock();

		// add updateform to registry for later rendering
		PageFragmentBase::appendToRegistry($oDisplay->renderEditform(new program($aResult)));

		// init view
		$this->renderView();
	}

	/**
	 * Hamdles the delete action
	 *
	 * return void
	 */
	public function programDelete () {
		// look for postdata
		if ($this->isHttpPost()) {
			// map
			$iPkey = $_POST['pkey'];
			try {
				// prepare update statment
				$oStmt = $this->getDb()->prepare( ' DELETE FROM `programs` WHERE `pkey` = :iPkey ' );

				// bind params and execute query
				$oStmt->bindParam(':iPkey', $iPkey);
				$oStmt->execute();

			} catch(PDOException $oEx) {
				PageFragmentBase::appendToRegistry('Caught exception: ' . $oEx->getMessage());
			}

			if (1 === $oStmt->rowCount()) {
				// display meassage message on success
				PageFragmentBase::appendToRegistry('<br class="clear"><div class="success">Rad #' . $iPkey . ' blev borttagen.</div>');
			}
		}

		// display the table list view
		$this->programList(array('', 'programController', 'list'));
	}


	/**
	 * Handles the request to view programdata as XML
	 * Corresponds to the url /program/xml/
	 *
	 * return void
	 */
	public function programXml () {
		try {
			// prepare query
			$oStmt = $this->getDb()->prepare('SELECT date, start_time, leadtext, name, `b-line`, synopsis, url FROM programs');

			// set fecthmode
			$oStmt->setFetchMode(PDO::FETCH_ASSOC);

			// execute query
			$oStmt->execute();

			// init variable
			$aResultData = array();

			// store resultdata
			$aResultData = $oStmt->fetchAll();
		} catch (PDOException $oEx) {
			// add exception errormessage to registry for later rendering
			PageFragmentBase::appendToRegistry('Caught exception: ' . $oEx->getMessage());
		}

		// xml util class
		$oXmlUtil = new XmlUtil();

		// prevent templatehelpers from messing up xmloutput
		Registry::get('oTemplate')->setUseHelpers(false);

		// Add xmldatat to registry fro later rendering
		PageFragmentBase::appendToRegistry($oXmlUtil->createXml('<programs/>', $aResultData));

		// init view
		$this->renderView();
	}

	/**
	 * Checks for missing fields when adding/updating
	 *
	 * @param array $p_aData
	 * @return bool True if no fields are empty, false otherwise
	 */
	public function validatePostData ($p_aData) {
		$bStatus = true;
		$aEmpty = array();
		if (is_array($p_aData)) {
			foreach ($p_aData as $sKey => $mVal) {
				if (empty($mVal)) {
					$aEmpty[] = $sKey;
				}
			}
		}

		// errors was found
		if (0 < count($aEmpty)) {
			$bStatus = false;
			PageFragmentBase::appendToRegistry('
				<br class="clear">
					<div class="error">Fält som ej är ifyllda:
					' . implode(', ', $aEmpty) . '
					. <br>Fyll i det som saknas och försök igen.
				</div>
				');
		}

		return $bStatus;
	}


}