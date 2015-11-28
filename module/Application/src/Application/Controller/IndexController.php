<?php

namespace Application\Controller;

use Application\Form\Contact;
use Foo\Debug;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFilterFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Mail\Message;
use Zend\Mail\Transport\Sendmail as SendmailTransport;
use Zend\Mail\Transport\Smtp as SmptTransport;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mime\Part;
use Zend\Mime\Message as MimeMessage;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController implements InputFilterAwareInterface
{
  use Debug;

  private $inputFilter;

  /**
   * Controller action for the start page.
   *
   * @return ViewModel
   */
  public function indexAction()
  {
    return new ViewModel(array());
  }

  /**
   * Controller action for the contact form. This method
   * prepares the for and processes it after it is sent by
   * the user. Afterwards then a email is created and sent
   * to the author.
   *
   * @return ViewModel
   */
  public function contactAction()
  {
    $form = new Contact();
    $form->setAttribute('action', $this->url()->fromRoute('contact'));

    if ( $this->getRequest()->isPost() ) {
      $form->setInputFilter($this->getInputFilter());
      $form->setData($this->getRequest()->getPost());

      if ($form->isValid()) {
        $values = $form->getData();
        $renderer = $this->getServiceLocator()->get('Zend\View\Renderer\RendererInterface');

        $mailView = new ViewModel(array(
          'data' => $values
        ));

        $mailView->setTemplate('mail/contact/text');
        $renderOutput = $renderer->render($mailView);
        $textPart = new Part($renderOutput);

        $mailView->setTemplate('mail/contact/html');
        $renderOutput = $renderer->render($mailView);
        $htmlPart = new Part($renderOutput);

        $cfg = $this->getServiceLocator()->get('Config');
        $mailConfig = $cfg['contact_form']['mail_config'];

        $body = new MimeMessage();
        $body->setParts(array(
          $textPart,
          $htmlPart,
        ));

        $message = new Message();
        $message->addTo($mailConfig['to']);
        $message->addFrom($mailConfig['from']);
        $message->addReplyTo($values['email']);
        $message->setSubject($mailConfig['subject']);
        $message->setBody($body);

//        $transport = new SendmailTransport('localhost');
        $transport = new SmptTransport();
        $transport->setOptions(new SmtpOptions(array(
          'name' => 'localhost',
          'host' => '127.0.0.1'
        )));
        $transport->send($message);

        return new ViewModel(array(
          'showThanks' => true
        ));
      }
    }

    $form->prepare();

    return new ViewModel(array(
      'form' => $form
    ));
  }

  /**
   * Controller action for the legal notice.
   *
   * @return ViewModel
   */
  public function legalNoticeAction()
  {
    return new ViewModel(array());
  }

  /**
   * Controller action for the privacy notice.
   *
   * @return ViewModel
   */
  public function privacyAction()
  {
    return new ViewModel(array());
  }

  /**
   * Controller action for the page with the
   * frequently asked questions. :-)
   *
   * @return ViewModel
   */
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
          array('name' => 'StringTrim')
        ),
        'validators' => array(
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
