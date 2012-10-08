<?php

require_once('include.php');
//dispHeader();


//dimiourgia suntomwn onomatwn metavlitwn
$username=$_POST['username'];
$password=$_POST['password'];


try
{
	
	//elegxos gia to an exei sypmlirwthei to username
	if(!filled_out($username))
	{
		dispHeader();
		?>
		<div class="article">
			
			<h3><span> <?php throw new Exception('Δεν έχετε συμπληρώσει το όνομα χρήστη!'); ?> </span></h3>
			<div class="clr"></div>
		</div>
		<?php
	}	
	

	//elegxos gia to an exei sypmlirwthei to password
	if(!filled_out($password))
	{
		dispHeader();
		?>
		<div class="article">
			
			<h3><span> <?php throw new Exception('Δεν έχετε συμπληρώσει τον κωδικό πρόσβασης!'); ?> </span></h3>
			<div class="clr"></div>
		</div>
		<?php
		
		
	}



	$type=login($username,$password);

	//efoson o xristis einai egegramenos pername to onoma toy sti session metavliti valid_user
	$_SESSION['valid_user']=$username;
	$val_user=$_SESSION['valid_user'];

	//elegxoume ton typo tou xristi pou syndethike kai to kataxwroume sti session metabliti user_type
	if($type=='U')
	{
		$type='User';
	}
	else	
		$type='Admin';

	$_SESSION['user_type']=$type;
	$type=$_SESSION['user_type'];

}

catch (Exception $e)
{
	echo $e->getMessage();
	
	?>
	<div class="article">
		</br>
		<h3><span>Αν είστε ήδη εγγεγραμένος στη σελίδα μας μεταβείτε στην </span><h2><a href="login.php">Σελίδα σύνδεσης</a></h2></h3>
		<div class="clr"></div>
		</br>
		<h3><span>Αν όχι μπορείται να κάνετε εγγραφή τώρα δωρεάν </span><h2><a href="signup.php">Εγγραφή</a></h2></h3>
		<div class="clr"></div>
		</br>
	</div>
	<?php
	dispFooter();
	?>

	
	<?php
	exit();
}

dispHeader();

?>
	<div class="article">
		</br>
		<h3><span>Επιτυχής σύνδεση στο σύστημα!!</span></h3>
		<div class="clr"></div>
		</br>
		<h2><a href="main.php">Αρχική</a></h2>
		</br>
	</div>
<?php



dispFooter();


?>