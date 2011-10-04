$(document).ready(function() {
	
	$.datepicker.regional['de'] = {clearText: 'löschen', clearStatus: 'aktuelles Datum löschen',
                closeText: 'schließen', closeStatus: 'ohne Änderungen schließen',
                prevText: '&#x3c;zurück', prevStatus: 'letzten Monat zeigen',
                nextText: 'Vor&#x3e;', nextStatus: 'nächsten Monat zeigen',
                currentText: 'heute', currentStatus: '',
                monthNames: ['Januar','Februar','März','April','Mai','Juni',
                'Juli','August','September','Oktober','November','Dezember'],
                monthNamesShort: ['Jan','Feb','Mär','Apr','Mai','Jun',
                'Jul','Aug','Sep','Okt','Nov','Dez'],
                monthStatus: 'anderen Monat anzeigen', yearStatus: 'anderes Jahr anzeigen',
                weekHeader: 'Wo', weekStatus: 'Woche des Monats',
                dayNames: ['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'],
                dayNamesShort: ['So','Mo','Di','Mi','Do','Fr','Sa'],
                dayNamesMin: ['So','Mo','Di','Mi','Do','Fr','Sa'],
                dayStatus: 'Setze DD als ersten Wochentag', dateStatus: 'Wähle D, M d',
                dateFormat: 'dd.mm.yy', firstDay: 1, 
                initStatus: 'Wähle ein Datum', isRTL: false};
        $.datepicker.setDefaults($.datepicker.regional['de']);
	
	$( ".datepickerUi").datepicker({
		changeMonth: true,
		changeYear: true
	});
	
	// Hover on tracking wraps
	$('.tracking-report-user-tracking-wrap').mouseenter(function() {

		$(this).find('.tracking-actions-wrap').css({
			display : 'inline'
		});
		
	});
	$('.tracking-report-user-tracking-wrap').mouseleave(function() {

		$(this).find('.tracking-actions-wrap').css({
			display : 'none'
		});
		
	});	
	
	// Click action for add-tracking-icon
	$('#trackingAddIcon').click(function() {
		
		$('.tracker-add-wrap').toggle();
		
	});
	
	// Cancelling tracking edit
	$('#trackingEditCancel').click(function() {
		
		window.location.href="index.php?page=timetrackerReportUser";
		
	});
	
	
});

function trackingDelete(trackingId) {
	
	var confirmDelete = confirm('Dieses Tracking wirklich löschen?');
	if (confirmDelete) {
		
		window.location.href = 'index.php?page=timetrackerReportUser&trackDelete='+trackingId;
		
	}
	
}