<?php

require_once('include.php');


/*********************************************************************************************************
* arxeio sto opoio apothikeuoume sunartiseis sxetikes me erwtimata kai eisagwges stoixeiwn pros ti vasi 
* dedomenwn
**********************************************************************************************************/


/**********************************************************************************************************
* sunartisi gia sundesi me ti vasi dedomenwn
**********************************************************************************************************/

function db_connect()
{
	//sundesi me ti vasi dedomenwn	
	$db_conn=@mysql_connect("localhost","dbauthor","password");
	
	if(!$db_conn)	
	{
		//echo 'hello error 1</br>';
		die('Υπήρξε πρόβλημα κατά την σύνδεση με τη βάση δεδομένων'.mysql_error());
		exit();
	}

	//epilogi tis vasis dedomenen
	$db_select=@mysql_select_db("bookmarks",$db_conn);

	if(!$db_select)
	{
		//echo 'hello error 2</br>';
		die('Η σύνδεση με τη βάση δεδομένων απέτυχε.Παρακαλώ δοκιμάστε αργότερα'.mysql_error());
	}	

	return $db_conn;
}


/*********************************************************************************************************
* synartisi gia tin egrafi tou xristi sti vasi dedomenwn
**********************************************************************************************************/

function register($username,$password,$email)
{
	//sundesi me ti vasi dedomenwn kalwntas ti synartisi db_connect()
	$conn=db_connect();
		
	//elegxos gia to an to username pou epelexe o xrisits einai diathesimo
	$result=@mysql_query("SELECT * FROM users where username='$username'");

	if(!$result)
		throw new Exception('Συνέβη κάποιο σφάλμα κατά την εγγραφή σας');
	if(mysql_num_rows($result)>0)
		throw new Exception('Το όνομα χρήστη που επιλέξατε χρησιμοποιείται ήδη');

	//efoson to username einai diathesimo eisagoyme ta stoixea toy xristi sti vasi dedomenwn
	$result=mysql_query("INSERT INTO users (username,password,email,user_type) VALUES ('$username',sha1('$password'),'$email','U')");
	if(!$result)
		throw new Exception('Δεν εγγραφήκατε επιτυχώς στο σύστημά μας.Παρακαλώ δοκιμάστε αργότερα');
	
	//kleisimo tis vasis dedomenwn
	mysql_close($conn);

	return true;
}


/*********************************************************************************************************
* synartisi gia tin syndesi tou xristi sto systima
**********************************************************************************************************/

function login($username,$password)
{
	//sundesi me ti vasi dedomenwn kalwntas ti synartisi db_connect()
	$conn=db_connect();
	
	$username=mysql_real_escape_string($username);
	$password=mysql_real_escape_string($password);	


	//elegxos gia to an yparxi xristis me to dosmeno username kai password
	$result=@mysql_query("SELECT user_type FROM users where username='$username' AND password=sha1('$password')");

	//kleisimo tis vasis dedomenwn
	mysql_close($conn);

	//emafanisi minima lathous
	if(!$result)
		throw new Exception('Συνέβη κάποιο σφάλμα κατά τον έλεγχο του ονοματός σας');

	//elegxos gia to an o xristis einai kataxwrimenos sti vasi dedomenwn
	if(mysql_num_rows($result)>0)
	{
		$row=mysql_fetch_object($result);
		
		return $row->user_type;
		echo 'o xristis yparxei sti vasi';
	}
	else
	{
		dispHeader();
		?>
		<div class="article">
			<h3><span> <?php throw new Exception('Ελέγξτε τα στοιχεία που δώσατε.Δεν υπάρχει χρήστης με αυτά τα στοιχεία!<br/>'); ?> </span></h3>
			<div class="clr"></div>
		</div>
		<?php
	}

}


/*********************************************************************************************************
* synartisi gia tin kataxwrisi neou url sti vasi dedomenwn
**********************************************************************************************************/

function addURL($title,$url,$desc,$tag)
{
	//xwrizoume ta tags me vasi to keno kai ta apothikeuoume ston pinaka $tag_array
	//$tag_array=explode(",", $tags);
	
	$title=mysql_real_escape_string($title);
	$url=mysql_real_escape_string($url);
	$desc=mysql_real_escape_string($desc);
	$tag=mysql_real_escape_string($tag);
	$val_user=$_SESSION['valid_user'];

	/*
	$elements=count($tags);
	for($i=0; $i<$elements; $i++)
	{
		$tags[$i]=mysql_real_escape_string($tags[$i]);
		echo $tags[$i];
	}
	*/

	//elexnoume an o xristis exei idi apothikeusei to idio sxolio
	$row=find_url($url);
	
	if($row>0)
	{
		?>
		<div class="article">
			</br>
			<h3><span>Ο σελιδοδείκτης που δώσατε είναι ήδη αποθηκευμένος!</span><h2><a href="main.php">Αρχική σελίδα</a></h2></h3>
			<div class="clr"></div>
			</br>
		</div>
		<?php
	}
	else
	{
		//echo "Ο σελιδοδείκτης που δώσατε δεν υπάρχει και θα αποθηεκυτεί στη βάση δεδομένων!";
		
		$x=0;
		//elenxoume an to url poy exei dwsei o xristis xekina me http://www opote to sximatizoyme sti morfi www. kai to apothikeuoume
		if(@ereg("^http://www.",$url))
		{
			//sximatismos url sti morfi www. apo ti morfi http://www.
			$nurl=explode("http://",$url);
			
			if(@ereg("\/$",$nurl[1]))
			{
				//to url pou xekinoyse me http:// teleiwnei me / kai theloyme na to afairesoyme
				//afairesi toy / apo to telos tou url
				$len=strlen($nurl[1]);
				$nurl[1]=substr($nurl[1],0,$len-1);
			}
			$x=1;
		}
		else
		{
			if(@ereg("\/$",$url))
			{
				//to url teleiwnei me / kai theloyme na to afairesoyme
				//afairesi toy / apo to telos tou url
				$len=strlen($url);
				$nurl=substr($url,0,$len-1);
				$x=2;
			}
		}
		
		
		if($x==0)
		{
			save_url($title,$url,$desc);
			save_tags($tag,$url);
			$id=search_url($val_user,$url);
			
			?>
			<div class="article">
				</br>
				<h3><span>Επιτυχής αποθήκευση του σελιδοδείκτη που δώσατε στη βάση δεδομένων!</span><h2><a href="main.php">Αρχική σελίδα</a></h2></h3>
				<div class="clr"></div>
				</br>
				<?php
				echo "<a href='modify_bkm.php?var=$id'>Επεξεργασία Σελιδοδείκτη</a>";
				//echo "<h2><a href='modify_bkm.php?var=$id'>Επεξεργασία Σελιδοδείκτη</a></h2>";
				?>
				<div class="clr"></div>
				</br>
			</div>
			<?php
			
		}
		else if($x==1)
		{
			save_url($title,$nurl[1],$desc);
			save_tags($tag,$nurl[1]);
			$id=search_url($val_user,$url);
			
			?>
			<div class="article">
				</br>
				<h3><span>Επιτυχής αποθήκευση του σελιδοδείκτη που δώσατε στη βάση δεδομένων!</span><h2><a href="main.php">Αρχική σελίδα</a></h2></h3>
				<div class="clr"></div>
				</br>
				<?php
				echo "<a href='modify_bkm.php?var=$id'>Επεξεργασία Σελιδοδείκτη</a>";
				//echo "<h2><a href='modify_bkm.php?var=$id'>Επεξεργασία Σελιδοδείκτη</a></h2>"
				?>
				<div class="clr"></div>
				</br>
			</div>
			<?php
		}	
		else if($x==2)
		{
			save_url($title,$nurl,$desc);
			save_tags($tag,$nurl);
			$id=search_url($val_user,$url);

			?>
			<div class="article">
				</br>
				<h3><span>Επιτυχής αποθήκευση του σελιδοδείκτη που δώσατε στη βάση δεδομένων!</span><h2><a href="main.php">Αρχική σελίδα</a></h2></h3>
				<div class="clr"></div>
				</br>
				<?php
				//echo "<a href='modify_bkm.php?var=$id'>Επεξεργασία Σελιδοδείκτη</a>";
				echo "<h2><a href='modify_bkm.php?var=$id'>Επεξεργασία Σελιδοδείκτη</a></h2>";
				?>
				<div class="clr"></div>
				</br>
			</div>
			<?php
		}
	}
}



/*********************************************************************************************************
* synartisi gia tin dimiourgia olwn twn idiwn url se sxesi me ayto poy dinei o xristis 
**********************************************************************************************************/

