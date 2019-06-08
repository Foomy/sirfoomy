<?php

require_once APPLICATION_PATH . '/library/Controller.php';
require_once APPLICATION_PATH . '/models/Quote/Peer.php';

class IndexController extends Base_Controller
{
    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        $this->view->quote = Model_Quote_Peer::getRandom();
    }
}

