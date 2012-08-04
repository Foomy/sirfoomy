<?php

require_once('common.inc.php');

//Zufallszitat
$q = Quote::GetByRandom();
$OUT['quote'] = $q;

//Status
$OUT['breadcrumb'] = breadcrumb();

//Datum
$z = new Tempus();
$OUT['datum'] = $z->ShortDate();


output();

?>