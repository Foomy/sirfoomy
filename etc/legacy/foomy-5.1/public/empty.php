<?php

$array = array(
    'key 1' => 'value 1' , 
    'key 3' => 'value 3'
);

if (empty($array['key 2'])) {
    echo 'is leer';
} else {
    echo 'is nich leer';
}

phpinfo();
