// JS Script
$(document).ready(function(){

	$('input').on( "change", function(){

		dataToTransmit = "red=" + $('#fader').val() + "&green=" +  $('#faderg').val() + "&blue=" +  $('#faderb').val() + "&elementid=0";

		$.ajax({
			url: "/ajax/setslider",
			type: "POST",
			data: dataToTransmit,
			cache: false,
			success: function(reternedData) {
				
			}
		});



	});


});