<?php

require_once('include.php');


/**********************************************************************
* synartisi provolis tis formas syndesis toy xristi
**********************************************************************/

function dispLoginBox()
{
?>
	
	<div class="mainbar">
		<div class="article">
			<h2><span>Είσαι μέλος;</span> Συνδέσου εδώ!!</h2>
			<div class="clr"></div>
			<form name="login_form" action="member.php" method="post">
				<ol>
					<li>
						<label for="username">Όνομα χρήστη</label>
						<input id='username' type="text" name="username"/>
					</li>
					<li>
						<label for="password">Κωδικός πρόσβασης</label>
						<input id='password' type="password" name="password"/>
					</li>
					<li>
						<input type="image" name="imageField" id="imageField" src="CSS/images/submit.gif" class="send" onClick="loginCheck()"/>
						<div class="clr"></div>
					</li>
				</ol>
			</form>		
		</div>
		<div class="article">
			<h2><a href="signup.php">Δεν είσαι μέλος; Κάνε εγγραφή!</a></h2>
		</div>	
	</div>

<?php
}


/**********************************************************************
* synartisi provolis tis formas eggrafis toy xristi
**********************************************************************/

function displayRegForm()
{
?>

	<div class="mainbar">
		<div class="article">
          <h2><span>Φόρμα εγγραφής</span></h2>
          <div class="clr"></div>
          <p>Όλα τα πεδία της παρακάτω φόρμας είναι υποχρεωτικά !</p>
		</div>
        <div class="article">
          <h2><span>Στοιχεία</span> χρήστη</h2>
          <div class="clr"></div>
          <form name="registration_form" onsubmit="signupCheck()" action="registration.php" method="post" >
            <ol>
              <li>
                <label for="username">Όνομα χρήστη</label>
                <input type="text" name="username" id="username"/>
              </li>
              <li>
                <label for="password1">Κωδικός χρήστη</label>
                <input type="password" name="password" id="password1" onkeyup="strongPass();"/> </br>
				<span id="strength"></span>
              </li>
              <li>
                <label for="password2">Επαλήθευση Κωδικού</label>
                <input type="password" name="password2" id="password2" onkeyup="samePassRT();"/> </br>
				<span id="same"></span>
              </li>
              <li>
                <label for="email">Διεύθυνση e-mail</label>
                <input type="text" name="email" id="email" onkeyup="checkEmailRT()"/> </br>
				<span id="right"></span>
              </li>
              <li>
                <input type="image" name="imageField" id="imageField" src="CSS/images/submit.gif" class="send" />
                <div class="clr"></div>
              </li>
            </ol>
          </form>
        </div>
	</div>


<?php 
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////
//allagi tis emfanisis tou koumpiou(proairetika)/////////
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////
?>



<?php
}

/**********************************************************************
* sunartisi emfanisis enos link
**********************************************************************/

//function dispURL($url,$name)
function dispLink($url,$name)
{
?>

<a href="<?php echo $url; ?>"><?php echo $name; ?></a>


<?php
}


/**********************************************************************
* sunartisi emfanisis tis arxikis selidas
**********************************************************************/

function dispMainPage()
{

if(isset($_SESSION['valid_user']))
{
	?>
	</br>
	<div class="article">
        <h2 align="center"><span>Καλώς όρισες στη σελίδα μας </span> <a href="profil.php"> <?php echo $_SESSION['valid_user'];?> </a> !!</h2>
        <div class="clr"></div>
	</div>
		
<?php
}

else
{
?>
	</br>
	<div class="article">
        <h2 align="center"><span>Καλώς όρισες στη σελίδα μας </span>!!</h2>
        <div class="clr"></div>
	</div>
<?php
}
?>
	</br></br></br>
	<div class="article" align="center">
		<div class="TagCloud">
			<img src="CSS/images/tagcloud.gif" alt="Tag Cloud" width="200" height="111" align="center"/>
			<h2 align="center"><span><?php tag_cloud(); ?></span></h2>
			<div class="clr"></div>
		</div>
	</div>
	
	</br>
	</br>
	</br>
	<div class="article" align="center" >
		<div class="new">
			<h2><span>Οι δέκα νεότεροι σελιδοδείκτες</span>!!</h2>
			<h3><span><?php recent_urls(); ?></span></h3>
			<div class="clr"></div>
		</div>
		<div class="popular">
			<h2><span>Οι δέκα πιο δημοφιλείς σελιδοδείκτες</span>!!</h2>
			<h3><span><?php famous_urls(); ?></span></h3>
			<div class="clr"></div>
		</div>
	</div>



<?php
}





/**********************************************************************
* sunartisi emfanisis tis kefalidas
**********************************************************************/

