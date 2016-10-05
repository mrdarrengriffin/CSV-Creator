<?php require 'init.php'; ?>
<div class="container">
	<?php require 'parts/header.php'; ?>
	<form action="itemCreateDo.php" method="post">
		<div class="form-group">
			<label>Item Name</label>
			<input type="text" class="form-control" name="itemName">
		</div>
		<input type="submit" class="btn btn-default" name="saveOnly" value="Create Item">
		<input type="submit" class="btn btn-default" name="saveAndUpload" value="Create and Upload">
	</form>
	<?php require 'parts/footer.php'; ?>
</div>