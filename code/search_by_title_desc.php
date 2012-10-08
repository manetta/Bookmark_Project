<?php

require_once('include.php');
dispHeader();

//dimiourgia suntomwn onomatwn metavliwn
$title=$_POST['title_url'];
$desc=$_POST['desc_url'];


try
{	
	//elegxos gia to an exei sypmlirwthei o titlos
	if(!filled_out($title))
	{
		echo '<br>';
		throw new Exception('Δεν έχετε συμπληρώσει τίτλο για τον σελιδοδείκτη');
	}


	if(!filled_out($desc))
	{
		echo '<br>';
		throw new Exception('Δεν έχετε συμπληρώσει την περιγραφη για τον σελιδοδείκτη');
	}

	searchURL_by_title_desc($title,$desc,0);
}

catch (Exception $e)
{
	echo $e->getMessage();
}

dispFooter();
?>