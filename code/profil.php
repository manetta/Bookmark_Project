<?php

require_once('include.php');
dispHeader();

$val_user=$_SESSION['valid_user'];
$user_type=$_SESSION['user_type'];

//swsto
//echo "<a href=\"hello.php?login=yes\">hello</a>";

echo '<br/>';
//echo $user_type;

dispProfilPage($user_type);

dispFooter();

?>