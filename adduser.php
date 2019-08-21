<?php include("header.php");?>

<div id="addUser">

<?php
	if (hasAdminAccess() == false){
		header('location:index.php');
	}

	// when click on "add user" button
	if (isset($_POST['addUser'])){

		$user_id = $_POST['user_id'];
		$user_password = $_POST['password'];
		$user_role = $_POST['user_role'];
		$query = "INSERT into user (user_id, password, user_role) values (?, sha1(?), ?)";
		$stmt = $db->prepare($query);
		$stmt->bind_param('sss', $user_id, $user_password, $user_role);
		$stmt->execute();
	}
?>
	<form method='post' action='' onSubmit='alert("User added")'>
		<table>
			<tr>
				<td>Username</td>
				<td><input type="text" name="user_id"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td>Role</td>
				<td>
					<select name="user_role">
						<option value="001">Browser</option>
						<option value="011">Moderator</option>
						<option value="111">Administrator</option>
					</select>
				</td>
			</tr>
		</table>
		<button name='addUser' value='addUser' type='submit'>Add new user</button>
	</form>

</div>

<?php include("footer.php");?>