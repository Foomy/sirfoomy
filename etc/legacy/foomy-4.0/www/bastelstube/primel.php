<?php

require_once('common.inc.php');
FoomyUser::RootOnly();

function isPrime($num) {
	$prim = true;
  if ( $num!=2 ) { // 2 ist prim
    if ( $num<2 || $num%2==0 ) {
      /** Nicht prim sind:
       *    - 0 und 1 (per definition)
       *    - gerade zahlen
       */
  	 $prim = false;
    } else {
      //alle anderen müssen durchprobiert werden. (NP-Algorithmus)
      $i = 2; // teiler
      do {
        if ( $num%$i==0 ) $prim = false;
        $i++;
      } while ( ($prim) && ($i<=floor(sqrt($num))) );
    }
  }

	return($prim);
}//primel()



$min = getVar('min');
$max = getVar('max');
if ( ! $min ) $min = 0;
if ( ! $max ) $max = 100;


for ( $i=$min; $i<=$max; $i++ ) {
	if ( isPrime($i) ) $p[] = $i; 
}

$offset = 0; 
$limit = 15;

$primecnt = count($p);
do {
  $primes[] = array_slice($p, $offset, $limit);
  $offset += $limit;
} while( $offset<=$primecnt );


$OUT['min']      = $min;
$OUT['max']      = $max;
$OUT['primes']   = $primes;
$OUT['offset']   = $offset;
$OUT['limit']    = $limit;
$OUT['primecnt'] = $primecnt;

output();
?>