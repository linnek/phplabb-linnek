<?php include("header.php");?>

<?php
	if (hasModeratorAccess() == false){
		header('location:index.php');
	}
?>
	<div id="gallery">
		<p>Your Gallery</p>
	
		<div id="galleryimg">
			<?php
				//lista filerna i mappen uploads
				$files = scandir("uploads");

				foreach ($files as $value) {

					if (endsWith($value, ".jpg") || endsWith($value, ".jpeg") || endsWith($value, ".gif") || endsWith($value, ".png")){
						echo '<img src="uploads/'.$value.'">';
					}
				}
			?>
		</div>
</div>

<?php include("footer.php"); ?>