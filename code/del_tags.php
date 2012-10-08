<?php

require_once('include.php');
dispHeader();

//echo 'hello';
@$del_me=$_POST['del_tag'];

if(isset($_GET['var'])) $id=strval($_GET['var']); else $id=NULL;



if(count($del_me)>0)
{
	
	for($i=0; $i<count($del_me); $i++)
	{
		//echo $del_me[$i];
		//echo '<br/>';
		delete_tags_sep($id,$del_me[$i]);
	}
	//echo '<br/>';
	//echo 'Έπιτυχής διαγραφή των ετικετών';
	find_url_mod($id);
}
else
{
	echo '<br/>';
	echo 'Δεν έχετε επιλέξει κάποιο σελιδοδείκτη προς διαγραφή';
}


dispFooter();


?>
