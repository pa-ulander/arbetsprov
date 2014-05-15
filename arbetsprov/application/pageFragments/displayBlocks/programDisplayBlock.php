<?php
/**
 * Class that represents the data to display
 *
 * @author PA Ulander, pa@kabelkultur.se
 * @since Aug 2010
 * @package arbetsprov
 */
class programDisplayBlock extends PageFragmentBase {

	/**
	 * Renders the data list table
	 *
	 * @param ArrayObject $p_oListData
	 * @return string Html code
	 */
	public function renderTable (ArrayObject $p_oListData) {
		$sReturnStr = '';
		$sHeaderStr = '';

		$sReturnStr .= '<table><thead><tr>' . parent::NL;

		foreach(array('#', 'date', 'start_time', 'leadtext', 'name', 'b-line', 'synopsis', 'url', 'edit', 'del') as $iIdx => $sHeadStr) {
			$sHeaderStr .= '<th>' . $sHeadStr . '</th>';
		}

		$sHeaderStr .= '</tr></thead>' . parent::NL;
		$sReturnStr .= $sHeaderStr;
		$sReturnStr .= '<tbody>' . parent::NL;

		$oIterator = $p_oListData->getIterator();

		while ($oIterator->valid()) {

			$sReturnStr .= '<tr class="'. ($oIterator->key() % 2 ? 'even' : 'odd') .'">';
			$sReturnStr .= '<td>' . $oIterator->current()->getPkey() . '</td>';
			$sReturnStr .= '<td>' . $oIterator->current()->getDate() . '</td>';
			$sReturnStr .= '<td>' . $oIterator->current()->getStartTime() . '</td>';
			$sReturnStr .= '<td>' . $oIterator->current()->getleadText() . '</td>';
			$sReturnStr .= '<td>' . $oIterator->current()->getName() . '</td>';
			$sReturnStr .= '<td>' . $oIterator->current()->getBline() . '</td>';
			$sReturnStr .= '<td>' . $oIterator->current()->getSynopsis() . '</td>';
			$sReturnStr .= '<td>' . $oIterator->current()->getUrl() . '</td>';
			$sReturnStr .= '<td><a href="/program/update/' . $oIterator->current()->getPkey() . '"><button>Uppdatera</button></a></td>';
			$sReturnStr .= '<td>' . $this->renderDeleteForm($oIterator->current()->getPkey()) . '</td>';

			$sReturnStr .= '</tr>' . parent::NL;

			$oIterator->next();
		}

		$sReturnStr .= '</tbody></table>';

		return $sReturnStr;
	}

	/**
	 * Renders the edit form
	 *
	 * @param program $p_oProgram
	 * @return string html code
	 */
	public function renderEditform (program $p_oProgram) {
		$sReturnStr = '';
		$sReturnStr .= '
		<form class="editform" method="post" action="/program/update/'. $p_oProgram->getPkey() .'/" enctype="application/x-www-form-urlencoded">
		<label>date</label>
		<input type="text" name="date" value="'. $p_oProgram->getDate() .'" />
		<label>start_time</label>
		<input type="text" name="start_time" value="'. $p_oProgram->getStartTime() .'" />
		<label>leadtext</label>
		<textarea name="leadtext">'. $p_oProgram->getLeadText() .'</textarea>
		<label>name</label>
		<input type="text" name="name"  value="'. $p_oProgram->getName() .'"/>
		<label>b-line</label>
		<input type="text" name="b-line"  value="'. $p_oProgram->getBline() .'"/>
		<label>synopsis</label>
		<textarea name="synopsis">'. $p_oProgram->getSynopsis() .'</textarea>
		<label>url</label>
		<input type="text" name="url"  value="'. $p_oProgram->getUrl() .'" />

		<input type="hidden" name="pkey"  value="'. $p_oProgram->getPkey() .'" />

		<input type="submit" value="Spara" />

		</form>
		';

		return $sReturnStr;
	}

	/**
	 * Renders the add form
	 *
	 * @return string html code
	 */
	public function renderAddform () {
		$sReturnStr = '';
		$sReturnStr .= '
		<form class="editform" method="post" action="/program/add/" enctype="application/x-www-form-urlencoded">
		<label>date</label>
		<input type="text" name="date" value="'. (isset($_POST['date']) ? $_POST['date'] : '') .'" />
		<label>start_time</label>
		<input type="text" name="start_time" value="'. (isset($_POST['start_time']) ? $_POST['start_time'] : '') .'" />
		<label>leadtext</label>
		<textarea name="leadtext">'. (isset($_POST['leadtext']) ? $_POST['leadtext'] : '') .'</textarea>
		<label>name</label>
		<input type="text" name="name"  value="'. (isset($_POST['name']) ? $_POST['name'] : '') .'"/>
		<label>b-line</label>
		<input type="text" name="b-line"  value="'. (isset($_POST['b-line']) ? $_POST['b-line'] : '') .'"/>
		<label>synopsis</label>
		<textarea name="synopsis">'. (isset($_POST['synopsis']) ? $_POST['synopsis'] : '') .'</textarea>
		<label>url</label>
		<input type="text" name="url"  value="'. (isset($_POST['url']) ? $_POST['url'] : '') .'" />

		<input type="submit" value="Spara" />

		</form>
		';

		return $sReturnStr;
	}

	/**
	 * Renders the delete form
	 *
	 * @param int $p_iKey Id key for the row to delete
	 * @return string html code
	 */
	public function renderDeleteForm ($p_iKey) {;
		$sReturnStr = '';
		$sReturnStr .= '
		<form class="delform" method="post" action="/program/delete/" enctype="application/x-www-form-urlencoded">
		<input type="hidden" name="pkey" value="'. $p_iKey.'" />
		<input class="small" type="submit" value="Ta bort"  onclick="return confirm(\'&Auml;r du s&auml;ker p&aring; att du vill ta bort rad # ' . $p_iKey . ' ? \')" />
		</form>';

		return $sReturnStr;
	}



}