<?php include("header.php");?>

<div id="updateBook">

<?php
	if (hasModeratorAccess() == false){
		header('location:index.php');
	}
	//fetch the selected book and details (from edit book button on manage books)
	if (isset($_GET['updateBook'])){
		$book_id = $_GET['updateBook'];
		$query = "SELECT isbn, title, pages, edition, published, publisher FROM book WHERE book_id = ?";
		$stmt = $db->prepare($query);
		$stmt->bind_param('i', $book_id);
		$stmt->bind_result($isbn, $title, $pages, $edition, $published, $publisher);
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();
	}
	//update chosen book 
	if (isset($_POST['updateBook'])){

		$book_id = $_POST['book_id'];
		$title = $_POST['title'];
		$isbn = $_POST['isbn'];
		$pages = $_POST['pages'];
		$edition = $_POST['edition'];
		$published = $_POST['published'];
		$publisher = $_POST['publisher'];

		$query = "UPDATE book SET title = '$title',
		isbn = '$isbn', pages = '$pages', edition = '$edition', published = '$published', publisher = '$publisher'
		WHERE book_id = '$book_id'";
		
		$stmt = $db->prepare($query);
		$stmt->execute();
		$stmt->close();
		$db->commit();
	}
?>
	<form method='post' action='' onSubmit='alert("Book updated")'>
		<!-- book_id field hidden so cannot be changed -->
 		<input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
		<table>
			<tr>
				<td>Title</td>
				<td><input type="text" name="title" value="<?php echo $title; ?>"></td>
			</tr>
			<tr>
				<td>ISBN</td>
				<td><input type="text" name="isbn" value="<?php echo $isbn; ?>"></td>
			</tr>
			<tr>
				<td>Pages</td>
				<td><input type="text" name="pages" value="<?php echo $pages; ?>"></td>
			</tr>
			<tr>
				<td>Edition</td>
				<td><input type="text" name="edition" value="<?php echo $edition; ?>"></td>
			</tr>
			<tr>
				<td>Published</td>
				<td><input type="text" name="published" value="<?php echo $published; ?>"></td>
			</tr>
			<tr>
				<td>Publisher</td>
				<td><input type="text" name="publisher" value="<?php echo $publisher; ?>"></td>
			</tr>
		</table>
		<button name='updateBook' value='updateBook' type='submit'>Update book</button>
	</form>

</div>

<?php include("footer.php");?>