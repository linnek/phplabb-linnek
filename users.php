<?php include("header.php");?>

<div id="users">

<?php

	if (hasAdminAccess() == false){
		header('location:index.php');
	}
	//delete chosen user
	if (isset($_GET['deleteUser'])){

		$userid = $_GET['deleteUser'];
		$query = "DELETE from user WHERE user_id = '$userid'";
		$stmt = $db->prepare($query);
		$stmt->execute();

	}	
	//show all users
	$query = "select user_id, user_role from user";
	$stmt = $db->prepare($query);
	$stmt->bind_result($dbuserid, $dbuserrole);
	$stmt->execute();

	echo "<table>";
	echo "<tr><th>User</th>
	<th>Role</th></tr>";

	while($stmt->fetch()){

		echo "<tr><td>".$dbuserid."</td>
		<td>".getAccess($dbuserrole)."</td>
		<td>
			<form method='get' action='updateuser.php'>
				<button name='updateUser' value='".$dbuserid."' type='submit'>Update</button>
			</form>
			<form method='get' action=''>
				<button name='deleteUser' value='".$dbuserid."' type='submit'>Delete</button>
			</form>

		</td></tr>";
	}

	echo "</table>";
?>
<a href="adduser.php">Add new user</a>
</div>

<?php include("footer.php"); ?>