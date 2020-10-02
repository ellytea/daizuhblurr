<?php
	
require 'includes/db.php';
	
$errors = []; 

if ($_SERVER["REQUEST_METHOD"] == "POST"){


	if($_POST['name'] == ''){
		die('Name is required');
	}
	if($_POST['quote'] == ''){
		die('A quote is required');
	}
	if($_POST['entry'] == ''){
		die('An entry is required');
	}

	if(empty($errors)){ 


	$conn = getDB();

	$sql = "INSERT INTO quoter (name, quote, published_at, entry)
			 VALUES (?,?,?,?)";

	$stmt = mysqli_prepare($conn, $sql);

	if($stmt === false){
		 echo mysqli_error($conn);
	} else {
		mysqli_stmt_bind_param($stmt, "ssss", $_POST['name'],$_POST['quote'],$_POST['published_at'],$_POST['entry']);
	if(mysqli_stmt_execute($stmt)){
		$id = mysqli_insert_id($conn);
	} else {
		echo mysqli_stmt_error($stmt);
	}

	}
	}
}

?>

<?php require 'includes/header.php'; ?>

<h2>New entry</h2>

<main>
<!--<?php //if(! emtpy($errors)): ?>-->
	<ul>
		<?php foreach ($errors as $error): ?>
			<li><?= $error ?></li>
		<?php endforeach; ?>
	</ul>
<!--<?php //endif; ?> -->

<form method="post">

	<div>
		<label for="entry">Your Entry</label><br>
		<textarea name="entry" placeholder="Your thoughts on today.."></textarea>
	</div>
	<div>
		<label for="name">Quoter's Name</label><br>
		<input name="name" type="text" placeholder="Albert Einstein">
	</div>
	<div>
		<label for="quote">Quote</label><br>
		<textarea name="quote" placeholder="Everybody is a genius. But if you judge a fish by its ability to climb a tree, it will live its whole life believing that it is stupid." rows="5" cols="50"></textarea>
	</div>
	<div>
		<label for="published_at">Date and Time</label><br>
		<input name="published_at" type="datetime-local">
	</div><br>
	<button>Enter</button>
</form>
</main>
<br>
<a class="return-btn" href="index.php">Back to Calendar</a>

<?php require 'includes/footer.php' ?>