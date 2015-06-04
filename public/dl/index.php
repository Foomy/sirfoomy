<?php

function nf($number, $decimal=0) {
	if (strpos($number,',')!==false) {
		$number = str_replace('.','',$number);  /* 1.999,99 -> 1999,99 */
		$number = str_replace(',','.',$number);  /* 1999,99 -> 1999.99 */
	}
	return number_format($number,$decimal,',','.');
}

function formatSize($size)
{
	$ret = array();

	if ($size >= 1073741824) {
		$ret['size'] = $size/1073741824;
		$ret['unit'] = 'GB';
	}
	elseif ($size >= 1048576) {
		$ret['size'] = $size/1048576;
	}
	elseif ($size >= 1024) {
		$ret['size'] = $size/1024;
		$ret['unit'] = 'KB';
	}

	return nf($ret['size'], 2) . ' ' . $ret['unit'];
}

$filesBlacklist = array(
	'.',
	'..',
	'.htaccess',
);

$fileExtBlacklist = array(
	'php',
	'html',
	'swp'
);

$pathinfo = pathinfo(__FILE__);
$dir = dir($pathinfo['dirname']);

$fileCount = 0;
while (false !== ($entry = $dir->read())) {
	$pi = pathinfo($entry);
	$ext = $pi['extension'];
	if ((! in_array($ext, $fileExtBlacklist)) && (! in_array($entry, $filesBlacklist))) {
		echo $entry . "\t(" . formatSize(filesize($entry)) . ')';
		echo '&nbsp; <a href="' . $entry . '">herunterladen</a><br>';
		$fileCount++;
	}
}

if ($fileCount > 0) {
	echo "\n<br>\nEs wurden $fileCount Dateien gefunden.";
}
else {
	echo "\n<br>\nEs sind aktuell keine Dateien im Download-Verzeichnis.";
}
