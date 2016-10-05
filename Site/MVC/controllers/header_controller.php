<?php
//Standard Header for most use cases:
  class headerController {

    public function std($pageRequirements) {
      //Include the standard header:
      require_once($_SERVER['DOCUMENT_ROOT'] . '../PHPIncludes/Views/Headers/StdHeader.php');

    }

//Header for display in case of an error:
    public function error($pageRequirements) {
      //At this point there is no error header so put ut the standard one:
      call('header','std',$pageRequirements);   //Humm, potential for a stack overflow here??

    }
  }
?>