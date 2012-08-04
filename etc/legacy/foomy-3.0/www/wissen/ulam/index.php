<?php

require_once('common.inc.php');

function maximum($arr) {
 $max = $arr[0];
 $min = $arr[0];
 while ( list(, $v) = each($arr) ) {
  if ( $v>$max ) $max = $v;
  if ( $v<$min ) $min = $v;
 }
 return($max);
}

function minimum($arr) {
 $min = $arr[0];
 while ( list(, $v) = each($arr) ) {
  if ( $v<$min ) $min = $v;
 }
 return($min);
}

$folge = array();
$a = ( isset($_POST['a']) ) ? $_POST['a'] : false;
$startwert = $a;
if ( $a ) {
 while ( $a!=1 ) {
  if ( $a%2==0 ) {
   $a = $a/2; 
  }
  else {
   $a = 3*$a+1;
  }
  array_push($folge, $a);
 }
 $max = maximum($folge);
 $min = minimum($folge);
}

$smarty->assign('formaction', $_SERVER['PHP_SELF']);
$smarty->assign('startwert', $startwert);
$smarty->assign('folge', $folge);
$smarty->assign('minimum', $min);
$smarty->assign('maximum', $max);

_header();
_footer();
$smarty->display('wissen/ulam.tpl');

?>
