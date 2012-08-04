<?php
/** foomy.net
 * 		alt.php
 *	
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    23.07.2008 - File created
 *
 *  (c) 2004-2008 by Sascha Schneider
 */

require_once('common.inc.php');
#FoomyUser::RootOnly();

$gebdat = strtotime('1977-07-06 16:20:00');
$alter = time()-$gebdat;
$countdown = 1000000000-$alter;

$tage = floor($countdown/86400);
$rest = $countdown%86400;
$std  = floor($rest/3600);
$rest = $rest%3600;
$min  = floor($rest/60);
$sek  = $rest%60;

$eventtime = date('d.m.Y H:i:s', time()+$countdown);


$OUT['alter']     = number_format($alter, 0, DEC_POINT, THOUSANDS_SEP);
$OUT['age']       = $alter;
$OUT['countdown'] = number_format($countdown, 0, DEC_POINT, THOUSANDS_SEP);
$OUT['cd']        = $countdown;

$OUT['tage'] = $tage;
$OUT['std']  = $std;
$OUT['min']  = $min;
$OUT['sek']  = $sek;

$OUT['eventtime'] = $eventtime;

output();

?>