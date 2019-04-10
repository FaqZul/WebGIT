<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta content="IE=edge" http-equiv="X-UA-Compatible">
		<meta content="initial-scale=1, width=device-width" name="viewport">
		<title>GIT</title>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/diffview.css" rel="stylesheet" type="text/css" />
		<style type="text/css">
			 textarea {
				height: 320px;
				overflow: auto;
				white-space: pre;
			} 
		</style>
	</head>
	<body>
		<div class="container">
			<div aria-multiselectable="true" class="panel-group" id="accordion" role="tablist">
<?php
require 'git.php';
$a = showCommitFiles($_GET['hash']);
$aa = revList($_GET['hash']);
foreach ($a as $b) {
	$c = explode("\t", $b);
	$d = md5($c[1]);
	$e = ($c[0] === 'C') ? 'panel-success': (($c[0] === 'D') ? 'panel-danger': (($c[0] === 'M') ? 'panel-warning': 'panel-default'));
?>
				<div class="panel <?php echo $e; ?>">
					<div class="panel-heading" id="<?php echo 'heading' . $d; ?>" role="tab">
						<h4 class="panel-title">
							<a aria-controls="<?php echo 'collapse' . $d; ?>" aria-expanded="false" data-parent="#accordion" data-toggle="collapse" href="#<?php echo 'collapse' . $d; ?>" role="button"><?php echo $c[1]; ?></a>
						</h4>
					</div>
					<div aria-labelledby="<?php echo 'heading' . $d; ?>" class="panel-collapse collapse" data-hash="<?php echo $aa[0]; ?>" data-path="<?php echo base64_encode($c[1]); ?>" data-prev="<?php echo (isset($aa[1])) ? $aa[1]: $aa[0]; ?>" id="<?php echo 'collapse' . $d; ?>" role="tabpanel">
						<div class="panel-body">
							<div class="row">
								<div class="col-xs-12">
									<div id="<?php echo base64_encode($c[1]); ?>"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php
}
?>
			</div>
		</div>
		<script src="assets/js/jquery-1.12.4.min.js" type="text/javascript"></script>
		<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="assets/js/diffview.js" type="text/javascript"></script>
		<script src="assets/js/difflib.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('.collapse').on('shown.bs.collapse', function() {
					let a = '#' + $(this).attr('id');
					let ndiff = $(a).attr('data-path');
					let nhash = $(a).attr('data-hash');
					let nprev = $(a).attr('data-prev');
					let thash = $(a + ' .text-hash');
					let tprev = $(a + ' .text-prev');
					// if ($('#' + ndiff).html() === '') {
						$.get('file.php', { hash: nhash, path: ndiff, prev: nprev }, function(b) {
							let diffbase = difflib.stringAsLines(b.prev);
							let diffnew = difflib.stringAsLines(b.hash);
							let dlsm = new difflib.SequenceMatcher(diffbase, diffnew);
							let opcodes = dlsm.get_opcodes();
							let diffoutput = document.getElementById(ndiff);
							diffoutput.innerHTML = '';
							diffoutput.appendChild(diffview.buildView({
								baseTextLines: diffbase,
								baseTextName: nprev,
								contextSize: null,
								newTextLines: diffnew,
								newTextName: nhash,
								opcodes: opcodes,
								viewType: 0 }));
						});
					// }
				});
			});
		</script>
	</body>
</html>
