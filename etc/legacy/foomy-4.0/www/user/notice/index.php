<?php
/** foomy.net
 * 		index.php
 *	
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    20.10.2008 - file created
 *
 *  (c) 2004-2008 by Sascha Schneider
 */

require_once('common.inc.php');
FoomyUser::UsersOnly();

$dbh = getDbInstance();

$nf = new Form('noticeform', '', 'post');
$nf->AddElement('notice',
                array('type'     => 'textarea',
                      'label'    => j('Notiz').':',
                      'cols'     => '',
                      'rows'     => '',
                      'required' => true                      
                     )
               );

if ( count($_POST)>0 ) {
	$nf->Validate();
  
  if ( $nf->IsValid() ) {
  	$sql = 'INSERT INTO notice (user_id, text) VALUES (:1, :2)';
    try {
    	$dbh->prepare($sql)->execute($_SESSION['user']->Id(), $nf->GetValue('notice'));
    } catch (MysqlException $e) {
    	panic($e);
    }
  }
}

$sql = 'SELECT id, created, modified, text
          FROM notice
         WHERE user_id=:1';
try {
	$dbret = $dbh->prepare($sql)->execute($_SESSION['user']->Id())->fetchall_assoc();
} catch (MysqlException $e) {
	panic($e);
}

if ( isArray($dbret) ) {
	$OUT['notices'] = $dbret;
}

$OUT['nf'] = $nf;
output();

?>