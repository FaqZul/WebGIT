<?php
require 'git.php';
$a = $_GET['hash'];
$b = base64_decode($_GET['path']);
$c = $_GET['prev'];
$d = $git->showFile($b, $c);
$e = $git->showFile($b, $a);
header('Content-Type: application/json');
echo json_encode(array('hash' => $e, 'prev' => $d));