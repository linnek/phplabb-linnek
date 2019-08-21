<?php include("header.php");?>
<div id="browse">

<?php

$searchauthor = "";
$searchtitle = "";

//update the status of the book to reserved after click on reserve button
if (isset($_GET['bookid'])){

	$bookid = $_GET['bookid'];
	$query = "UPDATE book
				SET reserved=1
				WHERE book_id = $bookid";
	$stmt = $db->prepare($query);
	$stmt->execute();			
}

//when click search button, if there is any input in the input fields, apply them to a variable
if (isset($_POST) && !empty($_POST)){

	$searchauthor = trim($_POST['author']);
	$searchtitle = trim($_POST['title']);
	$searchauthor = htmlentities($searchauthor);
	$searchtitle = htmlentities($searchtitle);
}
?>

<form method="post" action="">
	<input type="text" class="" id="author" name="author" placeholder="Author of the book">
	<input type="text" class="" id="title" name="title" placeholder="Title of the book">
	<button type="submit" class="">Search</button>
</form>

<?php
	//create a query and apply search criteria if it exists
	$query = "SELECT b.book_id, b.title, a.first_name, a.last_name, b.isbn
          FROM book b, book_author ba, author a
          WHERE ba.book_id = b.book_id
          AND a.author_id = ba.author_id
          AND b.reserved = 0";

    // % = matches any string
	if($searchtitle && !$searchauthor){
		$query = $query . " AND b.title LIKE '%" . $searchtitle . "%'";
	}

	if(!$searchtitle && $searchauthor){
		$query = $query . " AND a.first_name LIKE '%" . $searchauthor . "%'";
	}

	if($searchtitle && $searchauthor){
		$query = $query . " AND b.title LIKE '%" . $searchtitle . "%' AND a.first_name LIKE '%" . $searchauthor . "%'";
	}

	//run the query if input field is filled in and search button is clicked or a book was reserved
	if($searchtitle || $searchauthor || isset($_GET['bookid'])){
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
				<form method='get' action='' onSubmit='alert(\"You reserved ".$title."\")'>"; 
				if (hasBrowserAccess()){
					echo "<button name='bookid' value='".$bookid."' type='submit'>Reserve Book</button>";
				}
				echo "
				</form>
			</td></tr>";
		}
	}
	echo "</table>";
?>
</div>

<?php include("footer.php"); ?>