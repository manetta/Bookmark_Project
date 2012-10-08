/************************************************************************************************
* ARXEIO ME SYNARTISEIS JAVASCRIPT GIA TON ELEGXO TWN STOIXEIWN TWN FORMWN						*
************************************************************************************************/


//Sunartisi mesw tis opoias elenxoume an kapoio pedio mias formas einai keno
function nonEmpty(elem,msg)
{
	if(elem.value.length==0)
	{
		//alert(elem.value)
		alert(msg);
		elem.focus();
		return false;
	}
	else
	{
		return true;
	}

}

//sunartisi mesw tis opoias elenxoume to mikos tou kwdikou pou dinei o xristis
function apprLength(elem,min,max,msg)
{
	if((elem.value.length>=min)&&(elem.value.length<=max))
	{
		return true;
	}
	else
	{
		alert(msg);
		elem.focus();
		return false;
	}

}

/*
function isAlphaNumeric(elem,msg)
{
	var alphanumRE=/^[a-z0-9A-ZΑΒΓΔΕΖΗΘΙΚΛΜΝΞΟΠΡΣΤαάβγδεέζηθιίκλμνξοόπρστυύφχψωώς]+$/;
	
	if(elem.value.match(alphanumRE))
	{
		return true;
	}
	else
	{
		alert(msg);
		elem.focus();
		return false;
	}
}
*/


// Sunartisi gia ton elenxo tis morfis enos email
function checkEmail(email,msg)
{
	var re=/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	//elenxoume an to mail exei dwthei sti swsti morfi
	var result=re.test(email.value);

	if(result==true)
	{
		return true;
	}
	else
	{
		alert(msg);
		email.focus();
		return false;
	}
}

// Sunartisi gia ton elenxo tis morfis enos url
function checkURL(url,msg)
{
	//arxiko
	//var RegExp = /(http):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
	
	//alert('hello');
	var re =/?(http):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
	//var RegExp = /(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
	
	var result=re.test(url.value);
	
	alert(result);
	
	if(result==true)
	{
		alert('hello');
		return true;
	}
	else
	{
		alert(msg);
		url.focus();
		return false;
	}
}


//elenxoume an oi kwdikoi pou edwse o xristis einai idioi metaxu tous
function samePass(elem1,elem2,msg)
{
	if(elem1.value==elem2.value)
	{
		return true;
	}
	else
	{
		alert(msg);
		elem1.focus();
		return false;
	}
}


/************************************************************************************************
* Sunartiseis gia tin forma syndesis 															*
*************************************************************************************************/

//sunartisi mesw tis opoias elenxoume an exoyn symplirwthei ola ta pedia tis formas
function loginCheck()
{
	//username xristi
	var username=document.getElementById('username');
	//password xristi
	var password=document.getElementById('password');
	
	//elenxoume an ta parapanw stoixeia einai symplirwmena
	if(nonEmpty(username,'Δεν έχετε σμπληρώσει το όνομα χρήστη'))
	{
		if(nonEmpty(password,'Δεν έχετε σμπληρώσει το κωδικό χρήστη'))
		{
			return true;
		}
	}
	
	return false;
}


/************************************************************************************************
* Sunartiseis gia tin formas eggrafis															*
*************************************************************************************************/

// Sunartisi mesw tis opoias elenxoume tin isxis tou kwdikou										
function strongPass()
{
	
	var strength=document.getElementById('strength');
	var password1=document.getElementById("password1");
	var strongRE=new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\W).*$","g");
	var mediumRΕ=new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$","g");
	var weakRE=new RegExp("^(?=.{6,}).*","g");
	

	if(password1.value.length==0)
	{
		strength.innerHTML='';
	}
	if(false==weakRE.test(password1.value))
	{
		strength.innerHTML='Πολύ μικρός!';
	}
	else if(strongRE.test(password1.value)==true)
	{
		strength.innerHTML='<span style="color:green">Δυνατός!</span>'
	}
	else if(mediumRΕ.test(password1.value))
	{	
		strength.innerHTML='<span style="color:orange">Μέτριος!</span>';
	}
	else
	{
		strength.innerHTML='<span style="color:red">Αδύναμος!</span>';
	}	
}


