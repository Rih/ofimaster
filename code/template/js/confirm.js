/*
 * SimpleModal Confirm Modal Dialog
 * http://simplemodal.com
 *
 * Copyright (c) 2013 Eric Martin - http://ericmmartin.com
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 */
var url = "";
jQuery(function ($) {
	/*$('#confirm-dialog input.confirm, #confirm-dialog a.confirm').click(function (e) {
		e.preventDefault();

		// example of calling the confirm function
		// you must use a callback function to perform the "yes" action
		confirm("¿Desea confirmar esta operación?, recuerda que se eliminará el registro permanentemente.", function () {
			window.location.href = 'http://simplemodal.com';
		});
	}); */
	$('a.confirm').click(function (e) {
		e.preventDefault();

		// example of calling the confirm function
		// you must use a callback function to perform the "yes" action
		/*var url = $(this).attr('name');
		confirm("¿Desea confirmar esta operación?, recuerda que se eliminará el registro permanentemente.", function (url) {
			
			//var url = $(this).attr('href');
      		//$('a.confirm').load(url);
			window.location.href = url;
		});*/
		url = $(this).attr('name');
		confirm("¿Desea confirmar esta operación?, recuerda que se eliminará el registro permanentemente.", call_success);
		
	});
});

function call_success(url){
	window.location.href = url;
}

function confirm(message, callback) {
	$('#confirm').modal({
		closeHTML: "<a href='#' title='Cerrar' class='modal-close'>x</a>",
		position: ["20%",],
		overlayId: 'confirm-overlay',
		containerId: 'confirm-container', 
		onShow: function (dialog) {
			var modal = this;

			$('.message', dialog.data[0]).append(message);

			// if the user clicks "yes"
			$('.yes', dialog.data[0]).click(function () {
				// call the callback
				/*if ($.isFunction(callback)) {
					callback.apply();
				}*/
				call_success(url);
				url = "";
				// close the dialog
				modal.close(); // or $.modal.close();
			});
		}
	});
}