function find_url($url)
{

	//username xristi pou einai syndedemenos sto systima
	$val_user=$_SESSION['valid_user'];
	
	
	//elegxo an o idios xristis exei idi apothikeusi to url poy edwse sti forma me ti morfi    http://www.
	if(@ereg("^http://www.",$url))
	{		
		//sximatismos url sti morfi www. apo ti morfi http://www.
		$turl=explode("http://",$url);
		
		//psaxe an yparxei sti vasi dedomenwn url tis morfis wwww. ... kai epistrefei to id tou
		$result1=search_url($val_user,$turl[1]);
		if($result1>0) return $result1;
	
		if(@ereg("\/$",$url))
		{
			//to url pou xekinoyse me http:// teleiwnei me / kai theloyme na to afairesoyme
			//afairesi toy / apo to telos tou url
			$len=strlen($url);
			$nurl=substr($url,0,$len-1);
			
			//dimiourgoume url pou xekiname me www. kai teleiwnei xwris /
			$wnurl=explode("http://",$nurl);

			//psaxe an yparxei sti vasi dedomenwn url tis morfis wwww. ...(xwris / sto telos) kai epistrefei to id tou
			$result3=search_url($val_user,$wnurl[1]);	
			if($result3>0) return $result3;	
		}
		else
		{
			//to arxiko url den teleiwnei me / kai prepei emeis na to prosthesoyme
			//dimiourgoume url tis morfis http://www. pou teleiwnei me /
			$str="/";
			$nurl1=$url.$str;

			//to arxiko url den teleiwnei me / kai prepei emeis na to prosthesoyme
			//dimiourgoume url tis morfis www. pou teleiwnei me /
			$wnurl=explode("http://",$nurl1);
		

			//psaxe an yparxei sti vasi dedomenwn url tis morfis wwww. ... kai epistrefei to id tou
			$result3=search_url($val_user,$wnurl[1]);
			if($result3>0) return $result3;
			
		}
	}
	else
	{
		//to dosmeno url xekina me www.
		//psaxe an yparxei sti vasi dedomenwn to url me ti morfi pou mas to edwse o xristis (xekina me www. ... kai den xeroume an teleiwnei me / h oxi)
		// kai epistrefei to id tou
		$result=search_url($val_user,$url);
		
		
		if($result>0) return $result;
		
		
		
		//elenxoume an to dosmeno url teleiwnei me / i oxi
		if(@ereg("\/$",$url))
		{
			//to dosmeno url teleiwnei me / opote emeis prepei na to afairesoyme
			//dimiourgia url tis morfis www. ... xwris / sto telos
			$len1=strlen($url);
			$nurl3=substr($url,0,$len1-1);
		
			//psaxe an yparxei sti vasi dedomenwn url tis morfis wwww. ... xwris / sto telos kai epistrefei to id tou
			$result2=search_url($val_user,$nurl3);
			if($result2>0) return $result2;		
		}
		
		else
		{
			//to dosmeno url den teleiwnei me / opote emeis prepei na to prosthesoume
			//dimiourgia url tis morfis www. ... / (teleiwnei me /)
			$str1="/";
			$nurl3=$url.$str1;
		
			//psaxe an yparxei sti vasi dedomenwn url tis morfis wwww. ... kai epistrefei to id tou
			$result2=search_url($val_user,$nurl3);
			if($result2>0) return $result2;
		}
	}
	return 0;
}

/*********************************************************************************************************
* synartisi gia tin anazitisi sti vasi dedomenwn enos url
**********************************************************************************************************/

function search_url($username,$url)
{
	//sundesi me ti vasi dedomenwn kalwntas ti synartisi db_connect()
	$conn=db_connect();


	$url_result=mysql_query("SELECT * FROM bookmark where user_id='$username' AND url='$url'");

	//kleisimo tis vasis dedomenwn
	mysql_close($conn);

	if(!$url_result)
		throw new Exception('Συνέβει κάποιο σφάλμα κατά τον έλεγχο για το url που καταχωρήσατε');
		
		
	if(mysql_num_rows($url_result)>0)
	{
		//$row=mysql_fetch_object($url_result);
		$row=mysql_fetch_row($url_result);
		return $row[0];
	}
	else 	
	{
		return 0;
	}
}

/*********************************************************************************************************
* synartisi gia tin apothikeusi enos url sti vasi dedomenwn
**********************************************************************************************************/

function save_url($title,$url,$desc)
{
	//username xristi pou einai syndedemenos sto systima
	$val_user=$_SESSION['valid_user'];
	
	//sundesi me ti vasi dedomenwn kalwntas ti synartisi db_connect()
	$conn=db_connect();
	$result=mysql_query("INSERT INTO bookmark(title,url,description,user_id) VALUES ('$title','$url','$desc','$val_user')");
	mysql_close($conn);

	return 0;
}


/*********************************************************************************************************
* synartisi gia tin apothikeusi twn tags enos url sti vasi dedomenwn
**********************************************************************************************************/

function save_tags($tag,$url)
{
	$val_user=$_SESSION['valid_user'];

	$bid=search_url($val_user,$url);

	$conn=db_connect();	

	//$elements=count($tag_array);

	//for($i=0; $i<$elements; $i++)
	//{
	$result=mysql_query("INSERT INTO tags (bkmark_id,tag) VALUES ('$bid','$tag')");
	if(!$result)
		throw new Exception('Δεν έγινε επιτυχής απποθήκευση των tags στο σύστημα.Παρακαλώ δοκιμάστε αργότερα');
		
	//kataxwroume ton selidodeikti ston pinaka auto complete an den yparxei
	$result1=mysql_query("SELECT * FROM autocomplete WHERE val='$tag'");
	
	if(!$result1)
		throw new Exception('Δεν έγινε επιτυχής απποθήκευση των tags στο σύστημα.Παρακαλώ δοκιμάστε αργότερα');
		
	if(mysql_num_rows($result1)==0)
	{
		$result2=mysql_query("INSERT INTO autocomplete (val) VALUES ('$tag')");
		if(!$result2)
			throw new Exception('Δεν έγινε επιτυχής απποθήκευση των tags στο σύστημα.Παρακαλώ δοκιμάστε αργότερα');	
	}
	//}	
	
	mysql_close($conn);
	return 0;
}


/*********************************************************************************************************
* synartisi gia tin emfanisi twn url enos xristi 
**********************************************************************************************************/

function find_mybkm()
{
	$id_array=array();
	
	$val_user=$_SESSION['valid_user'];

	//sundesi me ti vasi dedomenwn
	$conn=db_connect();
	
	//anazitisi twn url pou exei kataxwrisei enas xristis stin vasi dedomenwn	
	$bkm_result=mysql_query("SELECT * FROM bookmark where user_id='$val_user'");
	
	//kleisimo tis vasis dedomenwn	
	mysql_close($conn);		


	if(!$bkm_result)
		throw new Exception('Συνέβει κάποιο σφάλμα κατά την ανάκτηση των url σας');

	if(mysql_num_rows($bkm_result)>0)
	{
		$num_result=mysql_num_rows($bkm_result);
		
		$id_array=array();
		$title_array=array();
		$url_array=array();
		
		
		for($i=1; $i<$num_result+1; $i++)
		{
			$row=mysql_fetch_row($bkm_result);
		
			$id_array[$i]=$row[0];
			$title_array[$i]=$row[1];
			$url_array[$i]=$row[2];
		}
	}	
		
	$final_array=array();
	$size=count($id_array);
	$j=1;
	
	for($i=0; $i<3*$size; $i=$i+3)
	{
		$final_array[$i]=$id_array[$j];
		$final_array[$i+1]=$title_array[$j];
		$final_array[$i+2]=$url_array[$j];
		$j++;
	}
	
	if(count($final_array)>0)
	{
		return $final_array;
	}
}


/*********************************************************************************************************
* synartisi gia tin anazitisi enos url apo ti vasi dedomenwn me vasi ton titlo kai tin perigrafi
**********************************************************************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*allagi stin synartisi tha prepei na koitame an i apothikeumeni perigrafi sumfwnei me ayto poy exei dwsei o xristis*/
/*akoma kai an den einai idio dld i kalyteri mhxani anazitisis na epistrefetai me to mixani anazitisis */
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function searchURL_by_title_desc($title,$desc,$x)
{
	$final=array();
	$y=0;

	$conn=db_connect();
	//anazitisi me vasi to pio dimofili
	if($x==0)
	{
		$y=0;
		$url_select=mysql_query("SELECT * FROM bookmark where title like '%$title%' AND description like '%$desc%' ORDER BY views DESC");
	}
	else
	{
		$y=1;
		$url_select=mysql_query("SELECT * FROM bookmark where title like '%$title%' AND description like '%$desc%' ORDER BY modified ASC");
	}


	if(!$url_select)
		throw new Exception('Συνέβει κάποιο σφάλμα κατά τον έλεγχο για το url που καταχωρήσατε');

	if(mysql_num_rows($url_select)>0)
	{
		$num_results=mysql_num_rows($url_select);
		
		for($i=0; $i<$num_results; $i++)
		{
			$row=mysql_fetch_row($url_select);
			$final[$i]=$row[0];
		}
		array_push($final,$title);
		array_push($final,$desc);
	}
	
	mysql_close();
	//search_url_by_id($final,1,$y);
	
	if(count($final)>0)
	{	
		//echo 'hello';
		//find_tags($farray);	
		search_url_by_id($final,1,$y);		
	}
	else
	{
		echo "<h2>Αποτέλεσματα αναζήτησης</h2>";
		?>
		</br>
		<?php
		echo '<h3>Δεν βρέθηκε σελιδοδείκτης με τον τίτλο και την περιγραφή που δώσατε!</h3>';
	}
		
}


/*********************************************************************************************************
* synartisi gia tin anazitisi enos url apo ti vasi dedomenwn me vasi tis etiketes
**********************************************************************************************************/

