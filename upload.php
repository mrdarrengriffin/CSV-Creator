<?php require 'init.php'; ?>
<div class="container">
	<?php require 'parts/header.php'; ?>		
	<form action="uploadDo.php" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>Select Data File</label>
			<input type="file" name="inputFile" id="inputFile">
		</div>
		<div class="form-group">
			<label>Select Item</label>
			<select class="form-control" name="itemName">
				<?php foreach($ih->getAllItems() as $item){ ?>
				<?php $selected = ""; ?>
				<?php if($item['itemname'] == $_GET['item']){$selected = "selected";} ?>
					<option value="<?php echo $item['itemname'] ?>" <?php echo $selected ?>><?php echo $item['name']; ?></option>
				<?php } ?>
			</select>
		</div>
		<input class="btn btn-success" type="submit" name="upload" value="Upload">
		<input class="btn btn-default" type="submit" name="uploadAndPrepare" value="Upload & Prepare">
	</form>
	<?php require 'parts/footer.php'; ?>
</div>