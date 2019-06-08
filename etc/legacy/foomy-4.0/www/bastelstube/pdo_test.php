<?php

require_once('common.inc.php');
FoomyUser::RootOnly();

try {
 $db = new PDO('mysql:host=localhost;dbname=foomy;', $usr, $pwd);
}
catch (PDOException $e) {
 echo 'Error: '.$e->getMessage().'<br/>';
 die();
}
?>