function searchURL_by_tags($tag1,$x)
{
	
	$farray=array();
	$y=0;
	/*
	//xwrizoume ta tags me vasi to keno kai ta apothikeuoume ston pinaka $tag_array
	//$tag_array=explode(" ",$tags);

	$elements=count($tags);

	for($i=0; $i<$elements; $i++)
	{
		$tags[$i]=mysql_real_escape_string($tags[$i]);
	}
	*/
	
	$conn=db_connect();
	
	//for($i=0; $i<$elements; $i++)
	//{
		//$result=mysql_query("SELECT bkmark_id FROM tags WHERE tag='$tag_array[$i]'");
		//emfanisi apotelesmatwn me vasi to pio dimofili!!
	if($x==0)
	{
		$result=mysql_query("SELECT * FROM tags,bookmark WHERE tag='$tag1' AND bkmark_id=bookmark_id ORDER BY views DESC");
		$y=0;
	}
	else
	{
		$result=mysql_query("SELECT * FROM tags,bookmark WHERE tag='$tag1' AND bkmark_id=bookmark_id ORDER BY modified ASC");
		$y=1;
	}
		
	if(mysql_num_rows($result)>0)
	{
		$num_results=mysql_num_rows($result);
		
		for($j=0; $j<$num_results; $j++)
		{
			$row=mysql_fetch_array($result);
				
			$farray[count($farray)]=$row[1];
		}
		//$farray[count($farray)]=-1;
		array_push($farray,$tag1);
	}
	//}

	mysql_close();	

	
	if(count($farray)>0)
	{	
		//echo 'hello';
		//find_tags($farray);	
		search_url_by_id($farray,0,$y);		
	}
	else
	{
	?>
	
      <div class="mainbar">
        <div class="article">
			<h2><span>Αποτέλεσματα αναζήτησης</span></h2>
			</br>
			<h3>Δεν βρέθηκε σελιδοδείκτης με τις ετικέτες που δώσατε!</h3>
			</br></br>
		</div>
	</div>
	<?php
	}
	
}


/*********************************************************************************************************
* synartisi gia tin euresi twn id twn selidodeiktwn me vasi tin anazitisi me tis etiketes
**********************************************************************************************************/
/*
function find_tags($farray)
{
	
	$array1=array();
	$array2=array();
	$final=array();
	$l=0;

	echo '<h1>Αποτελέσματα αναζήτησης</h1>';
	
	//anazitisi mono me mia etiketa
	search_url_by_id($farray);
	
	
	//anazitisi me ena i perissoteres etiketes
	
	for($i=0; $i<count($farray); $i++)
	{
		if($farray[$i]==-1)
		{
			$l++;
		}
	}
	

	if($l==1)	
	{
		search_url_by_id($farray);
	}

	if($l==2)
	{
		for($i=count($farray); $i>0; $i--)
		{
			$elem=array_pop($farray);
		
		
			if($elem==-1)
			{
				$l--;
				$x=0;
			}
			else{

				if($l==1)
				{
					$array1[$x]=$elem;
					$x++;
				}
			
				if($l==0)
				{
					$array2[$x]=$elem;
					//echo 'hello';
					$x++;
				}
			}
		}

			
	
		
		for($i=0; $i<count($array1); $i++)
		{
			$a=$array1[$i];
			for($j=0; $j<count($array2); $j++)
			{
				$b=$array2[$j];
		
				if($a==$b)
				{
					$final[$l]=$a;
					$l++;
				}
			}
		}

		if(count($final)==0)
		{
			echo 'Δεν υπάρχουν σελιδοδείκτες με βάση τις ετικέτες που δώσατε!';			
		}
		else
		{
			search_url_by_id($final);
		}
	
	}
	
	if($l>2)
	{
		$y=$l;
		$f=0;
	
		while($y<=$l && $y>=$l-2)
		{
			$elem=array_pop($farray);
						
			if($elem==-1)
			{
				$x=0;
				$y=$y-1;
			}
			
			if(($elem!=-1) && ($y==$l-1))
			{
				$array1[$x]=$elem;
				$x++;
			}

			if(($elem!=-1) && ($y==$l-2))
			{
				$array2[$x]=$elem;
				$x++;
			}
		}

		for($i=0; $i<count($array1); $i++)
		{
			$a=$array1[$i];
			for($j=0; $j<count($array2); $j++)
			{
				$b=$array2[$j];
				if($a==$b)
				{
					$final[$f]=$a;
					$f++;
				}
			}
		}

		$example=array();
		
		if(count($final)==0)
		{
			echo 'Δεν υπάρχουν σελιδοδείκτες με βάση τις ετικέτες που δώσατε!';			
		}
		else
		{
		
			search_url_by_id($final);
		}
	}	
}
*/

/*********************************************************************************************************
* synartisi gia tin anazitisi enos selidodeikti apo ti vasi dedomenwn me vasi ton id tou
**********************************************************************************************************/

function search_url_by_id($final,$k,$y)
{

?>

    <div class="mainbar">
        <div class="article">
			<h2 align="center"><span>Αποτελέσματα αναζήτησης</span></h2>
			<div class="clr"></div>
        </div>

<?php
	
	$td=array();
	
	/*
	for($d=0; $d<count($final); $d++)
	{
		if($final[$d]==-1)
			$t=0;
		else
			$t=1;
	}
	
	//afairoume ta -1 apo ti list me ta ids
	if($t==0)
		$final = array_diff($final, array(-1));
	*/
	
	if($k==0)
	{
		$tag=array_pop($final);
		//echo $tag;
	}
	if($k==1)
	{
		$desc=array_pop($final);
		$title=array_pop($final);
		array_push($td,$title);
		array_push($td,$desc);
	}
	
	
	
	if($k==0)
	{
		if($y==0)
		{	
		?>
			<div class="article">
				<h2><a href="search_new_famous.php?var=<?php echo $tag; ?>&var1=1">Εμφάνιση αποτελεσμάτων με βάση το πιο πρόσφατο!</a></h2>
				<div class="clr"></div>
			</div>
		<?php
		}
		else
		{
		?>
			<div class="article">
				<h2><a href="search_new_famous.php?var=<?php echo $tag; ?>&var1=0">Εμφάνιση αποτελεσμάτων με βάση το πιο δημοφιλή!</a></h2>
				<div class="clr"></div>
			</div>
		<?php
		}
	}
	elseif($k==1)
	{
		if($y==0)
		{	
		?>
			<div class="article">
				<h2><a href="search_new_famous_td.php?var=<?php echo $title; ?>&var1=<?php echo$desc; ?>&var2=1">Εμφάνιση αποτελεσμάτων με βάση το πιο πρόσφατο!</a></h2>
				<div class="clr"></div>
			</div>
		<?php
		}
		else
		{
		?>
			<div class="article">
				<h2><a href="search_new_famous_td.php?var=<?php echo $title; ?>&var1=<?php echo$desc; ?>&var2=0">Εμφάνιση αποτελεσμάτων με βάση το πιο δημοφιλή!</a></h2>
				<div class="clr"></div>
			</div>
		<?php
		}
	}

	$x=0;
		
	//allagi kai sti synartisi paging_for_search()
	$index_per_page=15;

	
	if(count($final)<$index_per_page)
	{
		for($s=0; $s<count($final); $s++)
		{
		$conn=db_connect();
		$url_result=mysql_query("SELECT bookmark_id,title,url,user_id FROM bookmark where bookmark_id='$final[$s]'");
		//kleisimo tis vasis dedomenwn
		mysql_close();
		
		if(!$url_result)
			throw new Exception('Συνέβει κάποιο σφάλμα κατά την αναζήτηση του url');
	
		//emfanisi twn apotelesmatwn anazitisis
		if(mysql_num_rows($url_result)>0)
		{
			$row=mysql_fetch_row($url_result);
			
			?>
			<div class="article">
				<div class="clr"></div>
				<div class="comment"> <a href="#"><img src="CSS/images/bkm.png" width="80" height="80" alt="" class="userpic" /></a>
					<p>Τίτλος: <?php echo $row[1]; ?> <br />
					URL: <?php echo $row[2]; ?><br />

			
			<?php
			if(isset($_SESSION['valid_user'])) 
			{
				$x=1;
				?>
				Σελιδοδείκτης καταχωρημένος απο τον χρήστη: <?php echo $row[3]; ?> <br />

				<?php
			}
			?>
			<h3><a href="bookmark.php?var=<?php echo $row[0]; ?> "> Εμφάνιση </a> </h3>
			<?php
			
				?>
				</div>				
			</div>
			<?php
		}
		}
	}
	else
	{
		?>
			<div class="article">
				<div class="clr"></div>
		<?php
		
		for($i=0; $i<$index_per_page; $i++)
		{
			//sundesi me ti vasi dedomenwn kalwntas ti synartisi db_connect()	
			$conn=db_connect();
			$url_result=mysql_query("SELECT bookmark_id,title,url,user_id FROM bookmark where bookmark_id='$final[$i]'");
			//kleisimo tis vasis dedomenwn
			mysql_close();
	
	
			if(!$url_result)
				throw new Exception('Συνέβει κάποιο σφάλμα κατά τον αναζήτηση του url');
	
			//emfanisi twn apotelesmatwn anazitisis
			if(mysql_num_rows($url_result)>0)
			{
				$row=mysql_fetch_row($url_result);
				
				?>
				<div class="comment"> <a href="#"><img src="CSS/images/bkm.png" width="80" height="80" alt="" class="userpic" /></a>
					<p>Τίτλος: <?php echo $row[1]; ?> <br />
					URL: <?php echo $row[2]; ?><br />
				
				<?php
				if(isset($_SESSION['valid_user'])) 
				{
					$x=1	
				?>	
				Σελιδοδείκτης καταχωρημένος απο τον χρήστη: <?php echo $row[3]; ?> <br />
				<?php
				}	
				?>
				<h3><a href="bookmark.php?var=<?php echo $row[0]; ?> "> Εμφάνιση </a> </h3>
				</div>
				<?php
			}	
		}
		?>
		</div>
		<?php
	}
	
	$page=1;
	if($k==0)
		paging($final,$page,$tag,$y);
	elseif($k==1)
		paging($final,$page,$td,$y);
	else
		paging($final,$page,-1,-1);
	?>
	</div>
	<?php
}

/*********************************************************************************************************
* synartisi gia tin emfanisi twn 10 pio prosfatwn selidodeiktwn
**********************************************************************************************************/

