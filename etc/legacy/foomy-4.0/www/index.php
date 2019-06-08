<?php

require_once('common.inc.php');

//Zufallszitat
$q = Quote::GetRandom();
$OUT['quote'] = $q;


output();

?>