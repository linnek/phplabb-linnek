<?php include("header.php");?>

<div id="addBook">

<?php

	if (hasModeratorAccess() == false){
		header('location:index.php');
	}

	// when click on "add book" button 
	if (isset($_POST['addBook'])){
		$title = $_POST['title'];
		$isbn = $_POST['isbn'];
		$pages = $_POST['pages'];
		$edition = $_POST['edition'];
		$published = $_POST['published'];
		$publisher = $_POST['publisher'];
		$author_id = $_POST['author_id'];
		$query = "INSERT into book (title, isbn, pages, edition, published, publisher) values (?,?,?,?,?,?)";
		$stmt = $db->prepare($query);
		$stmt->bind_param('ssiiis', $title, $isbn, $pages, $edition, $published, $publisher);
		$stmt->execute();
		$stmt->close();

		//select highest value of book_id
		$query = "SELECT max(book_id) FROM book";
		$stmt = $db->prepare($query);
		$stmt->bind_result($book_id);
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();

		// loop over each selected author_id and add a row in book_author 
		foreach ($author_id as $value) {
			$query = "INSERT into book_author (book_id, author_id) values (?,?)";
			$stmt = $db->prepare($query);
			$stmt->bind_param('ii', $book_id, $value);
			$stmt->execute();
			$stmt->close();
		}
	}
?>
	<form method='post' action='' onSubmit='alert("Book added")'>
		<table>
			<tr>
				<td>Title</td>
				<td><input type="text" name="title"></td>
			</tr>
			<tr>
				<td>ISBN</td>
				<td><input type="text" name="isbn"></td>
			</tr>
			<tr>
				<td>Pages</td>
				<td><input type="text" name="pages"></td>
			</tr>
			<tr>
				<td>Edition</td>
				<td><input type="text" name="edition"></td>
			</tr>
			<tr>
				<td>Published</td>
				<td><input type="text" name="published"></td>
			</tr>
			<tr>
				<td>Publisher</td>
				<td><input type="text" name="publisher"></td>
			</tr>
			<tr>
				<td><span>Author(s)</span></td>
				<td>
					<!-- author_id[] = array (multiple so you can choose more than one author)  -->
					<select name="author_id[]" size="7" multiple>
						<?php 
						$query = "SELECT author_id, first_name, last_name FROM author";
						$stmt = $db->prepare($query);
						$stmt->bind_result($author_id, $first_name, $last_name);
						$stmt->execute();

						//add one option for each author
						while ($stmt->fetch()){
							echo '<option value="'.$author_id.'">'.$first_name. " ".$last_name.'</option>';
						}
						?>
					</select>
				</td>
			</tr>
		</table>
		<button name='addBook' value='addBook' type='submit'>Add book</button>
	</form>

</div>

<?php include("footer.php");?>