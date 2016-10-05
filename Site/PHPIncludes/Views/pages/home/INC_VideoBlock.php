<?php

////////////////Functions:

//Creates a list of list items containing links, pass the links as [ ['LinkText', Destination] , ...] pairs.
function createLinkingListItems($linksForProduction, $liAtributes = ''){
	$stringBuild = '';

	foreach ($linksForProduction as $listItem) {

		$stringBuild .= createTag('li', createTag('a', $listItem[0], [ ['href', $listItem[1]] , ['class', 'stdButtonStyle'] ]  ) , $liAtributes);
	}

	return $stringBuild;
}

/**
 * Creates the navigation options bellow the video to be used by the user.
 */
function createVideoNav(){
	$stringBuild = '';

	$stringBuild .= '<div id="videoNavWrapper">';
	$stringBuild .= '<a id="toIndexButt" href="?vid=index" class="stdButtonStyle">back</a>';
	$stringBuild .= '</div>';

	return $stringBuild;
}


function createVideosIndex(){
	$videoTitle = 'How To:';

	echo '<div id="TutorialsBoxTitle"><h3>' . $videoTitle . '</h3></div>';

	//Need to create all of the links for the videos that can be watched:

	//Array containg the links that are to be made:
	//Defined as: [LinkText,DestinationURL]
	$linksForProduction = [ ['Login For The First Time >>','?vid=firstlogin'] , ['Upload Your Site >>','?vid=siteupload'] , ['Set Up Your Own Domain >>','?vid=customdomain']  ]; 

						//String builder, to be used to construct the list of links inside to out.
	$stringBuilder = '';


	$stringBuilder .= createTag('ul', createLinkingListItems($linksForProduction) , [ ['id', 'TutorialBoxVideoLinks'] ]);

	//Enclose the list in a wrapper, then print it to the screen:
	echo createTag('div', $stringBuilder, [ ['id', 'TutorialBoxVideoLinksWrapper'] ]);
}

function firstLoginVideo(){

	$videoTitle = 'How To: First Login';

	echo '<div id="TutorialsBoxTitle"><h3>' . $videoTitle . '</h3></div>';

	echo '<div class="youTubeVidWrapper">';

	echo '<iframe width="853" height="480" src="https://www.youtube-nocookie.com/embed/b90oSSyOGDU?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>';

	echo '</div>';

	echo createVideoNav();
}

function siteUploadVideo(){

	$videoTitle = 'How To: Upload Your Site';

	echo '<div id="TutorialsBoxTitle"><h3>' . $videoTitle . '</h3></div>';

	echo '<div class="youTubeVidWrapper">';

	echo '<iframe width="853" height="480" src="https://www.youtube-nocookie.com/embed/k6tv_A1bvCs?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>';

	echo '</div>';

	echo createVideoNav();
}

function customDomainVideo(){

	$videoTitle = 'How To: Use Your Own Domain';

	echo '<div id="TutorialsBoxTitle"><h3>' . $videoTitle . '</h3></div>';

	echo '<div class="youTubeVidWrapper">';

	echo '<iframe width="853" height="480" src="https://www.youtube-nocookie.com/embed/gocwRvLhDf8?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>';

	echo '</div>';

	echo createVideoNav();
}

////////////////End Functions

//Is there an instruction as for whcih video to load?
if(isset($_GET['vid'])){

	switch ( $_GET['vid'] ) {
		case  'index':
			createVideosIndex();
		break;
		case 'firstlogin':
			firstLoginVideo();
		break;
		case 'siteupload':
			siteUploadVideo();
		break;
		case 'customdomain':
			customDomainVideo();
		break;

		default:
			createVideosIndex();
		break;
	}

} else{
	//Display the index of videos:
	createVideosIndex();
}


//Create the Tutorials Video Block:







?>