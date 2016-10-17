<?php
////////////////
//////
//////	Some experimentaing going on here, has made for some much less readable code but does encapsualte relativly well.
//////	Robert Curran 22/7/2016
//////	
///////////////


//Creates a tag, the atributes should be passed as a atribute value pairs.
function createTag($tag, $content = '', $atributes = ''){
	if( isThere($content) && isThere($tag) && isThere($atributes)){
		$atributesString = getAtributeString($atributes);
		return '<' . $tag . ' ' . $atributesString . ' >' . $content . '</' . $tag . '>';

	}else if (isThere($content) && isThere($tag) && !isThere($atributes)){
		return '<' . $tag . ' >' . $content . '</' . $tag . '>';

	}else if(!isThere($content) && isThere($tag) && !isThere($atributes)){
		return '<' . $tag . ' ></' . $tag . '>';
	}else {
		error_log("Error, tag was called with incompatible parameters!, No tag had been printed. tag: " . $tag);
	}
}

//Returns a string of the passed array of atributes
//Pass as atribute value pairs.
function getAtributeString($atributes){
	$output = '';

	foreach ($atributes as $atribute) {
		$output .= $atribute[0] . '="' . $atribute[1] . '" ';
	}

	return $output;
}

//Checks to see if the argument is supplied, used to keep the checks out of each function
function isThere($arg){
	if(isset($arg) && $arg !=  ''){
		return true;

	}else{
		return false;

	}

}


//Redacting this fnction in favor of calling the bald createTag function...

/**
 * @param  [array] Contents of the div
 * @param  string  Id Name
 * @param  string  Class Nmae
 * @return string  The div
 */
function createDiv($contents, $idName = '',$className = ''){

	if(isThere($idName) && isThere($className)){
		return createTag('div',$contents, [ ['id',$idName] , ['class', $className] ] );

	}else if(isThere($idName) && !isThere($className)){
		return createTag('div',$contents, [ ['id',$idName] ]);

	}else{
		return createTag('div');
	}

}

