<?php

require_once('include.php');
dispHeader();

$tag1=$_POST['tag1'];
//$tag2=$_POST['tag2'];
//$tag3=$_POST['tag3'];
//$tags=array();

//echo '<br>';
try
{
	//elegxos gia to an exei sypmlirwthei o titlos
	if(!filled_out($tag1))
	{
		echo '<br>';
		throw new Exception('Δεν έχετε δώσει ετικέτα για την αναζήτηση');
	}

	echo '<br/>';
	
	//dimiourgoume ena pinaka pou apothikeuoume ola ta tags poy dinei o xristis
	/*
	if(isset($tag1) && isset($tag2) && isset($tag3))
	{
		array_push($tags,$tag1);
		array_push($tags,$tag2);
		array_push($tags,$tag3);
	}
	else if(isset($tag1) && isset($tag2))
	{
		array_push($tags,$tag1);
		array_push($tags,$tag2);
	}
	else
	{
		array_push($tags,$tag1);
	}
	*/	
	
	
	searchURL_by_tags($tag1,0);
}

catch (Exception $e)
{
	echo $e->getMessage();
}

dispFooter();
?>