function recent_urls()
{
	$recent_url=array();
	$sum=0;
	
	//sundesi me ti vasi dedomenwn kalwntas ti synartisi db_connect()	
	$conn=db_connect();
	
	$url_result=mysql_query("SELECT title,url FROM bookmark ORDER BY modified DESC");
	
	mysql_close();
	
	if(!$url_result)
	{
		throw new Exception('Δεν είναι δυνατόν να παρουσιαστούν οι νεότεροι σελιδοδείκτες');
	}
	
	if(mysql_num_rows($url_result)>0)
	{
		$num_result=mysql_num_rows($url_result);	
		
		
			
		for($i=0; $i<$num_result; $i++)
		{
			$row=mysql_fetch_row($url_result);
				
			$x=0;
			
			
			//apothikeusi toy pio prosfatou selidodeikti ston pinaka
			if((count($recent_url))==0)
			{
				$recent_url[0]=$row[0];
				$recent_url[1]=$row[1];
				$sum=$sum+2;
			}
			else if($sum<20)
			{
				for($j=0; $j<count($recent_url); $j++)
				{
					if($j%2!=0)
					{
						if($recent_url[$j]==$row[1])
						{
							$x=1;
						}
					}
				}
					
				if($x==0)
				{
					$size=count($recent_url);
					$recent_url[$size]=$row[0];
					$recent_url[($size+1)]=$row[1];
					$sum=$sum+2;
				}
			}
		}
		
		for($i=0; $i<count($recent_url); $i+=2)
		{
			$url=$recent_url[$i+1];
			$j=$i+1;
			echo "<td><a href='famous_ten.php?var=$url'>$recent_url[$i]<br/>$recent_url[$j]</a></td>";
			echo '<br/>';
			echo '<br/>';
		}
	}
}

/*********************************************************************************************************
* synartisi gia tin diagrafi selidodeiktwn me vasi to onoma xristi kai to url tou selidodeikti
**********************************************************************************************************/

function delete_bkm($username,$url)
{
		//diagrafi tags
		delete_tags($url);
				
			
		//diagrafi selidodeikti apo ti vasi dedoemenwn
		$conn=db_connect();
		
		
		$del_bkm=mysql_query("DELETE FROM bookmark where bookmark_id='$url'");
		//echo 'hello';
		
		mysql_close();
		
		if(!$del_bkm)
		{
			throw new Exception('Δεν έγινε η διαγραφή του σελιδοδείκτη.Παρακαλώ δοκιμάστε αργότερα.');
		}
}

/*********************************************************************************************************
* synartisi gia tin diagrafi twn etiketwn me vasi to id tou url tou selidodeikti
**********************************************************************************************************/

function delete_tags($id_bkm)
{
	$conn=db_connect();
	
	$del_tag=mysql_query("DELETE FROM tags where bkmark_id='$id_bkm'");
	
	mysql_close();
	
	if(!$del_tag)
	{
			throw new Exception('Δεν έγινε η διαγραφή των ετικετών.Παρακαλώ δοκιμάστε αργότερα.');
	}
	
}


/*********************************************************************************************************
* synartisi gia tin emfanisi twn stoixeiwn syndesis enos xristi
**********************************************************************************************************/

function UserData($username)
{


	//anaktisi twn stoixeiwn tou xristi apo ti vasi dedomenwn
	$conn=db_connect();
	$data=mysql_query("SELECT * FROM users where username='$username'");
	mysql_close();
	
	if(!$data)
	{
			throw new Exception('Υπάρχει κάποιο πρόβλημα με την ανάκτηση των στοιχείων σας από τη βάση δεδομένων.Παρακαλώ δοκιμάστε αργότερα!');
	}
	
	$row=mysql_fetch_row($data);
	?>

	<div class="mainbar">
		<div class="article">
			<h2><span>Επεξεργασία προφίλ </span></h2>
			<div class="clr"></div>
        </div>
		<div class="article">
			</br></br>
			<h2><span>Στοιχεία σύνδεσης</span></h2>
			<div class="clr"></div>
            <ol>
				<li>
					<h3><b>Όνομα χρήστη:</b> <?php echo $username; ?> </h3>
				</li>
				<li>
					<h3><b>E-mail:</b> <?php echo $row[2]; ?> </h3>
				</li>
				<li>
					<?php
					
					if($row[3]=='U')
					{
						?>
						<h3><b>Τύπος χρήστη: </b> Εγγεγραμένος χρήστης</h3>
						<?php
					}
						else
					{
						?>
						<h3><b>Τύπος χρήστη: </b> Διαχειριστής</h3>
						<?php
					}
					
					?>
				</li>
            </ol>
			</br>	
        </div>
	</div>
		
	
	
	
<?php	
}

/*********************************************************************************************************
* synartisi gia tin allagi tou email enos xristi
**********************************************************************************************************/

function modifyEmail($username,$email)
{
	
	$conn=db_connect();
	$new_email=mysql_query("UPDATE users SET email='$email' where username='$username'");
	mysql_close();
	
	if(!$new_email)
	{
			throw new Exception('Υπάρχει κάποιο πρόβλημα με την αλλαγή του email σας.Παρακαλώ δοκιμάστε αργότερα!');
	}
	
	?>

	<div class="mainbar">
		<div class="article">
			<h3><span>Η αλλαγή του e-mail σας έγινε με επιτυχία!</span></h3>
			<div class="clr"></div>
		</div>
		<div class="article">
			<h2><span> <a href='myprofil.php'>Επιστροφή</a> </span></h2>
			<div class="clr"></div>
		</div>
	</div>
	
	<?php
}

/*********************************************************************************************************
* synartisi me tin opoia pernoyme ton kwdiko enos xristi
**********************************************************************************************************/

function get_pass($username)
{
	$conn=db_connect();
	$pass=mysql_query("SELECT password FROM users where username='$username'");
	mysql_close();
	
	if(!$pass)
	{
			throw new Exception('Υπάρχει κάποιο πρόβλημα με την αλλαγή του κωδικού σας.Παρακαλώ δοκιμάστε αργότερα!');
	}
	
	$row=mysql_fetch_row($pass);
	return $row[0];
}


/*********************************************************************************************************
* synartisi me tin opoia allazoume ton kwdiko enos xristi
**********************************************************************************************************/

function modifyPassword($username,$pass)
{
	//kruptografisi toy palioy kwdikou tou xristi
	$kpass=sha1($pass);
	
	$conn=db_connect();
	$new_pass=mysql_query("UPDATE users SET password='$kpass' where username='$username'");
	mysql_close();
	
	if(!$pass)
	{
			throw new Exception('Υπάρχει κάποιο πρόβλημα με την αλλαγή του κωδικού σας.Παρακαλώ δοκιμάστε αργότερα!');
	}
	
	?>
	
	<div class="mainbar">
		<div class="article">
			<h3><span>Η αλλαγή του κωδικού σας έγινε με επιτυχία!</span></h3>
			<div class="clr"></div>
		</div>
		<div class="article">
			<h2><span> <a href='myprofil.php'>Επιστροφή</a> </span></h2>
			<div class="clr"></div>
		</div>
	</div>
	
	
	<?php
}


/*********************************************************************************************************
* synartisi me tin opoia epistrefontai ta stoixeia twn xristwn poy einai apothikeumenoi sto systima
**********************************************************************************************************/
function find_users()
{
	$username=array();
	$email=array();
	$type=array();
	
	$conn=db_connect();
	$users=mysql_query("SELECT username,email,user_type FROM users");
	mysql_close();
	
	if(!$users)
	{
		throw new Exception('Υπήρξε κάποιο πρόβλημα με την ανάκτηση των χρηστών από το σύστημα.Παρακαλώ προσπαθήστε αργότερα.');
	}
	
	if(mysql_num_rows($users)>0)
	{
		$num=mysql_num_rows($users);
		for($i=0; $i<$num; $i++)
		{
			$row=mysql_fetch_row($users);
			
			$username[count($username)]=$row[0];
			$email[count($email)]=$row[1];
			$type[count($type)]=$row[2];
		}
		
		dispUsers($username,$email,$type);
	}	
}

/*********************************************************************************************************
* synartisi me tin opoia epistrefontai ta stoixeia enos selidodeikti poy einai apothikeumenoi sto systima
**********************************************************************************************************/

function find_url_id($id)
{
	$conn=db_connect();
	$bkm=mysql_query("SELECT bookmark_id,title,url,description,views,modified,user_id,clean FROM bookmark where bookmark_id='$id'");
	$cmts=mysql_query("SELECT commnt_id,comment,person_id,modified,comment_number,clean FROM comments where bookmrk_id='$id'");
	$tags=mysql_query("SELECT tag FROM tags where bkmark_id='$id'");
	//ayxisi twn provolwn kathe selidodeikti
	$upd_bkm=mysql_query("UPDATE bookmark SET views=views+1 where bookmark_id='$id'");
	mysql_close();
	
	if(!$bkm)
	{
		throw new Exception('Υπήρξε κάποιο σφάλμα κατά την προσπέλαση του σελιδοδείκτη από τη βάση δεδομένων');
	}
	
	if(!$cmts)
	{
		throw new Exception('Υπήρξε κάποιο πρόβλημα με την προσπέλαση των σχολίων του σελιδοδείκτη');
	}
	
	if(!$tags)
	{
		throw new Exception('Υπήρξε κάποιο πρόβλημα με των ετικετών του σελιδοδείτκη');
	}
	
	$row=mysql_fetch_row($bkm);
	//$row1=mysql_fetch_row($cmts);
	
	//$num=mysql_num_rows($cmts);
	//echo 'hello';
	//echo $num;
	
	dispURL($row,$cmts,$tags);
}

/*********************************************************************************************************
* synartisi me tin opoia epistrefontai oloi oi selidodeiktes me to idio url
**********************************************************************************************************/

