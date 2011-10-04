var sproutMenuTimeout = setTimeout('sproutMenuHide()',1000);
var sproutSystemMessageTimeout = null;

$(document).ready(function() {
	
	$('#sprout-menu').fadeTo(0,0);
	$('#sprout-menu').css({display:'none'});
	
	$('#sprout-menu-button').bind('click', function(){
		
		clearTimeout(sproutMenuTimeout);
		
		$('#sprout-menu').css({display:'inline'});
		$('#sprout-menu').fadeTo(200,1);
		
		$('#sprout-menu').bind('mouseleave', function(){
			
			setTimeout('sproutMenuHide()',1000);

		});		

	});
	
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

	$( ".datepicker-init").datepicker({
		changeMonth: true,
		changeYear: true
	});
	
	// Set timeout for fade out system message
	setTimeout('sproutSystemMessageHide()',6000);
	
});
	
function sproutMenuHide() {
	
	$('#sprout-menu').fadeTo(200,0,function() {
		
		$('#sprout-menu').css({display:'none'});
		$('#sprout-menu').unbind('mouseleave');
		
	});	
	
} 

function sproutSystemMessageHide() {
	
	$('#head-system-message').fadeTo(1000,0);
	
} 