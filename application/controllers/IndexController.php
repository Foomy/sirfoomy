<?php
class IndexController extends Zend_Controller_Action
{
	public function init ()
	{
	}

	public function indexAction ()
	{
		$this->view->layout = 'onecol';
	}

	public function jokeAction()
	{
		$this->view->layout = 'onecol';
	}

	public function riddleAction()
	{
		$this->view->layout = 'onecol';
	}

	public function impressAction()
	{
	}

    public function wimipAction()
    {
        $blacklist = array(
            '62.159.31.243'
        );

        $remoteIp = $_SERVER['REMOTE_ADDR'];
        $this->view->remoteIp = $remoteIp;

        if (! in_array($remoteIp, $blacklist)) {
            $file = realpath(APPLICATION_PATH . '/../wimip') . '/addresses.txt';
            $fh = fopen($file, 'a+');
            fwrite($fh, "$remoteIp\n");
            fclose($fh);
        }
    }
}
