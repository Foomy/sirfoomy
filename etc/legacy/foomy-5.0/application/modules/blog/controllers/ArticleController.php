<?php

/**
 * Controller class for the blog main page.
 *
 * @category    Foomy
 * @package     Foomy_Blog
 * @subpackage  Controllers
 *
 * @version     5.0
 * @author      Sascha Schneider <foomy.code@arcor.de>
 */

class Blog_ArticleController extends Foomy_Base_Controller
{
    const DEBUG = true;

    /**
     * Inits the article controller
     */
    public function init()
    {
        parent::init();

        $cfg = new Zend_Config_Ini(APPLICATION_PATH.'/modules/blog/configs/application.ini');

        // Initialize the blog for the showAction
        $blog = Foomy_Blog_Model_Blog_Peer::getById($cfg->blog->activeBlog);
        $this->view->blog = $blog;

        // Initialize the article form for the newAction
        // respectively the editAction.
        $form = new Foomy_Blog_Form_Article();
        $form->setAction($this->view->url().'/');
        $form->getElement('blog_id')->setValue($blog->getId());
        $this->view->form = $form;
    }// init()

    /**
     * This is a void action, it just redirects to the blog main page.
     */
    public function indexAction()
    {
        // Init redirector for indexAction
        $redirector = $this->_helper->getHelper('Redirector');
        $redirector->setCode(303)
                   ->setExit(true)
                   ->setGotoSimple('index', 'index', 'blog');
        $redirector->redirectAndExit();
    }

    /**
     * Shows a specified article.
     *
     * @param void
     * @return void
     */
    public function showAction()
    {
        if ($this->getRequest()->isGet()) {
            $artId = $this->getRequest()->getParam('artid');
        }
    
        $this->view->article = $this->view->blog->getArticle($artId);
    }// showAction()

    /**
     * Saves a new article in the database.
     *
     * @param void
     * @return void
     */
    public function newAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            if (self::DEBUG) {
                Zend_Debug::Dump($request->getPost(), '->getPost()');
            }

            // Are there more than one SubForms?
            if ( count($request->getPost())>8 ) {
                // Jap, there are. So let's put new SubForms the article form.
                for ($i=1; $i<=count($request->getPost())-8; $i++) {
                    $pSubForm = new Foomy_Blog_Form_Paragraph();
                    $this->view->form->addSubForm($pSubForm, 'pSubForm_'.$i);
                }
            }

            // Validate committed parmeters...
            if ($this->view->form->isValid($request->getPost())) {
                $formValues = $this->view->form->getValues();

                if ( self::DEBUG ) {
                    Zend_Debug::Dump($formValues, '$formValues');
                }

                // ... and save the values in the database.
                $articleTbl = Foomy_Blog_Model_Article_Peer::getInstance();
                $article = $articleTbl->createRow();
                $article->setBlogId($formValues['blog_id']);
                $article->setHeadline($formValues['headline']);
                $article->setSubhead($formValues['subhead']);
                $article->addAbstract($formValues['abstract']);

                foreach ($formValues as $key => $value) {
                    if (strpos($key, 'pSubForm_') !== false) {
                        $article->addParagraph($value['paragraph']);
                    }
                }
     
                $article->save();
            }
        }
    }// newAction()

    /**
     * Shows a article for editing and saves the edited article.
     *
     * @param void
     * @return void
     */
    public function editAction()
    {
        if ($this->getRequest()->isGet()) {
            $artId   = $this->getRequest()->getParam('artid');
            $article = $this->view->blog->getArticle($artId);

            $form = $this->view->form;
            $form->getElement('article_id')->setValue($article->getId());
            $form->getElement('headline')->setValue($article->getHeadline());
            $form->getElement('subhead')->setValue($article->getSubhead());
            $form->getElement('abstract')->setValue($article->getAbstract());

            $i = 0;
            foreach ($article->getTextParagraphs() as $paragraph) {
                if (self::DEBUG) {
                    Zend_Debug::Dump($paragraph->getParagraphText(), 'paragraph '.$i);
                }

                $pSubForm = new Foomy_Blog_Form_Paragraph();
                $pSubForm->getElement('paragraph')->setValue($paragraph->getParagraphText());

                if ($i > 0) {
                    $pSubForm->getElement('paragraph')->setLabel('');
                }

                $form->addSubForm($pSubForm, 'pSubForm_'.$i);
                $i++;
            }

            $this->view->form = $form;
        } else {
            $redirector = $this->_helper->getHelper('Redirector');
            $redirector->setCode(303)
                       ->setExit(true)
                       ->setGotoSimple('index', 'index', 'blog');
            $redirector->redirectAndExit();   
        } 
    }// editAction()

}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
