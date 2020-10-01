<?php

require 'includes/db.php';

$conn = getDB();

$sql = "SELECT * FROM quoter ORDER BY published_at;";

$results = mysqli_query($conn, $sql);

if($results === false){
	echo mysqli_error($conn);
} else {
	$articles = mysqli_fetch_all($results, MYSQLI_ASSOC);
}
?>

<?php require 'includes/header.php'; ?>

<h1><span id="title">Da</span><img id="title-img" src="https://cdn.filestackcontent.com/4Yb857K3Q6uNw8A80H0M"><span id="title-end">zUhBlur</span></h1>

<main>
  <div class="calendar">
    <div class="month-indicator">
      <h2>May 2020</h2>
    </div>
    <div class="date-grid">

		<?php if (empty($articles)): ?>
			<p>No articles found.</p>
		<?php else: ?>
			<?php foreach ($articles as $article): ?>
				<div class="block"><a class="q-link" href="quote.php?id=<?= $article['id']; ?>"><?= $article['published_at']; ?></a><br>
					<span class="date-time"><?= $article['name']; ?></span>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>	     
    </div>
  </div>
</main>
<br>
<a class="return-btn" href="entry.php">New Entry</a>

<?php require 'footer.php'; ?>