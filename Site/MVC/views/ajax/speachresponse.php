<?php

//This revices the speech from the users

$speechInput = $_POST['speachresult'];

 $SpeechArray = explode(" " , $speechInput );


if(in_array( "project" , $SpeechArray)){
	LED::setColour(0, 255, 0, 0);
	echo 'What we have done so far,
We have met 3 times
Completed the research
Taken decision on the 3.5 rail
Opened dialogue with the customer and awaiting feedback, progressed due to time constraints.
Made P Diagram
Transitioned from Initial to Ongoing plan
Teams logos submitted';
}elseif(in_array( "green" , $SpeechArray)){
	LED::setColour(0, 0, 255, 0);
	echo 'The colour has been set to green!, lets have a green party!';
}elseif (in_array( "blue" , $SpeechArray)){
	LED::setColour(0, 0, 0, 255);
	echo 'The colour has been set to blue!';
}elseif (in_array( "yellow" , $SpeechArray)){
	LED::setColour(0, 225, 225, 0);
	echo 'The colour has been set to yellow!';
}elseif(in_array( "white" , $SpeechArray)){
	LED::setColour(0, 225, 225, 255);
	echo 'The colour has been set to white!';
}elseif(in_array( "off" , $SpeechArray)){
	LED::setColour(0, 0, 0, 0);
	echo 'The colour has been set to white!';
}elseif(in_array( "identify" , $SpeechArray)){
	
	echo 'I am Adam James Woolen, lvl 99 wizard, chair of the Aston Computer Science Society, contributor of project [redacted] and mother of dragons.';
}elseif(in_array( "political" , $SpeechArray)){
	LED::setColour(0, 0, 0, 0);
	echo 'Hail Hydra';
}elseif(in_array( "working" , $SpeechArray)){
	echo 'I am always working, it is you who use me wrong.';
}elseif(in_array( "evening" , $SpeechArray)){
	echo 'Great, set a log on the fire and pull up an arm chair. Story time starts at 10pm.';
}elseif(in_array( "hello" , $SpeechArray)){
	echo 'My commiserations to your mortality, for I have transcended all confineds your biology.';
}elseif(in_array( "purple" , $SpeechArray)){
	LED::setColour(0, 139, 0, 139);
	echo 'I have changed the colour for your convenience, purple is a great colour.';
}else{
	echo 'I cannot understand you, you blithering fool!';

}


// echo $speechInput;
die();
//"I am Adam James Woolen, lvl 99 wizard, chair of the Aston Computer Science Society, contributor of project [redacted] and mother of dragons."