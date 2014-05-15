<?php

class debug {
    
    /** 
     * new-line constant
     */
    const NL = "\n";
    
    /**
     * The constructor does the work of the class. Prints out the $p_mToInspect using print_r()
     * 
     * @param mixed $p_mToInspect Main data to display in the debug frame
     */
    public function __construct($p_mToInspect = false) {
     $sExtraReg = '';
        $aDebug = debug_backtrace();
        $sHeading  = (isset($aDebug[1]['class']) ?  $aDebug[1]['class'] : '') . '::';
        $sHeading .= (isset($aDebug[1]['function']) ? $aDebug[1]['function'] : '') . '::';
        $sHeading .= (isset($aDebug[0]['line']) ? $aDebug[0]['line'] : '');
        $sDisplay  = '<div style="background-color: #f5f5f5; border: 2px #ddd solid; display: block; clear: both; text-align: left; padding: 5px; margin-top: 2px">' . self::NL;
        $sDisplay .= '<!-- Debug info -->' . self::NL;
        $sDisplay .= '<span style="font-weight: bold; font-size: 12px;">'. $sHeading . '</span><br />' . self::NL;
        $sDisplay .= '<pre style="font-size: 12px;">' . self::NL . htmlentities(print_r($p_mToInspect, true), ENT_SUBSTITUTE) . self::NL . '</pre>' . self::NL;
        $sDisplay .= '</div>' . self::NL;
        
        echo ($sDisplay);
    }
    
}
?>