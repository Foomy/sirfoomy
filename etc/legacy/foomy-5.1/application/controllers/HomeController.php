<?php

require_once APPLICATION_PATH . '/library/Controller.php';

class HomeController extends Base_Controller
{
    public function init()
    {
        parent::init();
        $this->view->placeholder('rightbox')->append($this->view->partial('partials/_links.phtml'));
        $this->view->placeholder('rightbox')->append($this->view->partial('partials/_wimip.phtml'));
    }

    public function indexAction()
    {

    }

}

