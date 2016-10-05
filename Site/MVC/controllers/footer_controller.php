<?php
//Standard footer for most use cases:
  class FooterController {
    public function std($pageRequirements) {

      require_once($_SERVER['DOCUMENT_ROOT'] . '../PHPIncludes/Views/Footers/StdFooter.php');
    }

//Footer for display in case of an error:
    public function error($pageRequirements) {
      require_once($_SERVER['DOCUMENT_ROOT'] . '../PHPIncludes/Views/Footers/ErrorFooter.php');
    }
  }
?>