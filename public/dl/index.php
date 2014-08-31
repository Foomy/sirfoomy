<?php

$filesBlacklist = array(
	'.',
	'..',
	'.htaccess',
	'index.php',
	'index.html',
);

$pathinfo = pathinfo(__FILE__);
$dir = dir($pathinfo['dirname']);

$fileCount = 0;
while (false !== ($entry = $dir->read())) {
	if (! in_array($entry, $filesBlacklist)) {
		echo $entry . "\t(" . filesize($entry) . ' Bytes)<br>';
		$fileCount++;
	}
}

if ($fileCount > 0) {
	echo "\n\nEs wurden $fileCount Dateien gefunden.";
}
else {
	echo "\n\nEs sind aktuell keine Dateien im Download-Verzeichnis.";
}