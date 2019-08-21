<?php include("config.php"); ?>

<!doctype html>
<html>
<head>
<title>Book Club</title>
<meta charset="utf-8" />
<link href="bookClub.css" type="text/css" rel="stylesheet"/>
<link rel="icon" type="image" href="img/favicon.jpg"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<header>
	<img src="img/owll.png">
	<ul id="adminMenu">
	<?php
		if (hasAdminAccess()){
			echo '<li><span class="adminButton"><a class="'. activePage("users.php", $current_page) . '" href="users.php">Manage users</a></span></li>';
		}

		if (hasModeratorAccess()){
			echo '<li><span class="adminButton"><a class="'. activePage("managebooks.php", $current_page) . '" href="managebooks.php">Manage books</a></span></li>';

			echo '<li><span class="adminButton"><a class="'. activePage("fileupload.php", $current_page) . '" href="fileupload.php">Upload file</a></span></li>';

			echo '<li><span class="adminButton"><a class="'. activePage("gallery.php", $current_page) . '"  href="gallery.php">Gallery</a></span></li>';
		}

		if (isLoggedIn()) {
			echo '<li><span class="adminButton"><a href="logout.php">Log out '.$_SESSION['username'].'</a></span></li>';
		}
		else {
			 echo '<li><span class="adminButton"><a href="login.php">Log in</a></span></li>';
		}
	?>
	</ul>

</header>

<body>

	<div id="mainMenu">
		<ul>
			<li><a class="<?php if ($current_page == 'index.php' || $current_page == '') {echo 'active';}?>" href="index.php">Home</a></li>
			<li><a class="<?php if ($current_page == 'about.php') { echo 'active';} ?>" href="about.php">About Us</a></li>

			<li><a class="<?php if ($current_page == 'browse.php') {echo 'active';} ?>" href="browse.php">Browse Books</a></li>

			<li><a class="<?php if ($current_page == 'mybooks.php') {echo 'active';} ?>" href="mybooks.php">My Books</a></li>

			<li><a class="<?php if ($current_page == 'contact.php') {echo 'active';} ?>" href="contact.php">Contact</a></li>
			
		</ul>
	</div>
	


	