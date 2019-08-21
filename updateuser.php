<?php include("header.php");?>

<div id="updateUser">

<?php
	if (hasAdminAccess() == false){
		header('location:index.php');
	}
	//fetch selected user (from update user button on manage users)
	if (isset($_GET['updateUser'])){
		$user_id = $_GET['updateUser'];
		$query = "SELECT user_role FROM user WHERE user_id = ?";
		$stmt = $db->prepare($query);
		$stmt->bind_param('s', $user_id);
		$stmt->bind_result($user_role);
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();
	}
	// update chosen user
	if (isset($_POST['updateUser'])){

		$user_id = $_POST['user_id'];
		$user_password = $_POST['password'];
		$user_role = $_POST['user_role'];
		$query = "UPDATE user SET user_role = '$user_role'";
		//if password field is filled in this is added to the query
		if (!empty($user_password)){
			$query .= ", password = sha1('$user_password')";
		}

		$query .= " WHERE user_id = '$user_id'";
		$stmt = $db->prepare($query);
		
		$stmt->execute();
		$stmt->close();
		$db->commit();
	}
?>
	<form method='post' action='' onSubmit='alert("User updated")'>
		<table>
			<tr>
				<td>Username</td>
				<td><input type="text" readonly name="user_id" value="<?php echo $user_id; ?>"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td>Role</td>
				<td>
					<!-- option list will select the userrole you currently have  -->
					<select name="user_role">
						<option <?php if ($user_role == "001") echo "selected"; ?> value="001">Browser</option>
						<option <?php if ($user_role == "011") echo "selected"; ?> value="011">Moderator</option>
						<option <?php if ($user_role == "111") echo "selected"; ?> value="111">Administrator</option>
					</select>
				</td>
			</tr>
		</table>
		<button name='updateUser' value='updateUser' type='submit'>Update user</button>
	</form>

</div>

<?php include("footer.php");?>