function find_with_url($url)
{
	dispHeader();
	?>
	
	<div class="mainbar">
		<div class="article">
			<h2 >Σελιδοδείκτες που σχετίζονται με τη διεύθυνση: <h2 align="center"><a href="http://<?php echo $url;?>" target="_blank"> <?php echo $url;?>  </a></h2></h2>
			<div class="clr"></div>
		</div>
		
	<?php
	

	

	$conn=db_connect();
	$result=mysql_query("SELECT bookmark_id,title,url,user_id FROM bookmark WHERE url='$url'");
	mysql_close();
	
	if(!$result)
	{
		throw new Exception('Υπήρξε κάποιο πρόβλημα με τον εντοπισμό του σελιδοδείκτη από τη βάση δεδομένων');
	}
	
	if(mysql_num_rows($result)>0)
	{
		?>
		<div class="article">
			<h2><span></span> Αποτελέσματα</h2>
			<div class="clr"></div>
		<?php

		$num=mysql_num_rows($result);
		for($i=0; $i<$num; $i++)
		{
			$row=mysql_fetch_row($result);
			
			?>
			<div class="comment"> <a href="#"><img src="CSS/images/bkm.png" width="80" height="80" alt="" class="userpic" /></a>
				<p>Τίτλος: <?php echo $row[1]; ?><br />
				URL: <?php echo $row[2]; ?><br />
				<?php
				if(isset($_SESSION['valid_user'])) 
				{
				?>
					Σελιδοδείκτης καταχωρημένος απο τον χρήστη: <?php echo $row[3];?> <br />
				<?php
				}
				?>
				<h3><a href="bookmark.php?var=<?php echo $row[0]; ?>"> Εμφάνιση</a></p></h3>
			</div>			
			
		<?php			
		}
		?>
		</div>
		<?php
	}
	?>
	</div>
	<?php
	dispFooter();
}

/*********************************************************************************************************
* synartisi gia tin emfanisi twn 10 pio dimofilwn selidodeiktwn
**********************************************************************************************************/

function famous_urls()
{
	$famous_url=array();
	$sum=0;
	
	$conn=db_connect();
	$result=mysql_query("SELECT title,url,sum(views) FROM bookmark GROUP BY url ORDER BY sum(views) DESC");
	mysql_close();
	
	if(!$result)
	{
		throw new Exception('Δεν είναι δυνατόν να παρουσιαστούν οι νεότεροι σελιδοδείκτες');
	}
	
	if(mysql_num_rows($result)>0)
	{
		$num_result=mysql_num_rows($result);	
		//echo $num_result;
		
		
		for($i=0; $i<$num_result; $i++)
		{
			$row=mysql_fetch_row($result);
		
			if(count($famous_url)<20)
			{
				$size=count($famous_url);
				$famous_url[$size]=$row[0];
				$famous_url[$size+1]=$row[1];
			}
		}
	}

	for($i=0; $i<(count($famous_url)); $i+=2)
	{
		$j=$i+1;
		$url=$famous_url[$j];
		
		echo "<td><a href='famous_ten.php?var=$url'>$famous_url[$i]<br/>$famous_url[$j]</a></td>";
		echo '<br/>';
		echo '<br/>';
	}
}

/*********************************************************************************************************
* synartisi gia tin dimiourgia tou tag cloud

http://stevethomas.com.au/php/how-to-make-a-tag-cloud-in-php-mysql-and-css.html

**********************************************************************************************************/

function tag_cloud()
{
	$max=-1;
	$min=100000;

	$conn=db_connect();
	//vriskoyme tin syxnotita emfanisis kathe selidodeikti
	$result=mysql_query("SELECT tag,count(tag) FROM tags GROUP BY tag");
	mysql_close();
	

	if(!$result)
	{
		throw new Exception('Συνέβει κάποιο σφάλμα κατά την προσπέλαση των σελιδοδεικτών');
	}
	
	if(mysql_num_rows($result)>0)
	{
		$num_result=mysql_num_rows($result);
		
		//echo $num_result;
		//echo '<br/>';
		
		for($i=0; $i<$num_result; $i++)
		{
			$row=mysql_fetch_row($result);
			
			//euresi megistis timis
			if($max<$row[1])
			{
				$max=$row[1];
			}
			//euresi elaxistis timis
			if($min>$row[1])
			{
				$min=$row[1];
			}
			
			$terms[]=array('term'=>$row[0], 'counter'=>$row[1]);
		}
		
		//shuffle($terms);

		echo "<div id=\"tagcloud\">\n";
		foreach($terms as $term)
		{
			$percent=floor(($term['counter']/$max)*100);
		
			if($percent<20)
			{
				$class='smallest';
			}
			elseif($percent>=20 and $percent<40)
			{
				$class='small';
			}
			elseif($percent>=40 and $percent<60)
			{
				$class='large';
			}
			else
			{
				$class='largest';
			}
			
			$element=urlencode($term['term']);
			//echo $term;
			echo "<span class=\"$class\"><a href='tag_cloud.php?var=$element'>".$term['term']."</a></span>\n";
			//echo '<br/>';
		}
		echo "</div>";
	}
}

/*********************************************************************************************************
* synartisi gia tin euresi selidodeiktwn me vasi mia etiketa apo to tag cloud
**********************************************************************************************************/

function  find_with_tag($tag)
{
	$final=array();
	
	$conn=db_connect();
	$result=mysql_query("SELECT bkmark_id FROM tags WHERE tag='$tag'");
	mysql_close();
	
	if(!$result)
	{
		throw new Exception('Συνέβει κάποιο σφάλμα κατά την προσπέλαση των ετικετών');
	}
	
	
	if(mysql_num_rows($result)>0)
	{
		
		$num_result=mysql_num_rows($result);
		
		for($i=0; $i<$num_result; $i++)
		{
			$row=mysql_fetch_row($result);
			
			array_push($final,$row[0]);
			//search_url_by_id($row[0]);
		}
		
		search_url_by_id($final,-1,-1);
	}
	
}

/*********************************************************************************************************
* synartisi gia tin apothikeusi twn sxoliwn twn selidodeiktwn sti vasi dedomenwn
**********************************************************************************************************/

function add_comment($comment,$val_user,$id)
{

	$x=0;
	
	$conn=db_connect();
	$result=mysql_query("SELECT * FROM comments where comment='$comment' AND person_id='$val_user' AND bookmrk_id='$id'");
	mysql_close();

	if(mysql_num_rows($result)>0)
	{
		$x=1;
	}
	
	if($x==0)
	{
		
		$conn1=db_connect();
		$result1=mysql_query("SELECT * FROM comments where bookmrk_id='$id'");
		mysql_close();
		$num=mysql_num_rows($result1);		
		
		if ($num>0)
		{
			$num=$num+1;
			$conn2=db_connect();
			$result2=mysql_query("INSERT INTO comments (comment,person_id,bookmrk_id,comment_number) VALUES ('$comment','$val_user','$id','$num')");
			mysql_close();

			if(!$result2)
			{
			
				throw new Exception('Συνέβει κάποιο λάθος κατά την αποθέκευση του σχολίου στη βάση δεδομένων.');
			}
			else
			{
				echo '<br/>';
				echo 'Το σχολιό σας αποθηκεύτηκε επιτυχώς στην βάση δεδομένων';
			}
		}
		else
		{
			$conn3=db_connect();
			$result3=mysql_query("INSERT INTO comments (comment,person_id,bookmrk_id,comment_number) VALUES ('$comment','$val_user','$id','1')");
			mysql_close();

			if(!$result3)
			{
			
				throw new Exception('Συνέβει κάποιο λάθος κατά την αποθέκευση του σχολίου στη βάση δεδομένων.');
			}
			else
			{
				echo '<br/>';
				echo 'Το σχολιό σας αποθηκεύτηκε επιτυχώς στην βάση δεδομένων';
			}
		}

	}
	else
	{
		echo '<br/>';
		echo 'Το σχολιό σας είναι ήδη αποθηκευμένο!';
	}
}

/*********************************************************************************************************
* synartisi gia tin apothikeusi ton vathmologion ton selidodeikton sti vasi dedomenon
**********************************************************************************************************/

function rate_bkm($rate,$val_user,$id)
{
	$x=0;
	
	$conn1=db_connect();
	$result1=mysql_query("SELECT * FROM marks where id_user='$val_user' AND id_bkmark='$id'");
	mysql_close();
	if(mysql_num_rows($result1)>0)
	{
		$x=1;
	}
	
	if($x==0)
	{
		$conn=db_connect();
		$result=mysql_query("INSERT INTO marks (mark,id_user,id_bkmark) VALUES ('$rate','$val_user','$id')");
		mysql_close();
		
		if(!$result)
		{
			
			throw new Exception('Συνέβει κάποιο λάθος κατά την αποθέκευση της βαθμολογίας στη βάση δεδομένων.');
		}
		else
		{
			echo '<br/>';
			echo 'Η βαθμολογία σας αποθηκεύτηκε επιτυχώς';
		}
	}
	else
	{
		echo '<br/>';
		echo 'Έχετε ήδη βαθμολογήσει αυτόν τον σελιδοδείκτη!';
	}
}


/*********************************************************************************************************
* synartisi gia tin euresi tou selidodeikti pros tropopoiisi
**********************************************************************************************************/

function find_url_mod($id)
{
	$conn=db_connect();
	$result=mysql_query("SELECT * FROM bookmark where bookmark_id='$id'");
	$upd_bkm=mysql_query("UPDATE bookmark SET views=views+1 where bookmark_id='$id'");
	$tags=mysql_query("SELECT tag FROM tags where bkmark_id='$id'");
	$tags1=mysql_query("SELECT tag FROM tags where bkmark_id='$id'");
	mysql_close();
	
	if(!$result)
	{
		echo 'Υπήρξε κάποιο πρόβλημα με την εύρεση αυτής τησ καταχώρησης';
	}
	
	
	$row=mysql_fetch_row($result);
	
	dispModifyBkm($row,$id,$tags,$tags1);
	
}