//Sunartisi mesw tis opoias elenxoume an oi duo kwdikoi pou dinei o xristis tairiazoyn
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


// Sunartisi gia ton elenxo tis morfis enos email										
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

//sunartisi gia ton elegxo swstis sumplirwsis olwn twn apaitoumenwn stoixeiwn
function signupCheck()
{
	
	var username=document.getElementById('username');
	var password1=document.getElementById('password1');
	
	if(nonEmpty(username,'Δεν έχετε σμπληρώσει το όνομα χρήστη!'))
	{
		if(nonEmpty(password1,'Δεν έχετε σμπληρώσει το κωδικό πρόσβασης'))
		{
			apprLength(password1,4,16,'Ο κωδικός σας πρέπει να έχει μήκος τουλάχιστον 4 χαρακτήρες');
			
			if(nonEmpty(password2,'Δεν έχετε σμπληρώσει την επαληθευση του κωδικού πρόσβασης'))
			{
				samePass(password1,password2,'Οι κωδικοί που έχετε δώσει δεν ταιριάζουν μεταξύ τους!');
				
				if(nonEmpty(email,'Δεν έχετε σμπληρώσει το email σας'))
				{
					if(checkEmail(email,'Το email που δώσατε δεν έχει αποδεκτή μορφή'))
					{
						return true;
					}
				}
			}
		}
	}
	
	return false;	
}


/************************************************************************************************
* Sunartiseis gia tis formes allagis twn stoixeiwn tou selidodeikti 							*
*************************************************************************************************/

//synartisi gia ton elegxo tis formas allagis titlou
function modifyTitle()
{
	var title=document.getElementById('new_title');
	
	nonEmpty(title,'Δεν έχετε σμπληρώσει τίτλο για το σελιδοδείτκη σας');
}


//synartisi gia ton elegxo tis formas allagis url
function modifyURL()
{
	var url=document.getElementById('url');
	
	if(nonEmpty(url,'Δεν έχετε συμπληρώσει το url που θέλετε να αλλάξετε!'))
	{
		if(checkURL(url,'Δεν έχετε δώσει ένα σωστό url!'))
		{
			return true;
		}
	}
	
	return false;
}


//synartisi gia ton elegxo tis formas allagis perigrafis
function modifyDesc()
{
	var desc=document.getElementById('desc');
	//alert(desc.value);

	nonEmpty(desc,'Δεν έχετε σμπληρώσει τη νέα περιγραφή που θέλετε να δώσετε στο σελιδοδείκτη σας!!');
}


function modifyAddTag()
{
	var tag=document.getElementById('tag');

	nonEmpty(tag,'Δεν έχετε σμπληρώσει τη νέα ετικέτα που θέλετε να προσθέσουμε!');
}

/************************************************************************************************
* Sunartiseis gia tin forma anazitisis me vasi tin perigrafikai ton titlo 						*
*************************************************************************************************/

//sunartisi mesw tis opoias elenxoume an exoyn symplirwthei ola ta pedia tis formas
function search_tdCheck()
{
	//title selidodeikti 
	var title=document.getElementById('title');
	//perigrafi selidodeikti 
	var desc=document.getElementById('desc');
	
	//elenxoume an ta parapanw stoixeia einai symplirwmena
	if(nonEmpty(title,'Δεν έχετε συμπληρώσει τον τίτλο του σελιδοδείκτη!'))
	{
		if(nonEmpty(desc,'Δεν έχετε συμπληρώσει την περιγραφή του σελιδοδείκτη!'))
		{
			return true;
		}
	}
	return false;
}


