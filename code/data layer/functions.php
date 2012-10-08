<?php

///////////////////////////////////////////////////////////////////////////////////
///////synartisi gia elegxo swstis emfanisis tou email pou dinei o xristis/////////
///////////////////////////////////////////////////////////////////////////////////

function valid_email($email)
{
	//regural expression gia to e-mail
	$email_re="^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9_\-]+\.[a-zA-Z0-9_\-]+$";

	//me tin ereg anazitame sti metavliti $email tairiasmata pou symfwnoun me tin $email_re
	if(@(ereg($email_re,$email)))
	{
		return true;
	}
	else	
	{
		return false;
	}

}


?>