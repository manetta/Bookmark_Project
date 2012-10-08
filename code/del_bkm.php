<?php
require_once('include.php');
dispHeader();

$val_user=$_SESSION['valid_user'];
//to id toy selidodeikti
@$del_me=$_POST['del_me'];

echo '<h2>Διαγραφή σελιδοδεικτών</h2>';

if(count($del_me)>0)
{
	//echo count($del_me);
	//echo 'hello';
	for($i=0; $i<count($del_me); $i++)
	{
		//echo $del_me[$i];
		delete_bkm($val_user,$del_me[$i]);
	}
	echo '<br/>';
	echo 'Έγινε επιτυχής διαγραφή των σελιδοδεικτών';
}
else
{
	echo 'Δεν έχει επιλεγεί κάποιος σελιδοδείκτης προς διαγραφή';
}

dispFooter();
?>