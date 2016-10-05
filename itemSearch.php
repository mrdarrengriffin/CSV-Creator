<?php require 'init.php'; ?>

<div class="container">
	<?php require 'parts/header.php'; ?>
	<div class="row">
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
			<form action="itemSearch.php" method="get">
				<div class="input-group">
					<input type="text" class="form-control" name="query" placeholder="Search for...">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">Go!</button>
					</span>
				</div><!-- /input-group -->
			</form>
		</div>
	</div>
	<hr>
	
	<?php require 'parts/footer.php'; ?>
</div>

