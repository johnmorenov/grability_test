/*
 * Funciones AJAX
 */

//Toma los parametros del formulario y devuelve el resultado de la consulta (Query)
function runCubeQuery() {
    if(runInputValidation()) {
    	resetInputValidation();

    	var parametros = {
    		'cubeDimensions': parseInt($('#cubeDimensions').val()),
    		'query': $('#query').val().trim(),
			'_token': $('input[name=_token]').val()
	    };

    	$.ajax({
	        data: parametros,
	        url: 'queryResult',
	        type: 'post',
	        beforeSend: function () {
	        	$('.loading').show();
	        },
	        success: function (data) {
	        	if(!parseInt(data.errCod)) {
	        		//OK!
	        		$('#result').html(data.result);
	        	} else {
	        		//Error
	        		showAlert('<strong>Error #'+data.errCod+':</strong> '+data.errMsg);
	        	}
	        }
	    }).done(function(){
	    	$('.loading').hide();
	    });
    }
}