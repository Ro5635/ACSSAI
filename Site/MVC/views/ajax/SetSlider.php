<?php
//saves the slider values to the database:

$ElementID = $_POST['elementid'];
$red = $_POST['red'];
$green = $_POST['green'];
$blue = $_POST['blue'];

//Save the changes to the database:
LED::setColour($ElementID, $red, $green, $blue);