function dispHeader()
{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Bookmark Project</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="CSS/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="CSS/js/cufon-yui.js"></script> 
<script type="text/javascript" src="CSS/js/arial.js"></script> 
<script type="text/javascript" src="CSS/js/cuf_run.js"></script> 
<script type="text/javascript" src="myjs.js"></script>

<!--  Google Analytics -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-26962507-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<!--  Google +1 -->
<!-- Τοποθετήστε αυτή την ετικέτα στην κεφαλίδα ή ακριβώς πριν κλείσετε την ετικέτα σώμα.  -->
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>


</head>

<body>

<div class="main">
	<div class="header">
		<div class="header_resize">
			<div class="logo">
				<h1><a href="main.php">Social<span>Bookmarking</span></a> <small>everything is here</small></h1>
			</div>
			<div class="clr"></div>
			<div class="menu_nav">
				<ul>
				<li><a href="main.php">Αρχική</a></li>
				<li><a href="search.php">Αναζήτηση</a></li>

				<?php
		  
				// i kataxwrisi einai mia epilogi mono twn eggegramenwn xristwn opote elenxoume ti metavliti valid_member 
				// gia na diapistwsoume an o xristis einai egegrammenos
 
				$val_user=@$_SESSION['valid_user'];
				if(!empty($val_user))
				{
				?>
				<li><a href="InsertNewURL.php">Καταχώρηση</a></li>
				<li><a href="profil.php">Προφίλ</a></li>

				<?php
				}

				if(isset($_SESSION['valid_user']))
				{
				?>

				<li><a href="logout.php">Αποσύνδεση</a></li>

				<?php
				}
				else
				{
				?>

				<li><a href="login.php">Σύνδεση</a></li>
				<?php
				}
				?>
				</ul>
			</div>
			<div class="clr"></div>
		</div>
	</div>
		
	<div class="content">
		<div class="content_resize"> <img src="CSS/images/hbg_img.jpg" width="950" height="195" alt="" class="hbg_img" />
		<div class="clr"></div>

	

	<?php
	}


/********************************************************************
* sunartisi emfanisis footer
********************************************************************/
function dispFooter()
{
?>
		<div class="clr"></div>
		</div>
	</div>
	<div class="fbg">
		<div class="fbg_resize">
			<div class="col c1">
			<h2><span>  Gallery Menu</span></h2>
			<a href="main.php"><img src="CSS/images/home.png" width="58" height="58" alt="" /></a> 
			<a href="search.php"><img src="CSS/images/search.png" width="58" height="58" alt="" /></a>
			<?php
			// i kataxwrisi einai mia epilogi mono twn eggegramenwn xristwn opote elenxoume ti metavliti valid_member 
			// gia na diapistwsoume an o xristis einai egegrammenos
 
			$val_user=@$_SESSION['valid_user'];
			if(!empty($val_user))
			{
			?>		
			<a href="InsertNewURL.php"><img src="CSS/images/add.png" width="58" height="58" alt="" /></a>
			<a href="profil.php"><img src="CSS/images/profile.png" width="58" height="58" alt="" /></a>
			<?php
			}

			if(isset($_SESSION['valid_user']))
			{
			?>
			<a href="logout.php"><img src="CSS/images/signout.png" width="58" height="58" alt="" /></a>
			<?php
			}
			else
			{
			?>		
			<a href="login.php"><img src="CSS/images/login.png" width="58" height="58" alt="" /></a>
			<?php
			}
			?>
			</div>
			
			<div class="col c2">
			<h2><span>Επικοινωνία</span></h2>
			<p> Για οποιοδήποτε πρόβλημα επικοινωνήστε μαζί μας στο παρακάτω e-mail:<br/>
		    support@BookmarkProject.com </p>
			</div>
			
			<div class="col c1">
			<h2><span>Social Hubs</span></h2>
			<a href="generateRSS.php"><img src="CSS/images/rss.png" width="58" height="58" alt="" /></a>
			<a href="http://twitter.com/#!/SocialBookmar12"><img src="CSS/images/twitter.png" width="58" height="58" alt="" /></a>
			<!-- Τοποθετήστε αυτή την ετικέτα εκεί όπου θέλετε να εμφανίζεται το κουμπί +1 -->
			<g:plusone></g:plusone>
			</div>
      
			<div class="clr"></div>
		</div>
	</div>
	<div class="footer">
		<div class="footer_resize">
		<p class="lf">&copy; 2010-2011 Bookmark Project</p>
		<p class="rf">Developed by  Manetta  |  Vassis  |  Paronis </p>
		<div class="clr"></div>
		</div>
	</div>


</div>
</body>

</html>


<?php
}



/**********************************************************************
* sunartisi gia tin aposyndesi tou xristi apo to systima
**********************************************************************/

function dispLogout()
{
?>
	
	
	<div class="content">
        <div class="article">
			</br></br>
			<h2><span>Θέλετε να αποσυνδεθείτε από το σύστημα;</span></h2>
			<div class="clr"></div>
			<form action="Log_Out.php" method="post">
            <ol>
				<li>
                <input type="image" name="imageField" id="imageField" src="CSS/images/submit.gif" class="send" />
                <div class="clr"></div>
				</li>
            </ol>
			</br></br>
          </form>
        </div>
	</div>


<?php
}



/**********************************************************************
* sunartisi gia tin kataxwrisi neou url sti vasi dedomenwn
**********************************************************************/