/*********************************************************************************************************
* synartisi gia tin allagi tou titlou kapoias kataxwrisis
**********************************************************************************************************/

function modifyTitle($id,$title)
{
	$conn=db_connect();
	$result=mysql_query("UPDATE bookmark SET title='$title' WHERE bookmark_id='$id'");
	mysql_close();
	
	if(!$result)
	{
		throw new Exception('Υπήρξε κάποιο πρόβλημα με την αλλαγή του τίτλου.');
	}
	
	//echo 'Η αλλαγή του τίτλου του σελιδοδείκτη σας έγινε με επιτυχία';
	
	find_url_mod($id);
}

/*********************************************************************************************************
* synartisi gia tin allagi tou url kapoias kataxwrisis
**********************************************************************************************************/

function modifyURL($id,$url)
{
	$x=0;
	
	//tropopoioume to url wste na xekinaei apo www.
	if(@ereg("^http://www.",$url))
	{
		$url=explode("http://",$url);
		$x=1;
	}

	$conn=db_connect();
	
	if($x==1)
		$result=mysql_query("UPDATE bookmark SET url='$url[1]' WHERE bookmark_id='$id'");
	else
		$result=mysql_query("UPDATE bookmark SET url='$url' WHERE bookmark_id='$id'");
	mysql_close();
	
	if(!$result)
	{
		throw new Exception('Υπήρξε κάποιο πρόβλημα με την αλλαγή του url.');
	}
	
	//echo 'Η αλλαγή του τίτλου του σελιδοδείκτη σας έγινε με επιτυχία';
	find_url_mod($id);
}

/*********************************************************************************************************
* synartisi gia tin allagi tis perigrafis kapoias kataxwrisis
**********************************************************************************************************/

function modifyDesc($desc,$id)
{
		
	$conn=db_connect();
	$result=mysql_query("UPDATE bookmark SET description='$desc' WHERE bookmark_id='$id'");
	mysql_close();
	
	if(!$result)
	{
		throw new Exception('Υπήρξε κάποιο πρόβλημα με την αλλαγή της περιγραφής του σελιδοδείκτη.');
	}
	
	//echo 'Η αλλαγή του τίτλου του σελιδοδείκτη σας έγινε με επιτυχία';
	
	find_url_mod($id);
}

/*********************************************************************************************************
* synartisi gia tin prothiki tags se kapoia kataxwrisi
**********************************************************************************************************/

function modifyAddTag($id,$tag)
{
	//$tag_array=explode(",",$tag);
	
	//$element=count($tag_array);
	//echo $element;
	//for($i=0; $i<$element; $i++)
	//{
		$tag=mysql_real_escape_string($tag);
	
		//echo $tag_array[$i];
		echo '<br/>';
		$conn=db_connect();
		$exist=mysql_query("SELECT * FROM tags where bkmark_id='$id' AND tag='$tag'");
		
		if(!$exist)
		{
			throw new Exception('Υπήρξε κάποιο πρόβλημα με την προσθήκη του tag.');
		}
		
		if(mysql_num_rows($exist)==0)
		{
			$result=mysql_query("INSERT INTO tags(bkmark_id,tag) VALUES ('$id','$tag')");
		}
		mysql_close();
	

		if(mysql_num_rows($exist)==0)
		{
			if(!$result)
			{
				throw new Exception('Υπήρξε κάποιο πρόβλημα με την προσθήκη του tag.');
			}
		}
		
		$conn=db_connect();
		$exist1=mysql_query("SELECT * FROM autocomplete where val='$tag'");
		
		if(!$exist1)
		{
			throw new Exception('Υπήρξε κάποιο πρόβλημα με την προσθήκη του tag.');
		}
		
		
		if(mysql_num_rows($exist1)==0)
		{
			$result2=mysql_query("INSERT INTO autocomplete (val) VALUES ('$tag')");
			if(!$result2)
				throw new Exception('Δεν έγινε επιτυχής απποθήκευση των tags στο σύστημα.Παρακαλώ δοκιμάστε αργότερα');	
		}
		
		mysql_close();
		
		
	//}
	find_url_mod($id);
}

/*********************************************************************************************************
* synartisi gia tin diagrafi tags se kapoia kataxwrisi
**********************************************************************************************************/

function delete_tags_sep($id_bkm,$tag)
{
	$conn=db_connect();
	$del_tag=mysql_query("DELETE FROM tags WHERE bkmark_id='$id_bkm' AND tag='$tag'");
	$exist_tag=mysql_query("SELECT * FROM tags WHERE tag='$tag'");
	mysql_close();
	
	if(!$del_tag || !$exist_tag)
	{
			throw new Exception('Δεν έγινε η διαγραφή των ετικετών. Παρακαλώ δοκιμάστε αργότερα.');
	}
	
	//to tag den yparxei pleon ston pinaka tag-->to diagrafoume apo ton pinaka auto complete
	if(mysql_num_rows($exist_tag)==0)
	{
		$conn=db_connect();
		$del_autag=mysql_query("DELETE FROM autocomplete WHERE val='$tag'");
		mysql_close();
		
		if(!$del_autag)
		{
			throw new Exception('Δεν έγινε η διαγραφή των ετικετών. Παρακαλώ δοκιμάστε αργότερα.');
		}
	}
	
	
	
	
}

/*********************************************************************************************************
* synartisi gia tin diagrafi selidodeikti
**********************************************************************************************************/

function delBkm($id)
{
	$conn=db_connect();
	$result=mysql_query("DELETE FROM bookmark where bookmark_id='$id'");
	mysql_close();
	
	if(!$result)
	{
			throw new Exception('Δεν έγινε η διαγραφή του σελιδοδείκτη. Παρακαλώ δοκιμάστε αργότερα.');
	}
	
}



/*********************************************************************************************************
* synartisi mesw tis opoias tha vriskoume to meso oro tis vathmologias enos selidodeikti					 *
**********************************************************************************************************/

function cal_rate($id)
{
	//echo $id;
	
	$conn=db_connect();
	//$result=mysql_query("SELECT SUM(mark),COUNT(mark) FROM marks  WHERE id_bkmark='$id GROUP BY id_bkmark'");
	$result=mysql_query("SELECT SUM(mark),COUNT(mark) FROM marks where id_bkmark='$id' GROUP BY id_bkmark");
	mysql_close();
	
	if(!$result)
	{
			throw new Exception('Συνέβει κάποιο λάθος με την εμφάνιση της βαθμολογίας του σελιδοδείκτη.');
	}
	
	//echo sum;
	//echo count;
	
	if(mysql_num_rows($result)>0)
	{
		$num=mysql_num_rows($result);
	
		$row=mysql_fetch_row($result);
		
		//meso oro vathmologias
		$rate=$row[0]/$row[1];
		
		echo $rate."/5    (Βαθμολόγησαν: ".$row[1]." άτομα)";		
		
		
		

	
	}
}

/*********************************************************************************************************
* synartisi mesw tis opoias apothikeuoume mia anafora gia selidodeikti									 *
**********************************************************************************************************/
function bad_bkm($user,$id)
{
		
	$conn=db_connect();	
	$result2=mysql_query("SELECT * FROM contents_bkm WHERE id_person='$user' AND id_bookmrk='$id'");
	mysql_close();
	
	if(mysql_num_rows($result2)==0)
	{
		$conn=db_connect();
		$result1=mysql_query("UPDATE bookmark SET clean='no' WHERE bookmark_id='$id'");
		$result=mysql_query("INSERT INTO contents_bkm (id_person,id_bookmrk) VALUES ('$user','$id')");
		mysql_close();
		
	
		if(!$result&&!$result1)
		{
			throw new Exception('Συνέβει κάποιο λάθος με την αναφορά του σελιδοδείκτη.Προσπαθήστε αργότερα');
		}
		
		echo '<br/>';
		echo 'Η αναφορά που κάνατε αποθηκεύτηκε και θα ελεχθεί από κάποιο διαχειριστη!';
		echo '<br/>';
	}
	else
	{
		echo '<br/>';
		echo 'Έχετε κάνει ήδη αναφορά για αυτόν τον σελιδοδείκτη και εκρεμμεί να ελενχθεί από τον διαχειριστή!';
		echo '<br/>';
	}
	
	if(!$result2)
	{
		throw new Exception('Συνέβει κάποιο λάθος με την αναφορά του σελιδοδείκτη.Προσπαθήστε αργότερα');
	}
	
}

/*********************************************************************************************************
* synartisi mesw tis opoias emfanizoume ena sxolio pros tropopoisi										 *
**********************************************************************************************************/
function find_cmnt($id,$id_bk)
{
	
	$conn=db_connect();
	$result=mysql_query("SELECT * FROM comments where commnt_id='$id'");
	mysql_close();
	
	if(!$result)
	{
		throw new Exception('Συνέβει κάποιο λάθος με την προσπέλαση του σχολίου.Προσπαθήστε αργότερα');
	}
	
	dispModifyComment($result,$id_bk);
}


/*********************************************************************************************************
* synartisi gia tin tropopoisi enos sxoliou 															 *
**********************************************************************************************************/
function modifyComment($id,$comment,$id_bk)
{
	$conn=db_connect();
	$result=mysql_query("UPDATE comments SET comment='$comment' WHERE commnt_id='$id'");
	mysql_close();
	
	if(!$result)
	{
		throw new Exception('Υπήρξε κάποιο πρόβλημα με την αλλαγή του σχολίου σας!');
	}
	
	find_cmnt($id,$id_bk);
}

