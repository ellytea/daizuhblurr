<?php

require 'includes/db.php';

$conn = getDB();

if (isset($_GET['id']) && is_numeric($_GET['id'])){

$sql = "SELECT * FROM quoter WHERE id = ".$_GET['id'];

$results = mysqli_query($conn, $sql);

if($results === false){
	echo mysqli_error($conn);
} else {
	$article = mysqli_fetch_assoc($results);
} 
} else {
	$article = null;
}
 
?>

<?php require 'includes/header.php'; ?>
<article>
<?php if ($article === null): ?>
	<p>Article not found.</p>
<?php else: ?>
	<aside>
		<img id="quote-img" src="<?= $article['image']; ?>" atl="<?= $article['name']; ?>">
		<section id="quote-sec">
			<p><?= $article['quote']; ?></p>
			<h3>- <?= $article['name']; ?></h3>
		</section>
	</aside>
	<main id="pg-entry">
		<h1>Daily Entry:</h1>
		<p><?= $article['entry']; ?></p>
	</main>
	</article>
	<br>
	<a class="return-btn" href="index.php">Back to Calendar</a>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>

