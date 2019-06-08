<?php
/** foomy.net
 * 		/admin/quotes/index.php
 *	
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    28.06.2008 - file created
 *                 delete functionality implemented
 *    01.08.2008 - insert functionality implemented
 *                 edit functionality implemented
 *
 *  (c) 2004-2008 by Sascha Schneider
 */

require_once('common.inc.php');
FoomyUser::AdminsOnly();

/*
$quote_id = (int)getVar('quote_id');
if ( $quote_id>0 ) {
	$q = Quote::GetById($quote_id); 
}
*/

$f = new Form('addquote', '', 'post');
$f->AddElement('quote_id',
               array('type'  => 'hidden',
                     'value' => ( isObject($q) ) ? $q->Id() : ''
                    )
              );
$f->AddElement('quotetext',
               array('type'  => 'textarea',
                     'label' => j('Zitat').':',
                     'value' => ( isObject($q) ) ? $q->Text() : ''
                    )
              );
$f->AddElement('author',
               array('type'  => 'text',
                     'label' => j('Autor').':',
                     'value' => ( isObject($q) ) ? $q->Author() : ''
                    )
              );
$f->AddElement('extra',
               array('type'  => 'text',
                     'label' => j('Extra').':',
                     'value' => ( isObject($q) ) ? $q->Extra() : ''
                    )
              );


if ( count($_POST)>0 ) {
  $f->Validate();
  
	if ( $f->IsValid() ) {
    if ( (int)$f->GetValue('id')>0 ) {
    	$q = Quote::GetById();
    } else {
		  $q = new Quote();
    }

    $q->Text($f->GetValue('quotetext'));
    $q->Author($f->GetValue('author'));
    $q->Extra($f->GetValue('extra'));
    $q->Save();

    $f->SetValue('quotetext', '');
    $f->SetValue('author', '');
    $f->SetValue('extra', '');
	}
}

/**
 * ToDo: So wird die Zitatliste immer aus der Db gelesen.
 *       Überdenken!
 */
$quote = new Quote();
$OUT['quotelist'] = $quote->GetQuoteList();

$OUT['f'] = $f;

output();
?>