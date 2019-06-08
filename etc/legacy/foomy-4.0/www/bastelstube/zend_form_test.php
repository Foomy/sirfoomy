<?php
/**
 * zend_form_test.php, foomy.net-test
 * 26.10.2009
 *  
 * @author Sascha Schneider <foomy.code@arcor.de>
 * @copyright (c) 2009 by Sascha Schneider
 */

require_once('common.inc.php');
require_once('Zend/Form.php');

$f = new Zend_Form;
$f->setAction('/bastelstube/zend_form_test.php')->setMethod('post');
$f->setAttrib('id', 'login');

$f->addElement('text', 'username');
$f->addElement('password', 'passwort');


$OUT['f'] = $f;
output();

?>