/*********************************************************************************************************
* synartisi gia tin diagrafi enos sxoliou 															 *
**********************************************************************************************************/
function delCmnt($id)
{
	$conn=db_connect();
	$result=mysql_query("UPDATE comments SET comment='Το σχόλιο έχει διαγραφεί!' where commnt_id='$id'");
	mysql_close();
	
	if(!$result)
	{
		throw new Exception('Υπήρξε κάποιο πρόβλημα με την διαγραφή του σχολίου σας!');
	}
}

/*********************************************************************************************************
* synartisi gia tin anafora enos sxoliou 															 *
**********************************************************************************************************/
function bad_cmnt($val_user,$id)
{
	$conn=db_connect();
	$result2=mysql_query("SELECT * FROM contents_cmnt WHERE id_prsn='$val_user' AND id_cmnt='$id'");
	mysql_close();
	
	if(mysql_num_rows($result2)==0)
	{
		$conn=db_connect();
		$result=mysql_query("UPDATE comments SET clean='no' WHERE commnt_id='$id'");
		$result1=mysql_query("INSERT INTO contents_cmnt(id_prsn, id_cmnt) VALUES ('$val_user','$id')");
		mysql_close();
		
		
		if(!$result&&!$result1)
		{
			throw new Exception('Συνέβει κάποιο σφάλμα με την αναφορά του σχολίου! Προσπαθήστε αργότερα');
		}
		
		echo '<br/>';
		echo 'Η αναφορά που κάνατε αποθηκεύτηκε και θα ελεχθεί από κάποιο διαχειριστη!';
		echo '<br/>';
	}
	else
	{	
		echo '<br/>';
		echo 'Έχετε κάνει ήδη αναφορά για αυτό το σχόλιο και εκρεμμεί να ελενχθεί από τον διαχειριστή!';
		echo '<br/>';
	}
	
	if(!$result2)
	{
		throw new Exception('Συνέβει κάποιο σφάλμα με την αναφορά του σχολίου! Προσπαθήστε αργότερα');
	}
}

/*********************************************************************************************************
* synartisi gia tin diorthwsi twn selidodeiktwn pou exoun anaferthei									 *
**********************************************************************************************************/
function bkm_for_fix()
{
	$index_per_page=15;
	$final=array();
	
	echo '<h2>Σελιδοδείκτες που έχουν αναφερθεί!</h2>';
	
	$conn=db_connect();
	$result=mysql_query("SELECT bookmark_id FROM bookmark WHERE clean='no'");
	mysql_close();
	
	if(!$result)
	{
		throw new Exception('Συνέβει κάποιο σφάλμα με την προσπέλαση των σελιδοδεικτών που έχουν αναφερθεί!');
	}
	
	//dimiourgia pinaka me id anafermenwn selidodeiktwn
	if(mysql_num_rows($result)>0)
	{
		$num=mysql_num_rows($result);
		for($r=0; $r<$num; $r++)
		{
			$row=mysql_fetch_row($result);
			array_push($final,$row[0]);
		}
	}
	
	if(count($final)>0)
	{
		//emfanisi selidodeiktwn otan xwrane se mia selida
		if(count($final)<$index_per_page)
		{
		
			for($i=0; $i<count($final); $i++)
			{
				$conn=db_connect();
				$title_url=mysql_query("SELECT title,url,user_id FROM bookmark WHERE bookmark_id='$final[$i]'");
				mysql_close();
			
				$row1=mysql_fetch_row($title_url);
			
				echo $row1[0];
				echo '<br/>';
				echo $row1[1];
				echo "<br/>";
				if(isset($_SESSION['valid_user'])) 
				{
					$x=1;
					
					echo 'Σελιδοδείκτης καταχωρημένος απο τον χρήστη: '.$row1[2];
					echo '<br/>';
				}	
				echo "<a href='bookmark.php?var=$final[$i]'>Εμφάνιση</a>";
				echo '<br/>';
				echo '<br/>';
			}
		}
		//emfanisi selidodeiktwn otan den xwrane se mia selida (parapanw apo mia sel)
		else
		{
			for($i=0; $i<$index_per_page; $i++)
			{
				$conn=db_connect();
				$title_url=mysql_query("SELECT title,url,user_id FROM bookmark WHERE bookmark_id='$final[$i]'");
				mysql_close();
				
				$row1=mysql_fetch_row($title_url);
				
				
				echo $row1[0];
				echo '<br/>';
				echo $row1[1];
				echo "<br/>";
				if(isset($_SESSION['valid_user'])) 
				{
					$x=1;
					
					echo 'Σελιδοδείκτης καταχωρημένος απο τον χρήστη: '.$row1[2];
					echo '<br/>';
				}	
				echo "<a href='bookmark.php?var=$final[$i]'>Εμφάνιση</a>";
				echo '<br/>';
				echo '<br/>';
			}
		}
	}
	else
	{
		echo 'Δεν υπάρχει κάποιος σελιδοδείκτης που να έχει αναφερθεί!';
	}
	
	
	$page=1;
	paging($final,$page,-1,-1);
}

/*********************************************************************************************************
* synartisi mesw tis opoias afairoume tin anafora gia ena selidodeikti									 *
**********************************************************************************************************/
function make_bkm_clean($id)
{
	$conn=db_connect();
	$result=mysql_query("UPDATE bookmark SET clean='yes' WHERE bookmark_id=$id");
	$result1=mysql_query("DELETE FROM contents_bkm WHERE id_bookmrk='$id'");
	mysql_close();
	
	if(!$result)
	{
		throw new Exception('Συνέβει κάποιο σφάλμα με την αφαίρεση της αναφοράς!');
	}
	
	echo '<br/>';
	echo 'Η αναφορά αφαιρέθηκε επιτυχώς!';
	echo '<br/>';
	echo "<a href='fix_bkm.php'>Επιστροφή</a>";
	
}

/*********************************************************************************************************
* synartisi gia tin diorthwsi twn sxolion pou exoun anaferthei									 *
**********************************************************************************************************/
function cmnt_for_fix()
{
	$final=array();
	$index_per_page=15;
	$w=1;
	
	echo '<h2>Σελιδοδείκτες στους οποίους έχουν αναφερθεί σχόλια!</h2>';
	
	$conn=db_connect();
	//$result=mysql_query("SELECT bookmrk_id,comment FROM comments WHERE clean='no'");
	$result=mysql_query("SELECT bookmrk_id FROM comments WHERE clean='no'");
	mysql_close();
	
	if(!$result)
	{
		throw new Exception('Συνέβει κάποιο σφάλμα με την προσπέλαση των σχολίων που έχουν αναφερθεί!');
	}
	
	//dimiourgia pinaka me id anafermenwn selidodeiktwn
	if(mysql_num_rows($result)>0)
	{
		$num=mysql_num_rows($result);
		for($r=0; $r<$num; $r++)
		{
			$row=mysql_fetch_row($result);
			for($h=0; $h<count($final); $h++)
			{
				if($final[$h]==$row[0])
				{
					$w=0;
				}
				else
					$w=1;
			}
			
			if($w==1)
			{
				array_push($final,$row[0]);
			}
			
		}
	}
	
	
	if(count($final)>0)
	{
		
		//emfanisi selidodeiktwn otan xwrane se mia selida
		if(count($final)<$index_per_page)
		{
			for($i=0; $i<count($final); $i++)
			{
				$conn=db_connect();
				$title_url=mysql_query("SELECT title,url,user_id FROM bookmark WHERE bookmark_id='$final[$i]'");
				mysql_close();
			
				$row1=mysql_fetch_row($title_url);
			
				
				echo $row1[0];
				echo '<br/>';
				echo $row1[1];
				echo "<br/>";
				if(isset($_SESSION['valid_user'])) 
				{
					$x=1;
					
					echo 'Σελιδοδείκτης καταχωρημένος απο τον χρήστη: '.$row1[2];
					echo '<br/>';
				}	
				echo "<a href='bookmark.php?var=$final[$i]'>Εμφάνιση</a>";
				echo '<br/>';
				echo '<br/>';
			}
		}
		//emfanisi selidodeiktwn otan den xwrane se mia selida (parapanw apo mia sel)
		else
		{
			
			for($i=0; $i<$index_per_page; $i++)
			{
				$conn=db_connect();
				$title_url=mysql_query("SELECT title,url,user_id FROM bookmark WHERE bookmark_id='$final[$i]'");
				mysql_close();
				
				$row1=mysql_fetch_row($title_url);
				
				
				echo $row1[0];
				echo '<br/>';
				echo $row1[1];
				echo "<br/>";
				if(isset($_SESSION['valid_user'])) 
				{
					$x=1;
					
					echo 'Σελιδοδείκτης καταχωρημένος απο τον χρήστη: '.$row1[2];
					echo '<br/>';
				}	
				echo "<a href='bookmark.php?var=$final[$i]'>Εμφάνιση</a>";
				echo '<br/>';
				echo '<br/>';
			}
		}
	}
	else
	{
		echo 'Δεν υπάρχει κάποιο σχόλιο που να έχει αναφερθεί!';
	}
	
	
	$page=1;
	paging($final,$page,-1,-1);

}

/*********************************************************************************************************
* synartisi mesw tis opoias afairoume tin anafora gia ena sxolio										 *
**********************************************************************************************************/
function make_cmnt_clean($id)
{
	$conn=db_connect();
	$result=mysql_query("UPDATE comments SET clean='yes' WHERE commnt_id='$id'");
	$result1=mysql_query("DELETE FROM contents_cmnt WHERE id_cmnt='$id'");
	mysql_close();
	
	if(!$result)
	{
		throw new Exception('Συνέβει κάποιο σφάλμα με την αφαίρεση της αναφοράς!');
	}
	
	echo '<br/>';
	echo 'Η αναφορά αφαιρέθηκε επιτυχώς!';
	echo '<br/>';
	echo "<a href='fix_cmnt.php'>Επιστροφή</a>";	
}


