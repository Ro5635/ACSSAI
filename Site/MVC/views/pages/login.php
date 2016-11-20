<?php
//Include the experimental html tag functions
include($_SERVER['DOCUMENT_ROOT'].'/../PHPIncludes/Libraries/HTMLTagExperimental.php');



//Function to clear out all session data and the local cookie
function clearAndStartSession(){

	session_unset();   // Remove the $_SESSION variable information.
	session_destroy(); // Remove the server-side session information.

	// Unset the cookie on the client-side.
	setcookie("PHPSESSID", "", 1); // Expire the PHP sessID cookie.

	setcookie("UserSessionID", "", time()); //Expire additional sessionID cookie

	// Start a new session
	session_start();

	// Generate a new session ID
	session_regenerate_id(true);

	// You have a completely empty, new session.

}

if(($_SERVER['REQUEST_METHOD'] == "POST")){


	if( $_POST['Password'] != '' && $_POST['UserName'] != '') {

		//Use the correct signature for the avalible data
		if(!isset($_POST['g-recaptcha-response'])){
			//Set
			$LoginAttempt = new Login($_POST['UserName'] , $_POST['Password']);

		}else{
			$LoginAttempt = new Login($_POST['UserName'] , $_POST['Password'], $_POST['g-recaptcha-response']);
		}

		
		if($LoginAttempt->authenticated == true){

			//Combat session fixation
			clearAndStartSession();

			//Generate a secure ID $PsudoRandID
			$psudoRandID = openssl_random_pseudo_bytes(50, $cstrong);

			//session_start();
			$_SESSION["UserName"] = $LoginAttempt->UserName;
			$_SESSION["UserType"] = $LoginAttempt->Type;
			$_SESSION["UserSessionID"] = $psudoRandID;

			//The UserSessionID is used as an addditionaly unique session tracker, paranoia really.
			setcookie("UserSessionID", $_SESSION["UserSessionID"], time()+3600, '/'); //Expire in one hour.

			//Save a hash of the useragent:
			$_SESSION['HashedUsrAgent'] = md5($_SERVER['HTTP_USER_AGENT']);

			header( 'Location: //' . $_SERVER['HTTP_HOST'] . '/home'   ) ;
			die;

			}

		}

		//If the user has not been redirected then login failed
		//Clear out the session
		clearAndStartSession();

		//Set the error message:

		if(!isset($_POST['Password']) || $_POST['Password'] == ''){
			$errorMessage[] = "Please provide a password!"; 
		}

		if(!isset($_POST['UserName']) || $_POST['UserName'] == ''){
			$errorMessage[] = "Please provide a UserName";
		}


		//Will need to implement a new way for this nofification...
		// if(!isset($_POST['g-recaptcha-response']) || $_POST['g-recaptcha-response'] == ''){
		// 	$errorMessage[] = "Please compleate the google recaptcha!";
		// }

		//If there is no error message set one:
		if(!isset($errorMessage)){
		//Set the error message:
			$errorMessage[] = "Login Failure, try again";	
		}

	}

	echo '<script src="https://www.google.com/recaptcha/api.js"></script>';
	echo '<body>';
	echo '<section id="FeaturedContentSection">';
	echo '<div class="Spacer"></div>';
	echo '<article>';
	echo '<div id="loginBox"><span id="LoginFormTitle">Login:</span>';

	if(isset($errorMessage)){
		echo '<ul class="errorText animated shake">';

		foreach($errorMessage as $message){
			echo '<li>' . $message . '</li>';
		}

		echo '</ul>';
	}

	?>



	<br>
	<form action="" method="POST" id="LoginForm">
		<div id="formElements">
			<span class="formElement">
				UserName:<br><input class="TextualInput" type="text" name="UserName" value="" placeholder="" id="UserName">
			</span>
			<br><br>
			<span class="formElement">
				Password:<br><input class="TextualInput" type="password" name="Password" value="" placeholder="" id="Password">
			</span>
			<br><br>
			<span class="formElement">

<?php
	//Find out wheather the google recapcha should be shown
	if( Login::requireFurtherAuth()  ){
		echo  '<div class="g-recaptcha" data-sitekey=""></div>';
	}
	
?>
	</span>
			<br><br>
			<span id="buttonSpacer"></span><input type="submit" name="" value="Login">
		</div>
	</form>

</div>

</article>

</section>

