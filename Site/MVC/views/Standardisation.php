<?php
/**
 * Responsible for applying standardisation, this page will run for every http/https interaction with the server unless a file is directly referenced (eg image.png).
 */

//Update the include path
set_include_path($_SERVER['DOCUMENT_ROOT'] . '../MVC/');


//Set the footertype as the standard footer by default, unless anouther is specified this will be used:
$footerType = "Std";

//It is the responsibility of the page controller to insert a header to the page, this is so appropiate css files can be inserted for each page.

//Router:
require_once('Router.php'); 



 