<?php require 'init.php'; ?>

<div class="container">
	<?php require 'parts/header.php'; ?>
	<table class="table table-condensed">
		<thead>
			<tr>
				<th>Name</th>
				<th>Item Filename</th>
				<th>Prepared?</th>
				<th>Last Run</th>
				<th>Input File</th>
				<th>Output File</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($ih->getAllItems() as $item){ ?>
				<tr <?php if($_GET['item'] == $item['itemname']){echo 'class="active"';} ?>>
					<td><?php echo $item['name'] ?></td>
					<td><?php echo $item['itemname'] ?></td>
					<td><?php echo ($item['prepared'] == true) ? "Yes" : "No"; ?></td>
					<td><?php echo ($item['run'] == null) ? "Never Run" : date("d/m/Y H:i:s",$item['run']); ?></td>
					<td><?php echo $item['filename'] ?></td>
					<td><?php echo $item['outputFile'] ?><?php if($item['run'] != null){ ?><?php } ?></td>
					<td>
						<a class="btn btn-xs btn-default" href="upload.php?item=<?php echo $item['itemname'] ?>">Upload File</a>
						<?php if($item['filename'] != ""){ ?>
							<a class="btn btn-xs btn-default" href="prepare.php?item=<?php echo $item['itemname'] ?>">Prepare</a>
						<?php } ?>
						<?php if($item['prepared'] == true){ ?>
							<a class="btn btn-xs btn-default" href="run.php?item=<?php echo $item['itemname'] ?>">Run</a>
						<?php } ?>
						<?php if($item['run'] != null){ ?>							
							<a class="btn btn-xs btn-default" href="items/<?php echo $item['outputFile'] ?>" download>Download</a>
						<?php } ?>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<?php require 'parts/footer.php'; ?>
</div>

