<?php
  class ajaxController {

    public function speachresponse() {
    	//Model:
    	require_once('../MVC/Models/LED.php');
    	//View:
    	require_once('views/ajax/speachresponse.php');
    

    }
    
    public function setslider(){
    	//Model:
    	require_once('../MVC/Models/LED.php');
    	//View:
    	require_once('views/ajax/SetSlider.php');

    }

    public function getcolour(){
    	//Model:
    	require_once('../MVC/Models/LED.php');
    	//View:
    	require_once('views/ajax/getcolour.php');

    }


  }
?>
