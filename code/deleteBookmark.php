<?php

require_once('include.php');
dispHeader();


if (isset($_GET['var'])) {$id = $_GET['var'];}


try
{
	delBkm($id);
	
	?>
	<div class="mainbar">
        <div class="article">
          <h3><span>Ο σελιδοδείκτης διαγράφηκε επιτυχώς!</span></h3>
		  <h2><a href="main.php"> Αρχική Σελίδα</a></h2>
          <div class="clr"></div>
        </div>
	</div>
	<?php
}

catch (Exception $e)
{
	echo $e->getMessage();
	exit();
}

dispFooter();
?>
