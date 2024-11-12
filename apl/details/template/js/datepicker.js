$(function datedata() {
	$("#finish").datepicker({

	changeMonth: true,
	    duration: 300,
	    showAnim: 'show',
			showOn: 'button',
			buttonImage: '../../images/icon_calendar.gif',
			buttonImageOnly: true,

	onSelect: function(dateText, inst) { 
	$("#finish").val(dateText);
	} 
	});
});
