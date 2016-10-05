<?php
//LED Model
class LED {
  
	public $ElementID;
	public $State;
	public $RedChannel;
	public $GreenChannel;
	public $BlueChannel;
	

	//For saving a new Note the Note type will be the ID, all outher times it will be the string resentation.
	public function __construct($ElementID, $State, $RedChannel, $GreenChannel, $BlueChannel) {
		$this->ElementID      = $CustomerNoteID;
		$this->State =  $CustomerID;
		$this->RedChannel = $RedChannel;
		$this->GreenChannel = $GreenChannel;
		$this->BlueChannel = $BlueChannel;
	}


	public function getColour($ElementID){

		//Gets an array of the current colour from the DB, seperated by ',' in RGB format.

		$db = Db::getInstance();

		$req = $db->prepare('SELECT * FROM LightControl Where ElementID = :ElementID');
		$req->execute(array(':ElementID' => $ElementID));
		$Light = $req->fetch();


		if( strlen($Light['Red']) == 1 ){
			$Red = '00' . $Light['Red'];
		
		}elseif( strlen($Light['Red']) == 2 ){
			$Red = '0' . $Light['Red'];
		
		}else{
			$Red = $Light['Red'];
		
		}

		if( strlen($Light['Green']) == 1 ){
			$Green = '00' . $Light['Green'];
		
		}elseif( strlen($Light['Green']) == 2 ){
			$Green = '0' . $Light['Green'];
		
		}else{
			$Green = $Light['Green'];
		
		}

		if( strlen($Light['Blue']) == 1 ){
			$Blue = '00' . $Light['Blue'];
		
		}elseif( strlen($Light['Blue']) == 2 ){
			$Blue = '0' . $Light['Blue'];
		
		}else{
			$Blue = $Light['Blue'];
		
		}



		return  $Red . $Green  . $Blue;

	}


	public function setColour($ElementID, $red, $green, $blue){

		
		//Save the new Note to the database.
		$db = Db::getInstance();

		$req = $db->prepare('UPDATE LightControl SET Red = :red, Green = :green , Blue = :blue WHERE ElementID = :ElementID');
		$req->execute(array(':ElementID' => $ElementID, ':red' => $red, ':green' => $green, ':blue' => $blue ));

		//Return 1 for success.
		return 1;
	}

	public function updateNote($CustomerNoteID, $Note){

		
		//Save the new Note to the database.
		$db = Db::getInstance();

		$req = $db->prepare(' UPDATE CustomerNotes SET Note=:Note WHERE  CustomerNoteID = :CustomerNoteID');
		$req->execute(array(':CustomerNoteID' => $CustomerNoteID, ':Note' =>  $Note));

		//Return 1 for success.
		return 1;
	}






	
}

