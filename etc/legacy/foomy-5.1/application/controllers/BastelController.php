<?php

class BastelController extends Base_Controller
{

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {

    }

    public function phpTestsAction()
    {
        $person = array(
            'name' => 'Sascha',
            'familyName' => 'Schneider',
            'age' => 32
        );

        $this->view->person = $person;
    }

    public function configTestAction()
    {
        require_once 'PHPSettings/Api.php';
        
        $file = APPLICATION_PATH . '/configs/bastel/config.ini';
        
        $settings = new PHPSettings_Api();
        $settings->loadFile($file);
        
        $settings->getConfigAsObject()->album->title = 'Conan der Barbar';
        $settings->save();
        
        echo '<pre>'; print_r($settings->getConfigAsObject()->album->title); echo '</pre>';
    }
    
}
