<?php

require_once('include.php');
dispHeader();

//dimiourgia suntomwn onomatwn metavlitwn
$title=$_POST['title'];
$url=$_POST['url'];
$desc=$_POST['description'];
$tag1=$_POST['tag1'];

//gia parapanw apo ena tag
//$tag2=$_POST['tag2'];
//$tag3=$_POST['tag3'];
//$tags=array();

//echo "<h1>Καταχώρηση σελιδοδείκτη</h1>";

try
{	
	?>
	<div class="article">
		</br>
		<h2><span>Καταχώρηση σελιδοδείκτη</span></h2>
		<div class="clr"></div>
		</br>
	</div>
	<?php

	
	//elegxos gia to an exei sypmlirwthei o titlos
	if(!filled_out($title))
	{
		?>
		<div class="article">
			<h3><span> <?php throw new Exception('Δεν έχετε συμπληρώσει τίτλο για τον σελιδοδείκτη σας!'); ?> </span></h3>
			<div class="clr"></div>
			</br>
		</div>

		<?php
	}

	//elegxos gia to an exei sypmlirwthei to url	
	if(!filled_out($url))
	{
		?>
		<div class="article">
			<h3><span> <?php throw new Exception('Δεν έχετε συμπληρώσει το url του σελιδοδείκτη σας!'); ?> </span></h3>
			<div class="clr"></div>
		</div>
		<?php		
	}

	//elegxos an exei dothei swsto url
	if(!check_url($url))	
	{
		?>
		<div class="article">
			<h3><span> <?php throw new Exception('Δεν έχετε δώσει σωστό url.Πρέπει να ξεκινά με τη μορφη http://www. ή www.!'); ?> </span></h3>
			<div class="clr"></div>
		</div>
		<?php
	}

	//elegxos gia to an exei sypmlirwthei i perigrafi
	if(!filled_out($desc))
	{
		?>
		<div class="article">
			<h3><span> <?php throw new Exception('Δεν έχετε δώσει μια σύντομη περιγραφή για τον σελιδοδείκτη σας!'); ?> </span></h3>
			<div class="clr"></div>
		</div>
		<?php
	}

	//elegxos gia to an exei sypmlirwthei ta tags
	if(!filled_out($tag1))
	{
		?>
		<div class="article">
			<h3><span> <?php throw new Exception('Δεν έχετε δώσει ετικέτα για τον σελιδοδείκτη σας!'); ?> </span></h3>
			<div class="clr"></div>
		</div>
		<?php
	}
	
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

		
	addURL($title,$url,$desc,$tag1);

}

catch (Exception $e)
{
	echo $e->getMessage();
}

dispFooter();
?>