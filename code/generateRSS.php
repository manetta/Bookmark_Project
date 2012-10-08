<?php

header("Content-Type: text/xml; charset=UTF-8");

	echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
		  <rss version=\"2.0\">";
	  
	echo "<channel>
		  <title>The Bookmarking Project</title>
		 <link>http://localhost/BookmarkProject/</link>
		  <description>RSS Feed για νέα bookmarks</description>";

function db_connect() {

	$db = new mysqli('localhost','dbauthor','password','bookmarks');
	if( !$db ) {
	
		throw new Exception('Could not connect to database server');
	}	
	return $db;	
}

	$conn = db_connect();

	$query = "SELECT * FROM bookmark ORDER BY modified DESC";
	$result = $conn->query($query);
	if( !$result){

		throw new Exception('Τα χαρακτηριστικά των bookmarks δεν μπόρεσαν να ανακτηθούν');
		exit;
	}

	$num_results = $result->num_rows;
	if( $num_results <= 10 ) $max = $num_results;
	else $max = 10;

	for( $i = 0; $i < $max; $i++ ) {

		$row = $result->fetch_assoc();
		echo '<item>';
		echo '<title>'.$row['title'].'</title>';
		echo '<link>http://localhost/BookmarkProject/bookmark.php?var='.$row['bookmark_id'].'</link>';
		echo '<description>'.$row['description'].'</description>';
		echo '<pubDate>'.$row['modified'].'</pubDate>';
		echo '</item>';
		
	}

	echo '</channel>
		</rss>';

?>