/************************************************************************************************
* Sunartiseis gia tin forma anazitisis me vasi tis etiketes 									*
*************************************************************************************************/
function search_tagCheck()
{
	//tag selidodeikti xristi
	var tag=document.getElementById('inputString');
	
	//elenxoume an ta parapanw stoixeia einai symplirwmena
	nonEmpty(tag,'Δεν έχετε συμπληρώσει ετικέτα για αναζήτηση του σελιδοδείκτη!');
}


/************************************************************************************************
* Sunartiseis gia to autocomplete							 									*
*************************************************************************************************/
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


/************************************************************************************************
* Sunartiseis gia tin forma kataxwrisis enos selidodeikti 										*
*************************************************************************************************/
function newURLCheck()
{
	//tag selidodeikti xristi
	var title=document.getElementById('title');
	var url=document.getElementById('url');
	var description=document.getElementById('description');	
	var tag=document.getElementById('inputString');
	
	
	//elenxoume an ta parapanw stoixeia einai symplirwmena
	if(nonEmpty(title,'Δεν έχετε συμπληρώσει τίτλο για τον σελιδοδείκτη σας!'))
	{
		if(nonEmpty(url,'Δεν έχετε συμπληρώσει ένα url για τον σελιδοδείκτη σας!'))
		{
			if(checkURL(url,'Δεν έχετε δώσει ένα σωστό url!'))
			{
				if(nonEmpty(description,'Δεν έχετε δώσει περιγραφή για τον σελιδοδείκτη σας!'))
				{
					if(nonEmpty(tag,'Δεν έχετε συμπληρώσει ετικέτα για τον σελιδοδείκτη σας!'))
					{
						return true;
					}
				}
			}
		}
	}
	
	return false;
}


/************************************************************************************************
* Sunartiseis gia tin elenxo tis allagis tou kwdikou sundesis toy xristi						*
*************************************************************************************************/
function checkModPass()
{
	var old_pass=document.getElementById('old_pass');
	var new_pass1=document.getElementById('password1');
	var new_pass2=document.getElementById('password2');	
	
	if(nonEmpty(old_pass,'Δεν έχετε συμπληρώσει το παλίο κωδικό σας!'))
	{
		if(nonEmpty(new_pass1,'Δεν έχετε συμπληρώσει το νέο κωδικό σας!'))
		{
			if(nonEmpty(new_pass2,'Δεν έχετε συμπληρώσει την επαλήθευση του νέου κωδικό σας!'))
			{
				if(apprLength(new_pass1,4,16,'Ο κωδικός σας πρέπει να έχει μήκος τουλάχιστον 4 χαρακτήρες'))
				{
					if(samePass(new_pass1,new_pass2,'Οι κωδικοί που έχετε δώσει δεν ταιριάζουν μεταξύ τους!'))
					{
						return true;
					}
				}
			}
		}
	}
	
	return false;
}

/************************************************************************************************
* Sunartiseis gia tin elenxo tis allagis tou email toy xristi									*
*************************************************************************************************/
function checkModMail()
{
	var email=document.getElementById('email');
	
	if(nonEmpty(email,'Δεν έχετε συμπληρώσει ένα νέο email!'))
	{
	
		if(checkEmail(email,'Δεν έχετε δώσει μία σωστή διεύθυνση ηλεκτρονικού ταχυδρομείου!'))
		{
			return true;
		}
	}
	
	return false;
}

/************************************************************************************************
* Sunartiseis gia to an o xristis exei epilexei selidodeiktes pros diagrafi						*
*************************************************************************************************/
function checkCom()
{
	var comment=document.getElementById('comment');
	
	nonEmpty(comment,'Δεν έχετε συμπληρώσει κάποιο σχόλιο!');
}


/************************************************************************************************
* Sunartiseis gia tin tropopoiisi toy sxoliou enos selidodeikti									*
*************************************************************************************************/

function modifyCmnt()
{
	var new_cmnt=document.getElementById('new_cmnt');
	
	nonEmpty(new_cmnt,'Δεν έχετε συμπληρώσει κάποιο σχόλιο!');

}
