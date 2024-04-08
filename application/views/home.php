<?php include('include_config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Notepad</title>
	<?php include('include_metadata.php'); ?>
	<style>
		body {
			overflow: hidden;
		}
		
	</style>
</head>

<body>
	<?php include('include_nav.php'); ?>
	<!-- Add the vertical line div here -->
	<div class="vertical-line bg-light"></div>
	<!-- side-bar button -->
	<div class="sidebar btn-group-vertical">
		<button type="button" class="btn btn-light" style="margin-left: 1rem;" onclick="showCreateNoteForm()">Create Note</button>
	</div>
	<!-- side-bar button end -->
	<!-- New Note form start -->
	<div id="createNoteForm" class="container float-right bg-light rounded" style="margin-right: 1rem; display: none;">
		<button type="button" class="close close-button" aria-label="Close" onclick="hideCreateNoteForm()">
			<span aria-hidden="true">&times;</span>
		</button>
		<form action="<?php if(isset($row) && !empty($row)){ }else{ echo base_url('index.php/Home/create_note');} ?>" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" class="form-control" id="title" name="title" value="<?php set_value('title',$row[0]->mnd_note_title);?>">
			</div>
			<div class="form-group">
				<label for="note_icon">Set Image</label>
				<input type="file" class="form-control" id="note_icon" name="note_icon" >
			</div>
			<div class="form-group">
				<label for="note">Note</label>
				<textarea class="form-control" id="note" name="note" rows="5" value="<?php set_value('title',$row[0]->mnd_note_details);?>" required></textarea>
			</div>
			<button type="button" class="btn btn-danger btn-sm" id="closeNoteForm" onclick="hideCreateNoteForm()">Close Without Saving</button>
			<button type="submit" class="btn btn-success btn-sm float-right" name="creatnote" value="creatnote">Save Note</button>
		</form>
	</div>
	<!-- New Note form end -->
	<!-- Notes - list start -->
	<div class="container float-right bg-light rounded " style="margin-right: 1rem; height: 85vh; overflow-y: auto;">

		<!-- <?php if ($this->session->flashdata('success')) { ?>
			<p style="color:green; margin:auto;"><?php echo $this->session->flashdata('success'); ?></p>
		<?php } else { ?>
			<p style="color:red; margin:auto;"><?php echo $this->session->flashdata('error'); ?></p>
		<?php } ?> -->

		<?php foreach ($result as $note) { ?>
			<div class="card border-dark mb-3" style="width: 65rem; margin: 1rem; ">
				<div class="card-header bg-transparent border-dark">
					<b>Last-Modified: </b><span id="bin" ></span>
					<label class="text-primary">
						<?php
						$time = strtotime($note['mnd_modify_date']);
						$formattedTime = date('g:i A', $time);
						echo (custom_timespan($note['mnd_modify_date'])) . " - " . $formattedTime;
						// echo custom_timespan($note['mnd_modify_date']).- $formattedTime;
						?>
					</label>
				</div>
				<div class="card-body text-dark">
					<div class="icon-box">
						<img class="icon" src="<?php if($note['mnd_noteimg']){ echo base_url('Uploads/').$note['mnd_noteimg'];}else{ echo base_url('assets/images/profile.png');} ?>">
						<h5 class="note_title"><?php echo $note['mnd_note_title']; ?></h5>
					</div>
					<p class="card-text"><?php echo $note['mnd_note_details']; ?></p>
				</div>
				<div class="card-footer bg-transparent border-dark ">
					<a type="button" class="btn btn-info btn-sm float-right" style="margin-left: 1rem;"  href="<?php echo base_url('index.php/Home/edit_note/') . $note['mnd_id']; ?>">Edit Note</a>
					<a class="btn btn-danger btn-sm float-right" style="margin-left: 1rem;" href="<?php echo base_url('index.php/Delete_Note/delete_note/') . $note['mnd_id']; ?>">Delete Note</a>
				</div>
			</div>
		<?php  } ?>
	</div>
	<!-- Note-list end -->
	<!-- partial -->
	<?php include('include_footer.php'); ?>
	<?php include('include_base.php'); ?>
	<script src="<?php echo base_url('assets/javascript/watch.js') ?>" type="text/javascript"></script>

	<script>
		// For create note form function
		function showCreateNoteForm() {
			document.getElementById("createNoteForm").style.display = "block";
		}

		function hideCreateNoteForm() {
			document.getElementById("createNoteForm").style.display = "none";
		}

		// For Edit note form function
		function showEditNoteForm() {
			document.getElementById("createNoteForm").style.display = "block";
		}


		// window.onload = function() {
		// 	var xhr = new XMLHttpRequest();
		// 	xhr.open('GET', '<?= base_url("Home/note_bin"); ?>', true);
		// 	xhr.onreadystatechange = function() {
		// 		if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
		// 			document.getElementById('bin').textContent = JSON.parse(xhr.responseText).some_property;
		// 		}
		// 	};
		// 	xhr.send();
		// };
	</script>
</body>

</html>