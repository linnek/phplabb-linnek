<?php include("header.php");?>

<?php

if(isset($_POST) && !empty($_POST)){
	$myusername = mysqli_real_escape_string($db, $_POST['user']);
	$mypassword = mysqli_real_escape_string($db, $_POST['password']);
	//any code is now banned

	$stmt = $db->prepare(
	"SELECT user_id, password, user_role
	FROM user
	WHERE user_id = ?");

	$stmt->bind_param('s', $myusername); //this says it is a string, and the value is whatever is inside the $myusername
	//this statement replaces the questionmark inside the SQL prepared statement

	$stmt->execute();
	$stmt->bind_result($dbusername, $dbpassword, $dbuserrole);

	//check it with a while statement (if password matches)
	while($stmt->fetch()){
		
		if(sha1($mypassword) == $dbpassword){

			//echo "Welcome!";
			header('location:index.php');
			$_SESSION['username'] = $myusername;
			$_SESSION['userrole'] = $dbuserrole;
			$_SESSION['userip'] = $_SERVER['REMOTE_ADDR'];
		}

		echo "Wrong password!";
	}

// to hash passwords we can use SHA1 hash (it takes a string and hashes it)

}

?>
<div class="login">
	<form method="post" action="">
		<input type="text" class="" id="user" name="user" placeholder="Username">
		<input type="password" class="" id="password" name="password" placeholder="Password">
		<button type="submit" class="">Enter</button>
	</form>
</div>

<?php include("footer.php"); ?>