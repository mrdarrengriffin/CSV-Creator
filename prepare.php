<?php
	
	require 'init.php';
	
	$ih->loadItem($_GET['item']);
	$data = $ih->getData();
	$csv->parse(FILE_PATH.$data['filename']);
	$prep->setCSVData($csv->data);
	
	$rows = count($csv->data);
	
	$head = $prep->getHeadersWithFirstRow();
	$firstRowData = $prep->getFirstRow();
	
	$drc = $ih->getImportDataRows()['core'];
	$features = $ih->getData()['importRows']['features'];
	
?>
<div class="container">
	<?php require 'parts/header.php'; ?>
	<form action="prepareSave.php" class="form" method="post">
		<div class="row">
			<div class="col-md-5">
				<h3>Core</h3>
				<hr>
				<div class="form-group">
					<label>Unit Make</label>
					<input class="form-control updatePreview" type="text" id="make" name="data[make]" value="<?php echo $drc['make'] ?>"> 
				</div>
				<div class="form-group">
					<label>Unit Model</label>
					<select class="form-control updatePreview" id="model" name="data[model]"><?php echo $htmlhelper->formatOptions($head,$drc['model']); ?></select>
				</div>
				<div class="form-group">
					<label>Unit Type</label>
					<select class="form-control updatePreview" id="type" name="data[type]"><?php echo $htmlhelper->formatOptions($head,$drc['type']); ?></select>
				</div>
				<div class="form-group">
					<label>Image Library</label>
					<input class="form-control updatePreview" id="imageLibrary" type="text" name="data[imageLibrary]" value="<?php echo $drc['imageLibrary'] ?>">
				</div>
				<div class="form-group">
					<label>Unit Image Filename</label>
					<select class="form-control updatePreview" id="imageFilename" name="data[imageFilename]"><?php echo $htmlhelper->formatOptions($head,$drc['imageFilename']); ?></select>
				</div>
				<div class="form-group">
					<label>Sales Description</label>
					<select class="form-control" id="salesDescription" name="data[salesDescription]"><?php echo $htmlhelper->formatOptions($head,$drc['salesDescription']); ?></select>
				</div>
				<div class="form-group">
					<label>Width</label>
					<select class="form-control updatePreview" id="width" name="data[width]"><?php echo $htmlhelper->formatOptions($head,$drc['width']); ?></select>
				</div>
				<div class="form-group">
					<label>Depth</label>
					<select class="form-control updatePreview" id="depth" name="data[depth]"><?php echo $htmlhelper->formatOptions($head,$drc['depth']); ?></select>
				</div>
				<div class="form-group">
					<label>Height</label>
					<select class="form-control updatePreview" id="height" name="data[height]"><?php echo $htmlhelper->formatOptions($head,$drc['height']); ?></select>
				</div>
				<div class="form-group">
					<label>Nett Buying Price</label>
					<select class="form-control updatePreview" id="nettPrice" name="data[nettPrice]"><?php echo $htmlhelper->formatOptions($head,$drc['nettPrice']); ?></select>
				</div>
				<div class="form-group">
					<label>Price Increase Percentage</label>
					<input class="form-control updatePreview" id="priceIncrease" type="text" name="data[priceIncrease]" value="<?php echo $drc['priceIncrease'] ?: '18' ?>">
				</div>
				<div class="form-group">
					<label>Shop Manufacturer ID</label>
					<select class="form-control" id="manufacturerId" name="data[manufacturerId]"><?php echo $htmlhelper->formatManufacturers($api->getManufacturers(),$drc['manufacturerId']); ?></select>
				</div>
				<hr>
				<h4>Item Preview</h4>
				<div id="itemPreview"></div>
				
			</div>
			<div class="col-md-7">
				<h3>Features</h3>
				<hr>
				<div class="row">
					<div class="col-md-12 text-right">
						<input class="btn btn-default" type="button" onclick="features.addFeature()" value="Add New Feature">
						<input class="btn btn-default" type="button" onclick="features.removeLastFeature()" value="Remove Last Feature">
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div id="features"></div>
					</div>
				</div>
			</div>
		</div>
		<hr>
		The data file associated to this item has <?php echo $rows ?> rows.
		<input class="form-control" type="hidden" name="item" value="<?php echo $_GET['item'] ?>">
	<input class="btn btn-success pull-right" type="submit" name="save" value="Save Item">
	<input class="btn btn-success pull-right" type="submit" name="saveAndRun" value="Save Item & Run">
	
	
	</form>
	<?php require 'parts/footer.php'; ?>
	</div>
	<script>
	features.init("#features","#itemPreview");
	features.setFirstRowData('<?php echo addslashes(json_encode($firstRowData)); ?>');
	features.setSelectBoxHTML('<?php echo $htmlhelper->formatOptions($head) ?>');
	features.setRowHeaders('<?php echo json_encode($prep->getHeaders()) ?>');
	<?php foreach($features as $featureName=>$featureValue){ ?>
	features.addFeature('<?php echo $featureName ?>','<?php echo stripslashes($featureValue) ?>');
	<?php } ?>
	features.updateItemPreview();
	$(".updatePreview").focusout(function(){
	features.updateItemPreview();
	});
	$("#features").sortable({handle:'.handle'});
	</script>		