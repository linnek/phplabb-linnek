<?php include("header.php");?>

<div class="fileuploads">

<?php

if (hasModeratorAccess() == false){
	header('location:index.php');
}

if(isset($_FILES['upload'])){

	//think about two main things, extensions and size:
	$maxsize = 2000000; //this is 2mb
	$allowed = array('jpg', 'jpeg', 'png', 'gif');
	//make all file extensions lower case and then check
	//want to make FILE.JPEG, only .JPEG
	$ext = strtolower(substr($_FILES['upload']['name'], strpos($_FILES['upload']['name'], '.')+1));

	//take the file name and the file and upload them to the server
	//upload pic to server

	$errors = array();

	//place errors if upload does not work

	if(in_array($ext, $allowed) === false){

		$errors[] = 'THIS IS NOT AN ALLOWED EXTENSION';
	}

	if($_FILES['upload']['size']> $maxsize){
		$errors[] = 'THIS FILE IS TOO BIG';
	}

	if(empty($errors)){
		//if there is no errors we will upload the file

		move_uploaded_file($_FILES['upload']['tmp_name'], "uploads/{$_FILES['upload']['name']}");
		//moves the file to Uploads file
	}
}

?>
	<div class="errors">
	<?php 
		
		if(isset($errors)){
			if(empty($errors)){
				echo "Uploaded!";
			} else{
				foreach($errors as $err){
					echo $err . '<br>';			
				}
			}
		}
	?>
	</div>

		<div class="uploads">
			<form action="" method="post" class="form-inline" enctype="multipart/form-data">

				<label class="" for="username">Choose File</label>
				<input type="file" class="" id="file" name="upload" placeholder="Username">
				<button type="submit" class="" name="upload">Upload</button>

			</form>
		</div>
		<br>
		<p class="text-upload"><i class="" aria-hidden="true"></i>Note: Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 2MB.</p>

</div>

<?php include("footer.php"); ?>