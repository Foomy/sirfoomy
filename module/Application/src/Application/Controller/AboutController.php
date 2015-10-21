<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AboutController extends AbstractActionController
{
  public function curriculumVitaeAction()
  {
    return new ViewModel(array());
  }
}