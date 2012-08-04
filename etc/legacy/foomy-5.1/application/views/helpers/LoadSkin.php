<?php

/**
 * This class loads the skin for the website
 */

class Zend_View_Helper_LoadSkin extends Zend_View_Helper_Abstract
{
    public function loadSkin($skin)
    {
        // Load the skin config file
        $skinData = new Zend_Config_Xml('./skins/' . $skin . '/skin.xml');
        $stylesheets = $skinData->stylesheets->stylesheet->toArray();

        // Append each stylesheet
        if (is_array($stylesheets)) {
            foreach ($stylesheets as $stylesheet) {
                $this->view->headLink()->appendStylesheet('/skins/' . $skin . '/css/' . $stylesheet);
            }
        }
    }
}
