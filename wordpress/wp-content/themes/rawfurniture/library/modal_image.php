<?php

$img = $_GET['i'];

?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Remote file for Bootstrap Modal</title>  
</head>
<body>
  <div class="modal-dialog modal-full">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel">Modal title</h4>
		</div>
		<div class="modal-body" style="background-image:url('<?=$img?>');">
		</div>
	</div>
</div>
</body>
</html>