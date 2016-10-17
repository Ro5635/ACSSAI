<?php
	//Require the database connection:
  	require_once('../Connection.php');

	//This should be changed to explode the URL and pull the neccasaray variables as array index
	$URL =  $_SERVER['REQUEST_URI'];

	//Spits the request URI by the '/' deliminator:
	$requestSegments =  explode('/' , $URL);

	//Check that there was at least a controller and action defined:
	if((count($requestSegments) < 2) || (strlen($requestSegments[1]) < 1) ){
		//A minimum of a controller and an action is not defined so set to home page:
		$controller = 'pages';
    	$action     = 'home';
	} elseif (count($requestSegments) == 2){
		//So that the pages controller does not need to be used with the pages, if there is only one parameter the controller is assumed to be the pages controller,
		//the only remaning parameter is the action (page)
		$controller = 'pages';
    	
    	//The action will have the GET request paramters attached to it in the standard fassion, these will need to be removed:
		$actionAndGETVars = explode('?', $requestSegments[1]);

		//Action at index position 0:
		$action = $actionAndGETVars[0];


	} else{

		//Controller is in index 1 as index 0 contains the URL 
		$controller = $requestSegments[1];

		//The action will have the GET request paramters attached to it in the standard fassion, these will need to be removed:
		$actionAndGETVars = explode('?', $requestSegments[2]);

		//Action at index position 0:
		$action = $actionAndGETVars[0];
	}

	//Call standardisation to continue with page rendering:

  	require_once($_SERVER['DOCUMENT_ROOT'] . '/../MVC/views/Standardisation.php');
  	
