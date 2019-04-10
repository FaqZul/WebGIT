<?php
require 'git.php';
$getLog = $git->getLog();
$logs = array();
foreach ($getLog as $glv) {
	$a = explode(PHP_EOL, $glv);
	$commit = substr($a[0], 7);
	$commitAuthor = substr($a[3], 12);
	$commitAuthorName = substr($commitAuthor, 0, strpos($commitAuthor, '<') - 1);
	$commitAuthorMail = substr($commitAuthor, strpos($commitAuthor, '<') + 1, (strlen($commitAuthor) - strlen($commitAuthorName)) - 3);
	$commitDate = substr($a[4], 12);
	array_push($logs, array(
		'H' => $commit,
		'ca' => $commitAuthorName,
		'ce' => $commitAuthorMail,
		'cD' => $commitDate,
		's' => trim($a[6])));
}
