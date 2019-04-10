<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta content="IE=edge" http-equiv="X-UA-Compatible">
		<meta content="initial-scale=1, width=device-width" name="viewport">
		<title>GIT</title>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div class="container">
			<div class="list-group">
<?php
require 'git.php';
$getLog = $git->getLog();
foreach ($getLog as $glv) {
	$a = explode(PHP_EOL, $glv);
	$commit = substr($a[0], 7);
	$commitAuthor = substr($a[3], 12);
	$commitAuthorName = substr($commitAuthor, 0, strpos($commitAuthor, '<') - 1);
	$commitAuthorMail = substr($commitAuthor, strpos($commitAuthor, '<') + 1, (strlen($commitAuthor) - strlen($commitAuthorName)) - 3);
	$commitDate = substr($a[4], 12);
?>
				<a class="list-group-item" href="commit.php?hash=<?php echo $commit; ?>">
					<span class="badge"><?php echo date('d F Y H:i', strtotime($commitDate)); ?></span>
					<h4 class="list-group-item-heading"><?php echo substr($commit, 0, 8); ?></h4>
					<p class="list-group-item-text"><?php echo trim($a[6]); ?></p>
				</a>
<?php
}
?>
			</div>
		</div>
		<script src="assets/js/jquery-1.12.4.min.js" type="text/javascript"></script>
		<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	</body>
</html>
