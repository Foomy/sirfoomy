<?php

namespace Application\Controller;

use Application\Form\Contact;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFilterFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController implements InputFilterAwareInterface
{
  private $inputFilter;

  public function indexAction()
  {
    return new ViewModel(array());
  }

  public function contactAction()
  {
    $form = new Contact();

    if ( $this->getRequest()->isPost() ) {
      $form->setInputFilter($this->getInputFilter());
      $form->setData($this->getRequest()->getPost());

      if ($form->isValid()) {
        // @todo Send E-Mail!
      }
    }

    return new ViewModel(array(
      'form' => $form
    ));
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

  public function setInputFilter(InputFilterInterface $inputFilter)
  {
    throw new \Exception('Not uses in this class.');
  }

  /**
   * Returns the input filter for the contact form.
   *
   * Note: Usually this method is within a model class related
   *       to the form. Due to lack of a model class I putted
   *       it here in the controller class.
   *
   * @todo Find a better place for this method.
   *
   * @return InputFilter
   */
  public function getInputFilter()
  {
    if (! $this->inputFilter) {
      $inputFilter = new InputFilter();
      $factory     = new InputFilterFactory();

      $inputFilter->add($factory->createInput(array(
        'name' => 'name',
        'required' => true,
        'filters' => array(
          array('name' => 'StripTags'),
          array('name' => 'StringTrim')
        )
      )));

      $inputFilter->add($factory->createInput(array(
        'name' => 'email',
        'required' => true,
        'filters' => array(
          array('name' => 'StripTags'),
          array('name' => 'StringTrim'),
          array('name' => 'EmailAddress')
        )
      )));

      $inputFilter->add($factory->createInput(array(
        'name' => 'message',
        'required' => true,
        'filters'  => array(
          array('name' => 'StripTags'),
          array('name' => 'StringTrim'),
        )
      )));

      $this->inputFilter = $inputFilter;
    }

    return $this->inputFilter;
  }
}
