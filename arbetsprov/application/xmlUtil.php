<?php
/**
 * A simple class for dealing with xml
 *
 * @author PA Ulander, pa@kabelkultur.se
 * @since Aug 2010
 * @package arbetsprov
 */
class XmlUtil {

	/**
	 * Basic method for rendering xml from simple structs
	 *
	 * @param string $p_sContainer A string for the container tag
	 * @param array $p_aDbData
	 * @return string XML code formatted for output
	 */
	public function createXml ($p_sContainer, array $p_aDbData) {
		// php's simpleXml extension
		$oXml = new SimpleXMLElement($p_sContainer);

		if (is_array($p_aDbData)) {
			for ($iIdx = 0; $iIdx < count($p_aDbData); ++$iIdx) {
				foreach ($p_aDbData[$iIdx] as $sKey => $sValue) {
					if ('date' == $sKey) {
						$oXml->addChild($sKey, date(DATE_ATOM, strtotime($sValue)));
					} else {
						$oXml->addChild($sKey, $sValue);
					}
				}
			}
		}

		// header for output
		header ("Content-Type:text/xml; charset=utf-8");
		return $oXml->asXML();
	}

}