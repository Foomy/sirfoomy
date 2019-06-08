<?php

/*

mysql> desc manoword;
+----------+------------------+------+-----+---------------------+-------+
| Field    | Type             | Null | Key | Default             | Extra |
+----------+------------------+------+-----+---------------------+-------+
| word     | varchar(255)     | NO   | PRI |                     |       |
| counter  | int(10) unsigned | NO   |     | 1                   |       |
| created  | timestamp        | NO   |     | CURRENT_TIMESTAMP   |       |
| modified | timestamp        | NO   |     | 0000-00-00 00:00:00 |       |
+----------+------------------+------+-----+---------------------+-------+

*/

require_once('common.inc.php');

$scraped_file = '';
if ( count($_POST)>0 ) {
  $fp = './lyrics/';
  $fn = getVar('filename');
  if ( hasValue($fn) ) {
    $lines = file($fp.$fn);
    $lines = cleanArray($lines);
    foreach ($lines as $line) {
      $words = explode(' ', trim($line));
      foreach ($words as $word) {
        $word = strtolower($word);
        $sql = 'INSERT INTO manoword (word) VALUES (:1)';
        try {
          Common::$dbh->prepare($sql)->execute($word);
        } catch (MysqlException $e) {
          if ( $e->getCode()==1062 ) {
            $sql = 'UPDATE manoword SET counter=counter+1 WHERE word=:1';
            try {
              Common::$dbh->prepare($sql)->execute($word);
            } catch (MysqlException $e) {
              panic($e);
            }
          } else {
            panic($e);
          }
        }
      }
    }
  }
  $scraped_file = $fp.$fn; 
}


$OUT['scraped_file'] = $scraped_file;
output();

?>
