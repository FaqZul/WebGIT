<?php
require 'config.php';
error_reporting(-1);
ini_set('display_errors', 1);
require 'vendor/autoload.php';
use TQ\Git\Repository\Repository;
try {
	$git = Repository::open(GIT, '/usr/bin/git');
} catch (Exception $e) { exit($e->getMessage() . PHP_EOL); }
function revList($hash, $limit = 2) {
	$a = shell_exec('/usr/bin/git -C ' . GIT . ' rev-list -' . $limit . ' ' . $hash);
	$b = explode(PHP_EOL, $a);
	unset($b[count($b) - 1]);
	return $b;
}
function showCommitFiles($hash) {
	$a = shell_exec('/usr/bin/git -C ' . GIT . ' show --pretty="format:" --name-status ' . $hash);
	$b = explode(PHP_EOL, $a);
	unset($b[count($b) - 1]);
	return $b;
}
