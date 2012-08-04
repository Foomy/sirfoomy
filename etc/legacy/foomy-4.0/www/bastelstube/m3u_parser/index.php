<?php

require_once('common.inc.php');
FoomyUser::RootOnly();


if ( count($_POST)>0 ) {
_post();
_debug($_FILES);
  $path = '/var/www/foomy.net/www/bastelstube/m3u_parser/';
 move_uploaded_file($_FILES['playlist_file'], $path);

  #phpinfo();
  exit(0);
}

output();

?>