<?php

class BastelController extends Foomy_Base_Controller 
{
    public function init() {
        parent::init();

        $this->view->headLink()->appendStylesheet('/css/bastel/bastelstube.css.php');
        $this->view->head1 = 'Bastelstube';
    }

    public function indexAction()
    {
        $this->view->head2 = 'Übersicht';
    }

    public function paginatorAction()
    {
        $this->view->head2 = 'Zend_Paginator';

        $beitraege = array(
            0 => array(
                'URL'          => 'http://magnus.de/testbeitrag1.html',
                'Dachzeile'    => 'Ich bin eine normale Dachzeile',
                'Ueberschrift' => 'Überschrift des ersten Beitrags',
                'Rubrik'       => 'Wirtschaft',
                'Zeit'         => '15:20'
            ),
            1 => array(
                'URL'          => 'http://magnus.de/testbeitrag2.html',
                'Dachzeile'    => 'Ich bin eine normale Dachzeile',
                'Ueberschrift' => 'Beitrag 2: Ich bin die Überschrift',
                'Rubrik'       => 'Politik',
                'Zeit'         => '15:17'
            ),
            2 => array(
                'URL'          => 'http://magnus.de/testbeitrag3.html',
                'Dachzeile'    => 'Ich bin eine normale Dachzeile',
                'Ueberschrift' => 'Ich bin die Überschift von Beitrag 3',
                'Rubrik'       => 'Kultur',
                'Zeit'         => '15:14'
            ),
            3 => array(
                'URL'          => 'http://magnus.de/testbeitrag4.html',
                'Dachzeile'    => 'Ich bin eine normale Dachzeile',
                'Ueberschrift' => 'Beitrag 4 hat auch eine Überschrift',
                'Rubrik'       => 'Wirtschaft',
                'Zeit'         => '15:05'
            ),
            4 => array(
                'URL'          => 'http://magnus.de/testbeitrag5.html',
                'Dachzeile'    => 'Ich bin eine normale Dachzeile',
                'Ueberschrift' => 'Ich bin die von Beitrag 5',
                'Rubrik'       => 'Wirtschaft',
                'Zeit'         => '15:20'
            ),
            5 => array(
                'URL'          => 'http://magnus.de/testbeitrag6.html',
                'Dachzeile'    => 'Ich bin eine normale Dachzeile',
                'Ueberschrift' => 'Ich bin die Überschrift von Beitrag 6',
                'Rubrik'       => 'Politik',
                'Zeit'         => '15:17'
            ),
            6 => array(
                'URL'          => 'http://magnus.de/testbeitrag7.html',
                'Dachzeile'    => 'Ich bin eine normale Dachzeile',
                'Ueberschrift' => 'Von Beitrag 7 bin ich die Überschrift',
                'Rubrik'       => 'Kultur',
                'Zeit'         => '15:14'
            ),
            7 => array(
                'URL'          => 'http://magnus.de/testbeitrag8.html',
                'Dachzeile'    => 'Ich bin eine normale Dachzeile',
                'Ueberschrift' => 'Überschrift, Beitrag 8',
                'Rubrik'       => 'Wirtschaft',
                'Zeit'         => '15:05'
            ),
            8 => array(
                'URL'          => 'http://magnus.de/testbeitrag5.html',
                'Dachzeile'    => 'Ich bin eine normale Dachzeile',
                'Ueberschrift' => 'Auch Beitrag 9 hat eine Überschrift',
                'Rubrik'       => 'Wirtschaft',
                'Zeit'         => '15:20'
            ),
            9 => array(
                'URL'          => 'http://magnus.de/testbeitrag6.html',
                'Dachzeile'    => 'Ich bin eine normale Dachzeile',
                'Ueberschrift' => 'Beitrag 10 hat sowieso eine Überschrift',
                'Rubrik'       => 'Politik',
                'Zeit'         => '15:17'
            ),
            10 => array(
                'URL'          => 'http://magnus.de/testbeitrag7.html',
                'Dachzeile'    => 'Ich bin eine normale Dachzeile',
                'Ueberschrift' => 'Überschrift von Beitrag 11',
                'Rubrik'       => 'Kultur',
                'Zeit'         => '15:14'
            ),
            11 => array(
                'URL'          => 'http://magnus.de/testbeitrag8.html',
                'Dachzeile'    => 'Ich bin eine normale Dachzeile',
                'Ueberschrift' => 'Des 12. Beitrags Überschrift',
                'Rubrik'       => 'Wirtschaft',
                'Zeit'         => '15:05'
            ),
        );

        $curPage = 1;
        if ( $this->getRequest()->isGet() ) {
            $curPage = $this->getRequest()->getParam('page');
        }
        $itemsPerPage = 5;

        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($beitraege));
        $paginator->setCurrentPageNumber($curPage);
        $paginator->setDefaultItemCountPerPage($itemsPerPage);
        $this->view->paginator = $paginator;
    }// paginatorAction()
 
    public function validationsAction()
    {
        $this->view->head2 = 'HTML Validierungstests';
    }

    public function niceCheckboxesAction()
    {
        $this->view->head2 = 'Schicke Checkboxen';
    }

    public function ownViewHelperAction()
    {
        $this->view->head2 = 'Eigene View Helfer';
    }

    public function lermoosBilderAction()
    {
        $this->view->head2 = 'Auswahl der Bilder aus Lermoos';
        $this->view->path  = '/img/lermoos-oestereich/';
        $this->view->pics  = array(
            'P2075809',
            'P2075818',
            'P2075827',
            'P2075865',
            'P2075873',
            'P2075876',
            'P2075910',
            'P2075914',
            'P2075922',
        );
    }

}
