<?php

/**
 * Index controller for the module bookmarks.
 *
 * The index controller lists up the bookmarks and provides
 * further links to edit or create them.
 *
 * @category    Foomy
 * @package     Bookmarks
 * @subpackage  Controllers
 * @version     5.0
 * @author      Sascha Schneider <foomy.code@arcor.de>
 */

class Bookmarks_IndexController extends Foomy_Base_Controller
{
    const DEBUG = false;

    const ITEMS_PER_PAGE = 10;
    const STARTPAGE      = 1;

    public function init()
    {
        parent::init();

        $this->view->head1 = 'Bookmarks';

        $bookmarks  = Foomy_Bookmarks_Model_Bookmark_Peer::getList();
        if (self::DEBUG) {
            $this->_logger->log($bookmarks, Zend_Log::DEBUG);
        }

        $curPage = self::STARTPAGE;
        if ($this->getRequest()->isGet()) {
            $curPage = $this->getRequest()->getParam('page');
        }

        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Iterator($bookmarks));
        $paginator->setCurrentPageNumber($curPage);
        $paginator->setDefaultItemCountPerPage(self::ITEMS_PER_PAGE);

        $this->view->paginator = $paginator;
    }

    public function indexAction()
    {
        $this->view->head2 = 'Übersicht';

        $form = new Foomy_Bookmarks_Form_Bookmark();
        $form->setAction($this->view->url() . '/');

        $this->view->form = $form;
    }

    public function editAction()
    {

        if ( $this->getRequest()->isXmlHttpRequest() ) {
            $bookmarkId = $this->getRequest()->getParam('bmid');

            $error = false;

            if ($bookmark = Foomy_Bookmarks_Model_Bookmark_Peer::getById($bookmarkId) !== null) {
                
            } else {
                $error = true;
            }

            echo json_encode(array(
                'error'  => $error,
            ));

        } else {
            // Ajax-Handler direkt aufrufen is nich!
            header('HTTP/1.1 404 Not Found');
        }
    }

    public function deleteAction()
    {
        if ( $this->getRequest()->isXmlHttpRequest() ) {
            $bookmarkId = $this->getRequest()->getParam('bookmarkId');

            $error = false;

            if ($bookmark = Foomy_Bookmarks_Model_Bookmark_Peer::getById($bookmarkId) !== null) {
//                $bookmark->delete();
//                unset($bookmark);
            } else {
                $error = true;
            }

            echo json_encode(array(
                'error'  => $error
            ));

        } else {
            // Ajax-Handler direkt aufrufen is nich!
            header('HTTP/1.1 404 Not Found');
            fb('Nicht per AJaX aufgerufen');
        }

        exit;
    }
}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
