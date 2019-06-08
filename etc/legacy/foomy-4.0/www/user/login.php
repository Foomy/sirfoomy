<?php
/** foomy.net
 * 		login.php
 *	
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    01.08.2008 - file created
 *
 *  (c) 2004-2008 by Sascha Schneider
 */

require_once('common.inc.php');

$f = new Form('login', '', 'post');
$f->SetReentrant(false);
$f->AddElement('email',
               array('type'   => 'text',
                     'label'  => j('eMail Adresse').':',
                     'minlen' => 1,
                     'xtra'   => 'IsMail'
                    )
              );
$f->AddElement('password',
               array('type'   => 'password',
                     'label'  => j('Passwort').':',
                     'minlen' => 7
                    )
              );

if ( count($_POST)>0 ) {
	if ( $f->Validate() ) {
    $eml = $f->GetValue('email');
    $pwd  = $f->GetValue('password');
		if ( FoomyUser::Login($eml, $pwd) ) {
      if ( isset($_SESSION['request']) ) {
      	header('Location: '.$_SESSION['request']);
      } else {
        header('Location: /user/');
      }
      exit(0);
    } else {
    	$_SESSION['messages'][] = j('eMail-Adresse oder Passwort falsch!');
    }
	}
}

$OUT['f'] = $f;
output();

?>