<?php
/**
 * This class is used to hold the css and javascript files links that are to be added to a header or a footer.
 * What to call and where to save this class took far to long to think about. 
 *
 * A file is a text link to for the file which is to be included in the CSS or script link 
 */
class pageLinkScriptsCSS {

	private $files;

	function pageLinkScriptsCSS(){
	 	//Define the class varaibles:
		$this->files = [];
	}

	 /**
	  * Add a file to the file listing of the given type. Accepts the file as an array of files 
	  * @param [type] $type      [The 'type' that you wish to index the supplied file(s) with]
	  * @param [type] $fileArray [The file(s) for adding to the index]
	  */
     public function add($type, $fileArray){
     	
     	//Has that file type been added before?
     	if(array_key_exists($type, $this->files)){
     		//Add to existing array of that type:
     		array_push($this->files[$type], $fileArray);

     	}else{
     		//Create a new array of that type and add it to the $files array.
     		$this->files[$type] = $fileArray;

     	}

     	
     }

     /**
      * Get an array of all of the stored file links by type.
      * @param  [type] $type [The 'type' that you wish to get all of files for]
      * @return [type]       [Array containing all of the files of the given type]
      */
     public function getFiles($type){
     	return $this->files[$type];

     }

}