<?php

require_once 'Zend/View/Interface.php';

/**
 * This helper loads the stylesheets for the skin passed to it.
 *
 * @category    Foomy-5.2
 * @package     Zend_View_Helper
 * @subpackage  LoadSkin
 *
 * @author Sascha Schneider <foomy.code@arcor.de>
 * @version 0.2
 */
class Zend_View_Helper_LoadSkin
{
    
    const SKIN_STANDARD_FOLDER = '/skins/';
    
    /**
     * @var Zend_View_Interface 
     */
    public $view;
    
    /**
     * 
     */
    public function loadSkin($skin)
    {
        if (!isset($skin) || empty($skin)) {
            $skin = 'default';
        }
        
        // Load the skin config file
        $skinData = new Zend_Config_Xml('./' . self::SKIN_STANDARD_FOLDER . $skin . '/skin.xml');
        $stylesheets = $skinData->stylesheets->stylesheet->toArray();
        
        // Append each stylesheet
        if (is_array($stylesheets)) {
            foreach($stylesheets as $stylesheet) {
                $this->view->headLink()->appendStylesheet(self::SKIN_STANDARD_FOLDER . $skin . '/css/' . $stylesheet);
            }
        }
        
        return null;
    }
    
    /**
     * Sets the view field 
     * @param $view Zend_View_Interface
     */
    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }
}

