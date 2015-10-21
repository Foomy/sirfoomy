<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
  public function indexAction()
  {
    return new ViewModel(array());
  }

  public function contactAction()
  {
    return new ViewModel(array());
  }

  public function legalNoticeAction()
  {
    return new ViewModel(array());
  }

  public function privacyAction()
  {
    return new ViewModel(array());
  }

  public function faqAction()
  {
    return new ViewModel(array());
  }
}
