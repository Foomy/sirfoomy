<?php
/** foomy.net
 * 		/admin/groups/index.php
 *	
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    04.10.2008 - file created
 *
 *  (c) 2004-2008 by Sascha Schneider
 */

require_once('common.inc.php');
FoomyUser::RootOnly();

$group_id = getVar('group_id');
if ( (int)$group_id>0 ) {
	$grp = Group::GetById($group_id);
}

$gf = new Form('groupform', '', 'post');
$gf->AddElement('quote_id',
                array('type'  => 'hidden',
                      'value' => ( isObject($grp) ) ? $grp->GetId() : 0
                     )
               );
$gf->AddElement('name',
                array('type'     => 'text',
                      'label'    => j('Gruppenname').':',
                      'minlen'   => 3,
                      'required' => true,
                      'value'    => ( isObject($grp) ) ? $grp->Name() : ''
                     )
               );
$gf->AddElement('description',
                array('type'   => 'textarea',
                      'label'  => j('Beschreibung').':',
                      'cols'   => 0,
                      'rows'   => 0,
                      'minlen' => 3,
                      'value'  => ( isObject($grp) ) ? $grp->Description() : ''
                     )
               );

$OUT['gf'] = $gf;
output();

?>