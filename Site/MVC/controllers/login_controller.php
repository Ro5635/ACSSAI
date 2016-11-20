<?php
/**
 *  This is the login controller, it handles the login system, this is the only controller for which unauthenticated users can have interactions. 
 */
class LoginController {

  public function form() {

    //Required Model:
    require_once('../MVC/models/Login.php');


    //Require the class for storing CSS and Script requirements:
    require_once($_SERVER['DOCUMENT_ROOT'] . '../PHPIncludes/pageLinkScriptsCSS.php');

    //Make an object of the pageLinkScriptsCSS class for storing the CSS requirements for the header:
    $pageRequirements = new pageLinkScriptsCSS();

    $pageRequirements->add("css", ['Animate.css', 'loginPage.css']);

    $pageRequirements->add("title", 'Login');

    $pageRequirements->add("js", ['assets/JS/Login.js']);


    //Render the standard page header:
    callStructural('header','std',$pageRequirements);

    require_once('views/pages/login.php');

    //Render the page footer:
    callStructural("footer", 'std', $pageRequirements); 


  }

  public function error404(){
      
    //Require the class for storing CSS and Script requirements:
    require_once($_SERVER['DOCUMENT_ROOT'] . '../PHPIncludes/pageLinkScriptsCSS.php');

      //Make an object of the pageLinkScriptsCSS class for storing the CSS requirements for the header:
    $pageRequirements = new pageLinkScriptsCSS();

    $pageRequirements->add("css", ['ErrorPage', 'Animate.css', 'WholeSite.css']);

    $pageRequirements->add("title", 'Error Page 404');

    $pageRequirements->add("js", ['assets/JS/js.js']);

    callStructural('header','std',$pageRequirements);


    call('menu','std');

    require_once('views/pages/error404.php');

      //Render the page footer:
    callStructural("footer", 'std', $pageRequirements); 




  }

    public function error() {

      //Require the class for storing CSS and Script requirements:
      require_once($_SERVER['DOCUMENT_ROOT'] . '../PHPIncludes/pageLinkScriptsCSS.php');

      $pageRequirements = new pageLinkScriptsCSS();

      $pageRequirements->add("css", ['error.css']);

      $pageRequirements->add("title", 'The Sky Is falling');

      callStructural('header','std',$pageRequirements);
      
      require_once('views/pages/error.php');

      //Render the page footer:
      callStructural("footer", 'std', $pageRequirements); 

    }
    
}
?>
