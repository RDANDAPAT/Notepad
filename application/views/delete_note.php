<?php include('include_config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Notepad</title>
	<?php include('include_metadata.php'); ?>
	<style>

	</style>
</head>

<body>
	<?php include('include_nav.php'); ?>
	<div class="vertical-line bg-light"></div> <!-- Add the vertical line div here -->
	<!-- side-bar button -->
	<!-- <div class="sidebar btn-group-vertical">
		<button type="button" class="btn btn-light" style="margin-left: 1rem;" onclick="showCreateNoteForm()"> Note</button>
	</div> -->
	<!-- side-bar button end -->
	<div class="container float-right bg-light rounded" style="margin-right: 1rem;">

		

		<?php foreach ($result as $note) { ?>
			<div class="card border-dark mb-3" style="width: 65rem; margin: 1rem; ">
				<div class="card-header bg-transparent border-dark">
					<b>Move to Bin by: </b>
					<label class="text-primary">
						<?php /*echo  htmlentities ($note -> mnd_modify_date ); or*/
						$time = strtotime($note['mnd_modify_date']);
						$formattedTime = date('g:i A', $time);
						echo (custom_timespan($note['mnd_modify_date']))." - ".$formattedTime ?>
					</label>
				</div>
				<div class="card-body text-dark">
					<h5 class="card-title"><?php echo $note['mnd_note_title']; ?></h5>
					<p class="card-text"><?php echo $note['mnd_note_details']; ?></p>
				</div>
				<div class="card-footer bg-transparent border-dark ">
					<button type="button" class="btn btn-info btn-sm float-right" style="margin-left: 1rem;">Restore</button>
					<a class="btn btn-danger btn-sm float-right" style="margin-left: 1rem;" href="<?php echo base_url('index.php/Delete_Note/delete_permanently/') . $note['mnd_id']; ?>">Delete Note Parmanently</a>
				</div>
			</div>
		<?php  } ?>
	</div>
	<!-- Note-list end -->
	<!-- partial -->
	<?php include('include_footer.php'); ?>
	<?php include('include_base.php'); ?>

	<script>
		function showCreateNoteForm() {
			document.getElementById("createNoteForm").style.display = "block";
		}

		function hideCreateNoteForm() {
			document.getElementById("createNoteForm").style.display = "none";
		}

		// function submitCreateNoteForm() {
		// 	// Optional: Perform any additional validation or processing before submitting the form
		// 	document.getElementById("createNoteForm").submit();
		// }
	</script>
</body>

</html>