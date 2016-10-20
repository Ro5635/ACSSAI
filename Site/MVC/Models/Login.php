<?php
//This model is responsible for handaling the user log in.
//
// 10 October 2016, extened to include the methords of the now defunct loginAttempts class,
// For this allows for the reduction of dependecys, the class is now dealing with two tables
//
// @author Robert Curran robert@robertcurran.co.uk

class Login {
  // we define 3 attributes
  // they are public so that we can access them using $Product->author directly
	public $UserName;
	public $Type;
	public $authenticated;


	public function __construct($UserName, $Password, $gRecapcha = '') {
		
		//Set the instance variables
		$this->UserName = null;
		$this->Type  = null;
		$this->authenticated = false;
		
		//Attempt to login
		$this->attemptLogin($UserName, $Password, $gRecapcha);



	}


	//Checks the supplied login details and returns a login object if the credentails supplied where 
	//correct, there is an option of weather to supply the google rechapcha response, this is because
	//the user is not allways required to provide this.
	//
	//There are a few edge cases where this will result in correct login details being refused
	private function attemptLogin($UserName, $Password , $recaptchaResponse = '') {


		//Have the further Security checks been passed
		$furtherSecurityPassed = false;

		//Should the recapcha be used
		if( self::requireFurtherAuth() ){
			//Check the further authentication method
			$furtherSecurityPassed = $this->checkGRecaptcha($recaptchaResponse);


		}else{
			//Further check not necasary, further check passed.
			$furtherSecurityPassed = true;

		}


		if($furtherSecurityPassed){
			//Further checks passed, procced to check login details

			$db = Db::getInstance();

			$req = $db->prepare('Select * FROM Users WHERE UserName = :UserName AND UserTokenHashed = SHA1(:Password);');
   			// the query was prepared, now we replace :id with our actual $id value
			$req->execute(array(':UserName' => $UserName, ':Password' => $Password));
			$User = $req->fetch();

			if(count($User) > 1){
				//Successful Login

				//Set the intacnce variables as appropiate to signify success.
				$this->UserName = $User['UserName'];
				$this->Type = $User['AccessType'];
				$this->authenticated = true;

				//Log the login
				$this->logLoginAttempt($UserName ,1);

			}else{
				//Login failure

				//Log the attempt
				$this->logLoginAttempt($UserName ,0);
			}


		}else{
			//Further checks failed!
			//Login failure

			//Log the attempt
			$this->logLoginAttempt($UserName ,0);


		}


	}


	/*
		Returns a boolean denoting wheather or not further autehntication should be required from users.
		Returns false if further authentication should be required.
		Returns true if no further authentication should be required. 
	 */
		public static function requireFurtherAuth() {

			//The maximum number of login failures per 24 hour period, change the value bellow to edit.
			$maxAcceptableFail24Hours = 10;

			$db = Db::getInstance();

			$req = $db->prepare(' SELECT COUNT(*) AS LoginAttemtpsToday  FROM LoginAttempts WHERE DATE(AttemptedAt) = CURDATE() AND LoginAttemptState = 0');

			$req->execute();
			$LoginAttemtpsToday = $req->fetch();

			$LoginFailCountToday = $LoginAttemtpsToday['LoginAttemtpsToday'];

			if($LoginFailCountToday >= $maxAcceptableFail24Hours){


				return true;

			}else{
			//There have been a large number of failed login attempts today, this is an issue that admin would like to be
			//aware of, alert them!

			//TO DO Somekind of notify global function

				return false;
			}


		}

	/**
	 * Logs succesfull and unscuesful attemtps to login to the system, requires the attempted username and 
	 * wheather or not the login was a success, This is denoted by the boolean $authenticated.
	 * 
	 * @param  [string] $attemptedUserName [The user name that was used in the login attempt]
	 * @param  [boolean] $authenticated     [Was the login succesful]
	 * @return [void]                    [returns void]
	 */
	private function logLoginAttempt($attemptedUserName , $authenticated = 0){

		//Clean the user Name
		$cleanedUserName = filter_var($attemptedUserName, FILTER_SANITIZE_STRING);

		//Ensure that the authentication string is clean
		$cleanedAuthentication = filter_var($authenticated, FILTER_SANITIZE_STRING);;

		$db = Db::getInstance();

		//INSERT INTO LoginAttempts () VALUES()
		//INSERT INTO LoginAttempts (AttemptedUserName, LoginAttemptState ) VALUES( :AttemptedUserName , :authenticated)
		$req = $db->prepare('INSERT INTO LoginAttempts (AttemptedUserName, LoginAttemptState ) VALUES( :AttemptedUserName , :authenticated)');

		$req->execute(array(':AttemptedUserName' => $cleanedUserName , ':authenticated' => $cleanedAuthentication));


	}

	/*
	*	Checks the response from googles recapacha against googles systems. Requires the response from the google form element.
 	*/
	private function checkGRecaptcha($recaptchaResponse){

		try {

			$url = 'https://www.google.com/recaptcha/api/siteverify';
			$data = ['secret'   => 'YOUR SECRET KEY',
			'response' => $recaptchaResponse,
			'remoteip' => $_SERVER['REMOTE_ADDR']];

			$options = [
			'http' => [
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data) 
			]
			];

			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			return json_decode($result)->success;
		}

		catch (Exception $e) {
			return null;
		}

	}


}