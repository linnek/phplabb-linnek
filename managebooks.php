<?php include("header.php");?>

<div id="manageBooks">

<?php

	if (hasModeratorAccess() == false){
		header('location:index.php');
	}

	if (isset($_GET['deleteBook'])){

		$bookid = $_GET['deleteBook'];
		//Delete from book_author(child)
		$query = "DELETE from book_author WHERE book_id = '$bookid'";
		$stmt = $db->prepare($query);
		$stmt->execute();
		$stmt->close();
		//Delete from book(parent)
		$query = "DELETE from book WHERE book_id = '$bookid'";
		$stmt = $db->prepare($query);
		$stmt->execute();
		$stmt->commit();
		$stmt->close();
	}	
	// show all books 
	$query = "SELECT b.book_id, b.title, a.first_name, a.last_name
          FROM book b, book_author ba, author a
          WHERE ba.book_id = b.book_id
          AND a.author_id = ba.author_id";

	$stmt = $db->prepare($query);
	$stmt->bind_result($book_id, $title, $first_name, $last_name);
	$stmt->execute();

	echo "<table>";
	echo "<tr><th>Title</th>
	<th>Author</th></tr>";

	while($stmt->fetch()){

		echo "<tr><td>".$title."</td>
		<td>".$first_name." ".$last_name."</td>
		<td>
			<form method='get' action='updatebook.php'>
				<button name='updateBook' value='".$book_id."' type='submit'>Update</button>
			</form>
			<form method='get' action='' onSubmit='alert(\"Book deleted\")'>
				<button name='deleteBook' value='".$book_id."' type='submit'>Delete</button>
			</form>

		</td></tr>";
	}

	echo "</table>";
?>
<a href="addbook.php">Add new book</a>

</div>

<?php include("footer.php");?>