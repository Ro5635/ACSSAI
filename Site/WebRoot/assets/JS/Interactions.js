//Javascript file responsable for interactions with the thing.

function startDictation() {

	if (window.hasOwnProperty('webkitSpeechRecognition')) {

		var recognition = new webkitSpeechRecognition();

		recognition.continuous = false;
		recognition.interimResults = false;

		recognition.lang = "en-UK";
		recognition.start();

		recognition.onresult = function(e) {

			recognition.stop();
		
			//Send AJAX
			dataToTransmit = 'speachresult=' + e.results[0][0].transcript;
		
			$.ajax({
				url: "/ajax/speachresponse",
				type: "POST",
				data: dataToTransmit,
				cache: false,
				success: function(reternedData) {
					$('#transcript').html(reternedData);					
				}
			});

		};

		recognition.onerror = function(e) {
			recognition.stop();
		}

	}
}


/**
 * Finds the verb in the transcript and calls the appropiate controller
 * @param  {[type]} transcript [The transcript returned fromt the speech recorgnision]
 * @return {[type]}            [description]
 */
function findVerb(transcript){


	var searchVerbs = ["turn", "switch"];
	

	var words = transcript.split(" ");

	var colours = ['red', 'blue', 'green','yellow','purple','orange', 'pink','lilac'];
	//Get the limit for the loop
	var limit = words.length - 1

	for (var i = 0; i <= limit; i++) {
		
		if(  jQuery.inArray(words[i], searchVerbs) > -1){
			if(jQuery.inArray('on', words) > -1){

				$('body').css('background-color','green');	

				
				
			}else if(jQuery.inArray('off', words) > -1){
				$('body').css('background-color','red');	
			}
			
		}

	};

	




}