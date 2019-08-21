<?php include("header.php"); ?>

<form action="" method="post" id="contact">
	<input type="text" name="name" placeholder="Name"><br>
	<input type="email" name="email" placeholder="Email"><br>
	<textarea name="subject" placeholder="Write your message here"></textarea>
	<input type="submit" class="btn" value="Send">
</form>

<?php

if (isset($_POST) && !empty($_POST)){
	$email = trim($_POST['email']);
	$email = htmlentities($email);
	$name = trim($_POST['name']);
	$name = htmlentities($name);
	$text = $_POST['subject'];
	$text = htmlentities($text);
}
	//protects all html entities to be added 
	// mostly on ALL user inputs
?>

<?php include("footer.php"); ?>