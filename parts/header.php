<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/custom.css">
<?php if($flash->willShow()){ ?>
	<div class="alert alert-<?php echo $flash->get()['type'] ?>"><?php echo $flash->get()['message'] ?></div>
<?php } ?>


<a href="items.php" class="btn btn-default">View All Items</a>
<a href="itemCreate.php" class="btn btn-default">Create New Item</a>
<a href="upload.php" class="btn btn-default">Upload Data File</a>
<hr>