/*********************************************************************************
* selidopoiisi twn apotelesmatwn anazitisis ana 15 								 *
*********************************************************************************/
//http://blog.sachinkraj.com/how-to-create-simple-paging-with-php-css/

function paging($final,$page,$tag,$y)
{
	$element=count($tag);
	
	//dimiourgoume ton pinaka pou tha periexei ta ids
	$array="";
	if(count($final))
	{
		$array.="final[]=".$final[0];
		for($s=1; $s<count($final); $s++)
		{
			$array.="&final[]=".$final[$s];
		}
	}
	
		
	//posa apotelesmata theloyme ena selida
	//allagi kai sti synartisi search_url_by_id
	$index_per_page=15;

	//sunolikes selides pou exw apo anazitisi
	$pages=ceil(count($final)/$index_per_page);
	
	//echo $page;
	
	//emfanisi tou previous
	if($page==1)
	{
		//echo 'hello';
		echo "Previous";
		echo "      ";
	}
	else
	{
		
		$j=$page-1;
		if($element==1)
		{
			$td=0;
			echo "<a href=page.php?var=$j&var1=$index_per_page&var2=$tag&var3=$y&var4=$td&".$array.">Previous</a>";
		}
		elseif($element==2)
		{
			
			$td=1;
			$title=$tag[0];
			$desc=$tag[1];
			echo "<a href=page.php?var=$j&var1=$index_per_page&var2=$title&var3=$y&var4=$td&var5=$desc&".$array.">Previous</a>";
		}
		echo "      ";
	}
	
	
	//emfanisi selidwn prwtwn selidwn
	if($page-2>1)
	{
		if($page-2==2)
		{
			if($element==1)
			{
				$td=0;
				echo "<a href=page.php?var=1&var1=$index_per_page&var2=$tag&var3=$y&var4=$td&".$array.">1</a>";
			}
			elseif($element==2)
			{
				$td=1;
				$title=$tag[0];
				$desc=$tag[1];
				echo "<a href=page.php?var=$j&var1=$index_per_page&var2=$title&var3=$y&var4=$td&var5=$desc&".$array.">1</a>";
			}
			echo "      ";
			echo '-';
			echo "      ";
		}
		
		else
		{
			if($element==1)
			{
				$td=0;
				echo "<a href=page.php?var=1&var1=$index_per_page&var2=$tag&var3=$y&var4=$td&".$array.">1</a>";
			}
			elseif($element==2)
			{
				$td=1;
				$title=$tag[0];
				$desc=$tag[1];
				echo "<a href=page.php?var=1&var1=$index_per_page&var2=$title&var3=$y&var4=$td&var5=$desc&".$array.">1</a>";
			}
			echo "      ";
			echo '...';
			echo "      ";
			echo "      ";
		}
	}
	
	
	
	//emfanisi dyo proigoumenwn selidwn apo tin twrini
	if($page>1)
	{
		for($m=$page-2; $m<$page; $m++)
		//while($i<$page-3)
		{
			if($m>0)
			{
				if($element==1)
				{
					$td=0;
					echo "<a href=page.php?var=$m&var1=$index_per_page&var2=$tag&var3=$y&var4=$td&". $array.">".$m."</a>";
				}
				elseif($element==2)
				{
					$td=1;
					$title=$tag[0];
					$desc=$tag[1];
					echo "<a href=page.php?var=$m&var1=$index_per_page&var2=$title&var3=$y&var4=$td&var5=$desc&".$array.">".$m."</a>";
				}
				//echo $m;
				echo "      ";
				echo '-';
				echo "      ";
			}
		}
	}
	
	
	//emfanisi selidas poy eimai twra!
	$i=$page;
	echo $i;
	echo "      ";
	if($i<$pages)
		echo '-';
	echo "      ";
	
	//emfanisi 2 epomenwn selidwn apo ayti pou eimaste twra
	$i=$page+1;
	while($i<=$pages && $i<$page+3)
	{
		if($element==1)
		{
			$td=0;
			echo "<a href=page.php?var=$i&var1=$index_per_page&var2=$tag&var3=$y&var4=$td&". $array.">".$i."</a>";
		}
		elseif($element==2)
		{
			$td=1;
			$title=$tag[0];
			$desc=$tag[1];
			echo "<a href=page.php?var=$i&var1=$index_per_page&var2=$title&var3=$y&var4=$td&var5=$desc&".$array.">".$i."</a>";
		}
		if($i<$page+2)
		{
			echo "      ";
			if($i<$pages)
			{
				echo '-';
			}
		}
		echo "      ";
		$i++;	
	}
	
	
	//emfanisi teleutaiwn selidwn
	if($pages>$i-1)
	{
		if($pages==$i)
		{
			echo "      ";
			echo '-';
			echo "      ";
			if($element==1)
			{
				$td=0;
				echo "<a href=page.php?var=$pages&var1=$index_per_page&var2=$tag&var3=$y&var4=$td&".$array.">".$pages."</a>";
			}
			elseif($element==2)
			{
				$td=1;
				$title=$tag[0];
				$desc=$tag[1];
				echo "<a href=page.php?var=$pages&var1=$index_per_page&var2=$title&var3=$y&var4=$td&var5=$desc&".$array.">".$pages."</a>";
			}
			echo "      ";
		}
		else
		{
			echo "      ";
			echo '...';
			echo "      ";
			if($element==1)
			{
				$td=0;
				echo "<a href=page.php?var=$pages&var1=$index_per_page&var2=$tag&var3=$y&var4=$td&".$array.">".$pages."</a>";
			}
			elseif($element==2)
			{
				$td=1;
				$title=$tag[0];
				$desc=$tag[1];
				echo "<a href=page.php?var=$pages&var1=$index_per_page&var2=$title&var3=$y&var4=$td&var5=$desc&".$array.">".$pages."</a>";
			}
			echo "      ";
		}
	}
	
	if($page<$pages)
	{
		$k=$page+1;
		if($element==1)
		{
			$td=0;
			echo "<a href=page.php?var=$k&var1=$index_per_page&var2=$tag&var3=$y&var4=$td&".$array.">Next</a>";
		}
		elseif($element==2)
		{
			$td=1;
			$title=$tag[0];
			$desc=$tag[1];
			echo "<a href=page.php?var=$k&var1=$index_per_page&var2=$title&var3=$y&var4=$td&var5=$desc&".$array.">Next</a>";
		}
	}
	else
	{
		echo 'Next';
	}
}


/*********************************************************************************
* sunartisi gia tin emfanisi twn urls me vasi ti selidopoiisi					 *
*********************************************************************************/

function url_from_paging($page,$index_per_page,$a,$tag,$y)
{
	echo '<br/>';
	echo '<h2>Αποτελέσματα αναζήτησης</h2>';
	
	$sum=count($tag);
	//echo $y;
	
	if($y!=-1)
	{
		if($sum==1)
		{
			if($y==0)
			{	
				echo "<a href=search_new_famous.php?var=$tag&var1=1>Εμφάνιση αποτελεσμάτων με βάση το πιο πρόσφατο!</a>";
				echo '<br><br>';
			}
			else
			{
				echo "<a href=search_new_famous.php?var=$tag&var1=0>Εμφάνιση αποτελεσμάτων με βάση το πιο δημοφιλή!</a>";
				echo '<br><br>';
			}
		}
		elseif($sum==2)
		{
			$title=array_pop($tag);
			$desc=array_pop($tag);
			if($y==0)
			{	
				echo "<a href=search_new_famous_td.php?var=$title&var1=1&var2=$desc>Εμφάνιση αποτελεσμάτων με βάση το πιο πρόσφατο!</a>";
				echo '<br><br>';
			}
			else
			{
				echo "<a href=search_new_famous.php_td?var=$title&var1=0&var2=$desc>Εμφάνιση αποτελεσμάτων με βάση το πιο δημοφιλή!</a>";
				echo '<br><br>';
			}
			array_push($tag,$title);
			array_push($tag,$desc);
		}
	}
	
	$start=($page-1)*$index_per_page;
	$stop=($page-1)*$index_per_page+$index_per_page-1;

	for($i=$start; $i<=$stop; $i++)
	{
		if($i<count($a))
			{
			$conn=db_connect();
			$url_result=mysql_query("SELECT bookmark_id,title,url,user_id FROM bookmark where bookmark_id='$a[$i]'");
			mysql_close();
			
			if(!$url_result)
				throw new Exception('Συνέβει κάποιο σφάλμα κατά τον αναζήτηση του url');
				
			if(mysql_num_rows($url_result)>0)
			{
				$row=mysql_fetch_row($url_result);
				echo $row[1];
				echo '<br/>';
				echo $row[2];
				echo "<br/>";
				if(isset($_SESSION['valid_user'])) 
				{
					$x=1;
					
					echo 'Σελιδοδείκτης καταχωρημένος απο τον χρήστη: '.$row[3];
					echo '<br/>';
				}	
				echo "<a href='bookmark.php?var=$row[0]'>Εμφάνιση</a>";
				echo "<br/>";
				echo '<br/>';
			}
		}
	}
	
	if($sum==1)
		paging($a,$page,$tag,$y);
	elseif($sum==2)
		//paging($a,$page,$tag,$y);
		paging($a,$page,$tag,$y);
}


function deleteUser($username)
{
	$conn=db_connect();
	$bk_user=mysql_query("SELECT bookmark_id FROM bookmark WHERE user_id='$username'");
	//$del_user=mysql_query("DELETE FROM users WHERE username= '$username'");
	
	mysql_close();
}

?>

