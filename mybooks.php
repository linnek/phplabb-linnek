<?php include("header.php"); ?>
<div id="myBooks">

<?php

//update the status of the book to NOT reserved
	if (isset($_GET['bookid'])){

		$bookid = $_GET['bookid'];
		$query = "UPDATE book
				SET reserved=0
				WHERE book_id = $bookid";
		$stmt = $db->prepare($query);
		$stmt->execute(); 
	}	

//List all reserved books
$query = "SELECT b.book_id, b.title, a.first_name, a.last_name, b.isbn
          FROM book b, book_author ba, author a
          WHERE ba.book_id = b.book_id
          AND a.author_id = ba.author_id
          AND b.reserved = 1";

    $stmt = $db->prepare($query);
	$stmt->bind_result($bookid, $title, $authorF, $authorL, $isbn);
	$stmt->execute();

	echo "<table>";
	echo "<tr><th>Title</th>
	<th>Author</th>
	<th>ISBN</th></tr>";

	while($stmt->fetch()){

		echo "<tr><td>".$title."</td>
		<td>".$authorF." ".$authorL."</td>
		<td>".$isbn."</td>
		<td>
			<form method='get' action=''>
			<button name='bookid' value='".$bookid."' type='submit'>Return</button>
			</form>
		</td></tr>";
	}

	echo "</table>";
?>

</div>

<?php include("footer.php"); ?>