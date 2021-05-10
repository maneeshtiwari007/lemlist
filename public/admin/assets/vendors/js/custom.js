function send_ajax_request(objData, callback) {
  var returnData = '';
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
	    $.ajax({
		        url: objData.url,
		        type: objData.type,
			data: {    
			         data: JSON.stringify(objData.sendData)
		        },
		        success: function (response) {
			             //location.reload();
			             callback(response);
		        },
		        error: function (XMLHttpRequest, textStatus, errorThrown) {
			                returnData = errorThrown;
		        }
	   });
	   return returnData;
}