function dispURLForm()
{
?>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery-1.2.1.pack.js"></script>

<script type="text/javascript">
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("rpc.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	
	function fill(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}

</script>

</head>

<body>
	<div class="mainbar">
		<div class="article">
			<h2><span>Καταχώρησε το σελιδοδείκτη σου!</span></h2>
			<div class="clr"></div>
			<form name="url_form" onSubmit="newURLCheck();" action="url.php" method="post">
				<ol>
					<li>
						<label for="title">Τίτλός</label>
						<input id="title" type="text" name="title"/>
					</li>
					<li>
						<label for="url">URL</label>
						<input id="url" type="text" name="url"/>
					</li>
					<li>
						<label for="description">Περιγραφή Σελιδοδείκτη</label>
						<textarea id="description" name="description" cols="45" rows="4"> </textarea>
					</li>
					<li>
						<label for="inputString">Ετικέτα</label>
						<input type="text" name="tag1" size="21" value="" id="inputString" onkeyup="lookup(this.value);" onblur="fill();" />
					</li>
					<li>
						<div class="suggestionsBox" id="suggestions" style="display: none;">
							<div class="suggestionList" id="autoSuggestionsList">
								&nbsp;
							</div>
						</div>						
					</li>
					</br></br>
					<li>
						<input type="image" name="imageField" id="imageField" src="CSS/images/submit.gif" class="send" />
						<div class="clr"></div>
					</li>
				</ol>
			</form>
		</div>
	</div>
</body>

<?php
}


/**********************************************************************
* sunartisi gia tin anazitisi enos url sti vasi dedomenwn me vasi     *
* ton titlo kai tin perigrafi					      *
**********************************************************************/

function search_by_title_desc()
{

?>

<div class="mainbar">
    <div class="article">
		<h2><span>Φόρμα αναζήτησης σελιδοδείτη με βάση τον τίτλο κα την περιγραφή</span></h2>
		<div class="clr"></div>
		<form name="search_form_title_desc" action="search_by_title_desc.php" method="post">
			<ol>
				<li>
					<label for="title">Τίτλος URL</label>
					<input id='title' type="text" name="title_url"/>
				</li>
				<li>
					<label for="desc">Περιγραφή URL</label>
					<input id='desc' type="text" name="desc_url"/>
				</li>
				<li>
					<input type="image" name="imageField" id="imageField" src="CSS/images/submit.gif" class="send" onClick="search_tdCheck()" />
					<div class="clr"></div>
				</li>
			</ol>
		</form>
	</div>
</div>

	
<?php

}

/**********************************************************************
* sunartisi gia tin anazitisi enos url sti vasi dedomenwn me vasi     *
* ton titlo kai tin perigrafi					      *
**********************************************************************/

function search_by_tag()
{
?>
		
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery-1.2.1.pack.js"></script>

<?php
/*
<script type="text/javascript">
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("rpc.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	function fill(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
</script>
*/?>

<script type="text/javascript">
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("rpc.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	
	function fill(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}

</script>


</head>

<body>

	<div class="mainbar">
        <div class="article">
			<h2><span>Φόρμα αναζήτησης σελιδοδείτη με βάση τις ετικέτες</span></h2>
			<div class="clr"></div>
			<form name="search_form_tag" action="search_by_tags.php" method="post">
				<ol>
					<li>
						<label for="inputString">Ετικέτα</label>
						<input type="text" name="tag1" size="22" value="" id="inputString" onkeyup="lookup(this.value);" onblur="fill();"/>
					</li>
					<li>
						<div class="suggestionsBox" id="suggestions" style="display: none;">
							<div class="suggestionList" id="autoSuggestionsList">
								&nbsp;
							</div>
						</div>
					</li>
					</br>
					<li>
						<input type="image" name="imageField" id="imageField" src="CSS/images/submit.gif" class="send" onClick="search_tagCheck() />
						<div class="clr"></div>
					</li>
					</br>
				</ol>
			</form>
        </div>
	</div>
	
</body>

<?php
}

/**********************************************************************
* sunartisi gia tin emfanisi tis formas anazitisis		     		 *
**********************************************************************/

function dispSearchForm()
{
?>

	<div class="mainbar">
		<div class="article">
			<h2><span>Αναζήτηση</span></h2>
			<div class="clr"></div>
			<form name="search_form" action="search_bkm.php" method="post">
				<input type="radio" name="search" value="by_title" id="search1" checked/>
				<label for="search1">Αναζήτηση με βάση τον τίτλο και την περιγραφή</label>
				</br>				
                <input type="radio" name="search" value="by_tags" id="search2"/>
				<label for="search2">Αναζήτηση με βάση τις ετικέτες</label>
                </br>
				</br>
                <input type="image" name="imageField" id="imageField" src="CSS/images/submit.gif" class="send" />
                <div class="clr"></div>
          </form>
		</div>
	</div>

<?php
}


/**********************************************************************
* sunartisi gia tin emfanisi tis formas prosthesis sxoliwn     		 *
**********************************************************************/

function dispAddComentsForm($id)
{
?>

	<div class="article">
		<h2><span>Προσθέσετε το σχόλιό σας σχετικά με τον καταχωρημένο σελιδοδείκτη</span></h2>
		<div class="clr"></div>
		<form name="add_comments" action="add_comments.php?var=<?php echo $id; ?>" method="post">
			<ol>
				<li>
					<label for="comment">Προσθήκη σχολίου</label>
					<textarea id="comment" name="comment" cols="60" rows="7"></textarea>
				</li>
					<input type="image" name="imageField" id="imageField" src="CSS/images/submit.gif" class="send" onClick="checkCom(); />
					<div class="clr"></div>
				<li>
				</li>
			</ol>
		</form>
	</div>
	</br>


<?php	
}

/**********************************************************************

* sunartisi gia tin emfanisi tis formas vathmologisis selidodeikti     		 *
**********************************************************************/

function dispRatingForm($id)
{
echo "<form name=\"rate_bookmark\" action=\"rate_bookmark.php?var=$id\" method=\"post\">";
echo "<b>Βαθμολόγησε τον καταχωρημένο σελιδοδείκτη: </b>";

echo "<select name=\"rate\">";
echo "<option value=\" \"></option>";
echo "<option value=\"1\">1</option>";
echo "<option value=\"2\">2</option>";
echo "<option value=\"3\">3</option>";
echo "<option value=\"4\">4</option>";
echo "<option value=\"5\">5</option>";
echo "</select>";
echo "<input type=\"submit\" value=\"Βαθμολογήστε\">";
echo "</form>";


/*
echo "<form name=\"rate_bookmark\" action=\"rate_bookmark.php?var=$id\" method=\"post\">";
echo "<input type=\"radio\" name=\"rate\" value=\"1\" /> 1<br />";
echo "<input type=\"radio\" name=\"rate\" value=\"2\" /> 2<br />";
echo "<input type=\"radio\" name=\"rate\" value=\"3\" /> 3<br />";
echo "<input type=\"radio\" name=\"rate\" value=\"4\" /> 4<br />";
echo "<input type=\"radio\" name=\"rate\" value=\"5\" /> 5";
echo "</br>";
echo "<input type=\"submit\" value=\"Καταχώρηση\">";
echo "</form>";
*/
}


/**********************************************************************
* sunartisi gia tin emfanisi tis selidas profil			     		 *
**********************************************************************/

function dispProfilPage($user_type)
{

?>
	<div class="mainbar">
        <div class="article">
			<h2><span>Κεντρική σελίδα ρυθμίσεων</span></h2>
			<div class="clr"></div>
			</br>
		  
			<?php
			if($user_type=='User')
			{
			?>

            <ol>
				<li>
					<h2><a href="myprofil.php">Επεξεργασία του προφίλ μου</a></h2>
				</li>
				<li>
					<h2><a href="mybookmarks.php">Προβολή των σελιδοδείκτών μου</a></h2>
				</li>
				<li>
					<h2><a href="logout.php">Αποσύνδεση</a></h2>
				</li>
            </ol>
			
			<?php	
			}
			else
			{
			?>
			
			<ol>
				<li>
					<h2><a href="myprofil.php">Επεξεργασία του προφίλ μου</a></h2>
				</li>
				<li>
					<h2><a href="fix_bkm.php">Σελιδοδείκτες που έχουν αναφερθεί</a></h2>
				</li>
				<li>
					<h2><a href="fix_cmnt.php">Σελιδοδείκτες στους οποίους έχουν αναφερθεί σχόλια</a></h2>
				</li>
				<li>
					<h2><a href="mybookmarks.php">Προβολή των σελιδοδείκτών μου</a></h2>
				</li>
				<li>
					<h2><a href="logout.php">Αποσύνδεση</a></h2>
				</li>
            </ol>
			
			<?php
			}
			?>
		
        </div>
	</div>


<?php
}

/**********************************************************************
* sunartisi gia tin emfanisi twn urls enos xristi		     		 *
**********************************************************************/

function dispUrls($url_array)
{

?>
	<div class="mainbar">
        <div class="article">
			<?php
			$sum1=0;
			for($i=0; $i<count($url_array); $i=$i+3)
			{			
				$sum1++;
			}
			?>
			<h2><span>Οι σελιδοδείκτες μου (<?php echo $sum1;?>)</span></h2>
			<div class="clr"></div>
			</br>

			<?php
			if(count($url_array)>0)
			{
			?>

				<form name="del_form" action="del_bkm.php" method="post">
			
					<?php
					$sum=0;
					for($i=0; $i<count($url_array); $i=$i+3)
					{			
					$sum++;
					?>
						</br>
						<ol>
							<li>
								<h1><span> <?php echo $sum; ?></span>  <a href="#"><img src="CSS/images/star3.png" width="25" height="25" alt="" class="userpic" /></a>  </h1>  
							</li>	
							<li>
								<ol>
									<li>
										<h3><span> Περιγραφή: <?php echo $url_array[$i+1]; ?></span></h3>
									</li>
									<li>
										<h3><span> URL: <?php echo $url_array[$i+2]; ?></span></h3>
									</li>
									<li>
										<span> Διαγραφή: <?php echo "<input type='checkbox' name=\"del_me[]\" value=\"$url_array[$i]\" /></span>";?> 				
									</li>
									<li>
										<h3><span> <a href='bookmark.php?var=<?php echo $url_array[$i];?>'> Λεπτομέριες </a></span></h3>
										<div class="clr"></div>	
									</li>
									
								</ol>	
							</li>
						</ol>
							
					<?php
					}
					?>
					</br></br>
					<input type='submit' value='Διαγραφή' />
				</form>
	
					<?php
	
			}
			else
			{
			?>
				<h3><span> Δεν έχετε αποθηκευμένους σελιδοδείκτες</span></h3>
			<?php
			}
			?>
			
		</div>
	</div>
	
<?php	
}

/**********************************************************************
* sunartisi gia tin allagi twn stoixeiwn enos xristi		   		 *
**********************************************************************/

function dispModifyDataForm()
{
	
	/*<!td><div><input type="password" name="password2" id="password2" onkeyup="samePassRT();"/><!/td><br/>
	<span id="same"></span></div><br/>*/
?>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery-1.2.1.pack.js"></script>

<script type="text/javascript">
function samePassRT()
{
	var password1=document.getElementById('password1');
	var password2=document.getElementById('password2');
	var same=document.getElementById('same');
	
	if(password2.value.length!=0)
	{
		if(password1.value==password2.value)
		{
			same.innerHTML='<span style="color:green">Οι κωδικοί ταιρίαζουν!</span>';
		}
		else
		{
			same.innerHTML='<span style="color:red">Οι κωδικοί που έχετε δώσει δεν ταιριάζουν!</span>';
		}
	}
}

function checkEmailRT()
{
	var email=document.getElementById('email');
	var right=document.getElementById('right');
	var re=/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	
	//elenxoume an to mail exei dwthei sti swsti morfi
	var result=re.test(email.value);

	if(email.value.length!=0)
	{
		if(result==true)
		{
			right.innerHTML='<span style="color:green">Αποδεκτο email!</span>';
		}
		else
		{
			right.innerHTML='<span style="color:red">Το email σας δεν έχει αποδεκτή μορφή</span>';
		}
	}
	
	
}



</script>
</head>


	<div class="mainbar">
        <div class="article">
			<h2><span>Αλλαγή κωδικού</span></h2>
			<div class="clr"></div>
			<form name="modify_pass_form" action="editPass.php" method="post">
				<ol>
					<li>
						<label for="old_pass">Παλιός κωδικός</label>
						<input id="old_pass" type="password" name="old_pass" />
					</li>
					<li>
						<label for="password1">Νέος κωδικός</label>
						<input id="password1" type="password" name="new_pass1"/>
					</li>
					<li>
						<label for="password2">Επαλήθευση νέου κωδικου</label>
						<input id="password2" type="password" name="new_pass2" onkeyup="samePassRT();"/>
						<span id="same"></span>
					</li>
					<li>
						<input type="image" name="imageField" id="imageField" src="CSS/images/submit.gif" class="send" onClick="checkModPass();" />
						<div class="clr"></div>
					</li>
				</ol>
			</form>
        </div>
        <div class="article">
			<h2><span>Αλλαγή email</span></h2>
			<div class="clr"></div>
			<form name="modify_email_form" action="editEmail.php" method="post">
				<ol>
					<li>
						<label for="email">Νέο Email</label>
						<input id="email" type="text" name="new_mail" onkeyup="checkEmailRT();"/>
						<span id="right"></span>
					</li>
					<li>
						<input type="image" name="imageField" id="imageField" src="CSS/images/submit.gif" class="send" onClick="checkModMail();" />
						<div class="clr"></div>
					</li>
				</ol>
			</form>
        </div>
	</div>
	
	
<?php
}



/**********************************************************************************
* sunartisi gia tin emfanisi twn xristwn pou einai syndedemenoi sto systima        *
************************************************************************************/

function dispUsers($username,$email,$type)
{
	echo '<h1>Εγγεγραμένοι χρήστες</h1>';

	$num=count($username);

	echo "<table border=\"1\">";
	
	echo "<br>";
	for($i=0; $i<$num; $i++)
	{

		
		echo "<tr>";
		echo "<td>".$username[$i]."</td>";
		echo "<td>".$email[$i]."</td>";
		echo "<td>".$type[$i]."</td>";
		echo "<td><a href='deleteUser.php?var=$username[$i]'>Διαγραφή</a> </td>";
		echo "<td><a href='deleteUser.php?var=$username[$i]'>Επεξεργασία</a></td> ";
		echo "<td><a href='deleteUser.php?var=$username[$i]'>Προβολή</a></td> ";
		echo "</tr>";

	}

	echo "</table>";

}

/************************************************************************************
* sunartisi gia tin emfanisi enos url pou exei kataxwrisei kapoios xrisits    		 *
**************************************************************************************/
function dispURL($row,$cmns, $tags)
{
	$for_fix=array();
	
	if(isset($_SESSION['user_type']))
	{	
		$type=$_SESSION['user_type'];
	}
	
	?>

	<div class="mainbar">
	
        <div class="article">
			<h2><span>Εμφάνιση λεπτομερειών σελιδοδείκτη</span></h2>
			<div class="clr"></div>
			</br>
        </div>
		
		<div class="article">
			<div class="clr"></div>
				<ol>
					<li>
						<h3><span>Τίτλος: </span><?php echo $row[1];?></h3>
					</li>
					<li>
						<h3><span>URL: </span><a href="http://<?php echo $row[2];?>" target="_blank"> <?php echo $row[2];?>  </a></h3>   
					</li>
					<li>
						<h3><span>Περιγραφή: </span><?php echo $row[3];?></h3>
					</li>
					<li>
						<h3><span>Ετικέτες που σχετίζονται με τον σελιδοδείκτη: 
						
							<?php
	
							if(mysql_num_rows($tags)>0)
							{
								$num1=mysql_num_rows($tags);
								for($k=0; $k<$num1; $k++)
								{
									$row2=mysql_fetch_row($tags);
									if($num1==1)
									{
									?>
										<a href='tag_cloud.php?var=<?php echo $row2[0];?>'> <?php echo $row2[0]; ?></a>
									<?php
									}
									else
									{
										if($k==$num1-1)
										{
										?>
											<a href='tag_cloud.php?var=<?php echo $row2[0];?>'> <?php echo $row2[0]; ?></a>
										<?php
										}
										else
										{
										?>
											<a href='tag_cloud.php?var=<?php echo $row2[0];?>'> <?php echo $row2[0]; ?> , </a>
										<?php	
										}
									}
								}
							}
							?>
											
						</span></h3>
					</li>
					<li>
						<?php
	
						if(isset($_SESSION['valid_user'])) 
						{
						?>
							<h3><span>Χρήστης που πρόσθεσε τον σελιδοδείκτη: </span><?php echo $row[6];?></h3>
						<?php
						}
						?>
					</li>
					<li>
						<h3><span>Προβολές σελιδοδείκτη: </span><?php echo $row[4];?></h3>
					</li>
					<li>
						<?php
	
						if(isset($_SESSION['valid_user'])) 
						{
						?>
							<h3><span>Ημερομηνία καραχώρησης σελιδοδείτκη: </span><?php echo $row[5];?></h3>
						<?php
						}
						?>
					</li>
					<li>
						<h3><span>Βαθμολογία σελιδοδείκτη: </span><?php echo cal_rate($row[0]);?></h3>
					</li>
					<li>
						<?php
	
						if(isset($_SESSION['valid_user'])) 
						{
						?>
							<h3><span><?php dispRatingForm($row[0])?></span></h3>
						<?php
						}
						?>
					</li>
					<li>
						<?php
	
						if(isset($_SESSION['valid_user'])) 
						{
							$val_user=$_SESSION['valid_user'];
		
							if($val_user==$row[6]&&$type=='User')
							{
								?>
								</br>
								<h2><span> <a href='modify_bkm.php?var=<?php echo $row[0];?>'>Επεξεργασία Σελιδοδείκτη</a> </span></h2>
								</br>
								<?php
							}
							else if($type=='Admin')
							{
								?>
								</br>
								<h2><span> <a href='modify_bkm.php?var=<?php echo $row[0];?>'>Επεξεργασία Σελιδοδείκτη</a> </span></h2>
								<h2><span> <a href='banner_bkm.php?var=<?php echo $row[0];?>'>Αναφορά Σελιδοδείκτη</a> </span></h2>
								</br>
								<?php
							}
							else
							{
								?>
								</br>
								<h2><span> <a href='banner_bkm.php?var=<?php echo $row[0];?>'>Αναφορά Σελιδοδείκτη</a> </span></h2>
								</br>
								<?php
							}
					?>
					</li>
					<li>
						
							
								<?php
								$cmtnum=mysql_num_rows($cmns);
								?>
								</br>
								<h2><span>Σχόλια </span> (<?php echo $cmtnum;?>)</h2>
								

								<div class="clr"></div>
								
							<?php
							if(mysql_num_rows($cmns)>0)
		
							{
								$num=mysql_num_rows($cmns);
			
								for($i=0; $i<$num; $i++)
								{
									$row1=mysql_fetch_row($cmns);

									
								?>
								<div class="comment"> <a href="#"><img src="CSS/images/userpic.gif" width="40" height="40" alt="" class="userpic" /></a>
									<p><a href="#"><?php echo $row1[2];?></a> Says:<br />
									<?php echo $row1[3];?></p>
								<?php

									if($row1[5]=='no'&& $type='Admin')
									{
										echo "<b style=\"color:red\">Το σχόλιο αυτό έχει αναφερθεί!</b>";					
									}			

									?> <p> <?php echo $row1[4]; ?>. <?php echo $row1[1];?> </p> <?php

				
									if(($_SESSION['valid_user']==$row1[2])&&($type=='User'))
									{
										?>
										<h3><a href='modify_cmnt.php?var=<?php echo $row1[0]; ?>&var1=<?php echo $row[0]; ?>'>Επεξεργασία Σχολίου</a></h3>
										<?php
									}
									else if($type=='Admin')
									{
									?>
										<h3><a href='modify_cmnt.php?var=<?php echo $row1[0]; ?>&var1=<?php echo $row[0]; ?>'>Επεξεργασία Σχολίου</a></h3>
										<h3><a href='banner_cmnt.php?var=<?php echo $row1[0]; ?>'>Αναφορά Σχολίου</a></h3>
									<?php
									}
									else
									{
									?>
										<h3><a href='banner_cmnt.php?var=<?php echo $row1[0]; ?>'>Αναφορά Σχολίου</a></h3>
									<?php
									}
								?>
								</div>
						
								<?php
									//dimiourgoume pinaka me ta sxolia pou exoun anaferthei		
									if($row1[5]=='no')
									{
										array_push($for_fix,$row1[0]);
										array_push($for_fix,$row1[4]);
									}
								}
							}
							?>

					</li>
					<li>
							<?php
																					
							//emfanizei ta sxolia pou exoyn anaferthei
							if($type=='Admin')
							{
								?>
								<h2><span>Αριθμός σχολίων που έχουν αναφερθεί:</span></h2>
								<h3><?php echo count($for_fix)/2;?></h3>
							
								<h2><span>Σχολία που έχουν αναφερθεί:</span></h2>
								<div class="clr"></div>

								<?php
								
								for($b=0; $b<count($for_fix); $b+=2)
								{
									//echo $for_fix[$b];
									$c=$b+1;
									?> <h3> <?php echo "<a href='modify_cmnt.php?var=$for_fix[$b]&var1=$for_fix[$c]'>".$for_fix[$c]."</a>"; ?> </h3><?php
									if($b<(count($for_fix)-2)) 
									{
										echo '-';
									}
								}
							}
							?>
						
							<?php
							
					?>
					</li>
					<li>
						
					<?php
							dispAddComentsForm($row[0]);
					?>
					</li>
						<?php
						}
						else
						{
						?>
					<li>	
							</br>
							<h3><span>Για περισσότερες λεπτομέρειες σχετικά με τον αποθηκευμένο σελιδοδείκτη,</span></h3>
							<h3><span>συνδεθείτε στην ιστοσελίδα μας</span></h3>
							<h2> <a href="login.php">Σελίδα σύνδεσης</a></h2>
							
					</li>
						<?php
						}
						?>
				</ol>
        </div>
	</div>
	
<?php
}

/************************************************************************************
* sunartisi gia tin tropopoiisi enos kataxwrimenoy selidodeikti apo to xristi		 *
* pou tin exei apothikeusei    														 *
**************************************************************************************/
function dispModifyBkm($row,$id,$tags,$tags1)
{
	//$tags1=$tags;
	$type=$_SESSION['user_type'];
	
	?>
	<div class="mainbar">
		<div class="article">
			<h2><span>Επεξεργασία σελιδοδείκτη</span></h2>
			<div class="clr"></div>
			<ol>
				<li>
					<h3>Τίτλος: <?php echo $row[1]; ?></h3>
				</li>
				<li>
					<h3>URL: <?php echo $row[2]; ?></h3>
				</li>
				<li>
					<h3>Περιγραφή: <?php echo $row[3]; ?></h3>
				</li>
				<li>
						<h3><span>Ετικέτες που σχετίζονται με τον σελιδοδείκτη: 
						
							<?php
	
							if(mysql_num_rows($tags)>0)
							{
								$num1=mysql_num_rows($tags);
								for($k=0; $k<$num1; $k++)
								{
									$row2=mysql_fetch_row($tags);
									if($num1==1)
									{
									?>
										<a href='tag_cloud.php?var=<?php echo $row2[0];?>'> <?php echo $row2[0]; ?></a>
									<?php
									}
									else
									{
										if($k==$num1-1)
										{
										?>
											<a href='tag_cloud.php?var=<?php echo $row2[0];?>'> <?php echo $row2[0]; ?></a>
										<?php
										}
										else
										{
										?>
											<a href='tag_cloud.php?var=<?php echo $row2[0];?>'> <?php echo $row2[0]; ?> , </a>
										<?php	
										}
									}
								}
							}
							?>
											
						</span></h3>
				</li>
				<li>
					<?php
					if(isset($_SESSION['valid_user'])) 
					{
					?>
						<h3>Χρήστης που πρόσθεσε τον σελιδοδείκτη: <?php echo $row[6]; ?> </h3>
					<?php
					}
					?>
				
				</li>
					<h3>Προβολές σελιδοδείκτη: <?php echo $row[4]; ?></h3>
				<li>
				<li>
					<?php
					if(isset($_SESSION['valid_user'])) 
					{
					?>
						<h3>Ημερομηνία καραχώρησης σελιδοδείτκη: <?php echo $row[5]; ?> </h3>
					<?php
					}
					?>
				</li>
				<li>
					<h3>Βαθμολογία σελιδοδείκτη: <?php echo cal_rate($row[0]); ?></h3>
				</li>
				<li>
						</br>
						<?php
						//allagi titlou
						echo "<h3>Αλλαγή τίτλου</h3>";
						echo "<form name=\"modify_title\" action=\"editTitle.php?var=$id\" method=\"post\">";
						echo "Νέος τίτλος: <input type=\"text\" name=\"new_title\" id=\"new_title\"/>";

						echo "<input type=\"submit\" value=\"Αλλαγή\" onclick=\"modifyTitle()\"/>";
						echo "</form>";
						?>
				</li>
				<li>
					</br>
					<?php
					//allagi url
					echo "<h3>Αλλαγή URL</h3>";
					echo "<form name=\"modify_url\" action=\"editURL.php?var=$id\" method=\"post\">";
					echo "Νέο URL:<input type=\"text\" name=\"new_url\" id=\"url\"/>";

					echo "<input type=\"submit\" value=\"Αλλαγή\" onClick=\"modifyURL();\"/>";
					echo "</form>";
					?>
				</li>
				<li>
				</br>
				<?php
					//allagi perigrafis
					echo "<h3>Αλλαγή περιγραφής</h3>";
					echo "<form name=\"modify_description\" action=\"editDesc.php?var=$id\" method=\"post\">";
					echo "<textarea rows=4 cols=45 name=\"new_desc\"  id=\"desc\"></textarea>";
					?> </br> <?php
					echo "<input type=\"submit\" value=\"Αλλαγή\" onClick=\"modifyDesc();\"/>";
					echo "</form>";
				?>
				</li>
				<li>
					</br>
					<?php
					// prosthiki tag
					echo "<h3>Προσθήκη ετικετών</h3>";
					echo "<form name=\"modify_add_tag\" action=\"editAddTag.php?var=$id\" method=\"post\">";
					echo "Νέο tag: <input type=\"text\" name=\"new_tag\" id=\"tag\"/>";

					echo "<input type=\"submit\" value=\"Προσθήκη\" onclick=\"modifyAddTag();\"/>";
					echo "</form>";				
				?>
				</li>
				<li>
				</br>
				<?php
					//diagrafi tags
					echo "<h3>Διγραφή ετικετών</h3>";

					if(mysql_num_rows($tags1)>0)
					{
						echo "<form name=\"del_tag\" action=\"del_tags.php?var=$id\" method=\"post\">";
						echo "<table align=\"rigth\">";
		
						$num2=mysql_num_rows($tags1);
						//echo $num2;
		
						for($l=0; $l<$num2; $l++)
						{
							//echo $l;
							$row1=mysql_fetch_row($tags1);
		
							//echo $row1[0];
							echo "<tr align=\"center\"><td>".$row1[0]."</td>";
							echo "<td><input type='checkbox' name=\"del_tag[]\" value=\"$row1[0]\"></td></tr>";
						}
						echo "</table>";
						echo "<tr><input type='submit' value='Διαγραφή' /><tr/>";
						echo "</form>";
					}
					else
					{
						echo 'Δεν υπάρχουν αποθηκευμένες ετικέτες για αυτό το σελιδοδείκτη';
					}
				?>
				</li>
				<li>
				</br>
				<?php
					// diagrafi selidodeikti
					echo "<h3>Διαγραφή Σελιδοδείκτη</h3>";
					echo "<form name=\"del_bkm\" action=\"deleteBookmark.php?var=$id\" method=\"post\">";
					echo "<input type=\"submit\" value=\"Διαγραφή\"/>";
					echo "</form>";
				?>
				</li>
				<li>
				</br>
				<?php
					if($row[7]=='no'&&$type=='Admin')
					{
						echo "<a href='del_content_bkm.php?var=$id'>Αφαίρεση Αναφοράς!</a>";
					}			
				?>
				</li>
		</div>
	</div>
			
	<?php		

}

/************************************************************************************
* sunartisi gia tin tropopoiisi enos kataxwrimenoy sxoliou							 *
**************************************************************************************/
function dispModifyComment($result,$id_bk)
{
	$type=$_SESSION['user_type'];
	
	echo "<h2>Επεξεργασία σχολίου</h2>";
	
	if(mysql_num_rows($result)>0)
	{
		$num=mysql_num_rows($result);
		
		for($i=0; $i<$num; $i++)
		{
			$row=mysql_fetch_row($result);
		}
		
		echo 'Σχόλιο καταχωρημένο την ';
		echo $row[4];
		echo '<br/>';
		echo '<br/>';
		
		
		echo $row[1];
		echo '<br/>';
		
		//allagi sxoliou
		echo "<h3>Αλλαγή σχολίου</h3>";
		echo "<form name=\"modify_comment\" action=\"editComment.php?var=$row[0]&var1=$id_bk\" method=\"post\">";
		echo "<textarea rows=4 cols=45 name=\"new_cmnt\" id=\"new_cmnt\"></textarea>";
		echo "<input type=\"submit\" value=\"Αλλαγή\" onClick=\"modifyCmnt();\"/>";
		echo "</form>";
		
		//diagrafi sxoliou
		echo "<h3>Διαγραφή Σχολίου</h3>";
		echo "<form name=\"del_cmnt\" action=\"deleteComment.php?var=$row[0]&var1=$row[3]\" method=\"post\">";
		echo "<input type=\"submit\" value=\"Διαγραφή\"/>";
		echo "</form>";	
	
		
		if($row[6]=='no'&&$type=='Admin')
		{
			echo "<a href='del_content_cmnt.php?var=$row[0]'>Αφαίρεση Αναφοράς!</a>";
		}
		
		//echo "<a href='bookmark.php?var=$id_bk'>Επιστροφή</a>";
	}
}
?>
