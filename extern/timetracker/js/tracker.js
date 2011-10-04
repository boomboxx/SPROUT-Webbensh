var trackHours = 0;
var trackMinutes = 0;
var trackSeconds = 0;
var trackRunning = false;
var trackTimeout = null;
var trackState = 'none';
var customerChosen = false;
var projectChosen = false;
var trackingSaved = false;
var validNavigation = false;
var messageText = '';
var messageType = '';
var intervalSound = null;

$(document).ready(function() {
	
	$(window).unload(function() {
		
		endSession();
		
	});
	
	checkMessageDisplaying();
	checkIfProjectsAvailable();
	setSoundInterval();
	
	$('#buttonAddCustomer').click(function() {
		
		addCustomer();
		
	});
	
	$('#buttonAddProject').click(function() {
		
		addProject();
		
	});	
	
	$('.button-save').click(function() {

		saveTracking();

	});	
	
	$('#cid').change(function() {
		
		customerChange();
		
	});
	
	$('#pid').change(function() {
		
		projectChange();
		
	});	
	
	$('.button-stop').fadeTo(0,0);
	
	$('.button-play-pause').click(function() { 
		
		checkPlayPause(); 
	
	});
	
	$('.button-stop').click(function() {
		
		checkStop();
		
	});
	
	$('#projectAddCancel').click(function() {
		
		addProjectCancel();
		
	});
	
	$('#projectAddSave').click(function() {
		
		addProjectSave();
		
	});
	
});

function customerChange() {
	
	var cid=$('#cid').val();
	window.location.href='tracker.php?cid='+cid;
}

function projectChange() {
	
	var cid=$('#cid').val();
	var pid=$('#pid').val();
	window.location.href='tracker.php?cid='+cid+'&pid='+pid;
}

function checkIfProjectsAvailable() {
	
	var elementsArray = $('.pidOption');
	
	if (elementsArray.length > 0) {
		
		   $('#category-wrap').css({
			   display:'inline'
		   });
		   
		   $('#comment-wrap').css({
			   display:'inline'
		   });		   
		   
		   $('#type-wrap').css({
			   display:'inline'
		   });				   
		   
		   $('.button-play-pause').fadeTo(500,1,function() {
			   $('.button-stop').fadeTo(500,1);
		   });		
		
	} else {
		
		   $('#category-wrap').css({
			   display:'none'
		   });
		   
		   $('#comment-wrap').css({
			   display:'none'
		   });		   
		   
		   $('.button-play-pause').fadeTo(500,0,function() {
			   $('.button-stop').fadeTo(500,0);
		   });				
		
	}
	
}


function checkStop() {
	
	stopTracking = confirm('Tracking wirklich beenden?');
	if (stopTracking) {
		
		clearInterval(trackTimeout);
		
		var secondsAdd = '';
		var minutesAdd = '';
		var hoursAdd = '';

		if (trackSeconds < 10) { secondsAdd = '0'; }
		if (trackMinutes < 10) { minutesAdd = '0'; }
		if (trackHours < 10) { hoursAdd = '0'; }		
		
		finalSeconds = trackSeconds+(trackMinutes*60)+(trackHours*3600);
		finalUnits = finalSeconds/900;
		finalHours = finalUnits/4;
		
		//alert('zeit: '+hoursAdd+trackHours+':'+minutesAdd+trackMinutes+':'+secondsAdd+trackSeconds+' / units: '+finalUnits+' / stunden: '+finalHours);
		
		// Rounding
		// DEBUG
		//if (trackHours == 66 ) {		
		if (trackHours == 0 && trackMinutes == 0 ) {
			
			alert('Unter einer Minute, es erfolgt keine Erfassung');
			resetTracker();
			
		} else {
			
			// Round up minutes
			var stringUnits = finalUnits.toString();
			var arrayUnits = stringUnits.split('.');
			
			if (arrayUnits.length > 1) {
				
				var finalUnitsMod = parseInt(arrayUnits[0]);
				var stringUnitsMod = '0.'+arrayUnits[1];
				var modUnits = parseFloat(stringUnitsMod);
				
				if (modUnits > 0.0677) {
					
					finalUnitsMod++;
					
				} 
				
				var finalHoursMod = finalUnitsMod/4
				
				//alert ('Endgültige Units: '+finalUnitsMod+' / Stunden: '+finalHoursMod);
				
				// Set values of hidden fields
				$('#unitsNeeded').val(finalUnitsMod);
				$('#nettoSeconds').val(finalSeconds);
				
			}
			
			saveTracking();
			
		}
		
		$('.head-wrap').css({
		
			background:'url(gfx/head-default.png)'
		
		});		
		
		$('.head-text').css({
		
			color: '#000000'
		
		});		
		
		$('.head-text').html('Bitte Kunde und Projekt wählen');		
		
		$('.button-stop').animate({ 

			left: '44'

		},200);	

		$('.button-stop').fadeTo(0,0);

		$('.button-play-pause').fadeTo(500,0,function() {
			
			$('#control-play-pause').attr('src','gfx/button-play.png');
			trackState = 'none';			
			
		});
		
		$('#record-pulse').css({ 

			display:'none'

		});		

	}
	
}

function saveTracking() {
	
	// Saving units to DB if comment field not empty
	if (!checkCommentField()) {

		alert('Bitte einen Kommentar eingeben!');
		$('.button-save').fadeTo(300,1);

	} else {
		
		$('#cid').removeAttr('disabled');
		$('#pid').removeAttr('disabled');
		$('#catid').removeAttr('disabled');		
		
		document.trackForm.submit();
	}
	
}

function hideOverlay() {
	
	$('.overlay-message').fadeTo(200,0,function() {
		
		$('.overlay-message').html('');
		$('.overlay-wrap').fadeTo(200,0,function() {
			
			$('.overlay-wrap').css({
			
				display: 'none'
				
			});
			
			$('.overlay-message').css({
				
				display: 'none'
				
			});			
			
			
		});
		
	});
	
}

function resetTracker() {
	
	// Set customer dropdown back to choosing
	$('#cid').prepend('<option value="0" class="cidChoose">bitte wählen</option>');
	$('.cidChoose').attr('selected', true);
	
	$('#cid').removeAttr('disabled');
	$('#pid').removeAttr('disabled');
	$('#catid').removeAttr('disabled');	
		
	// Remove projects
	$('.pidOption').remove();
	
	// Clear comment
	$('#trackText').val('');
	
	$('#project-wrap').css({
		display:'none'
	});
   
	$('#category-wrap').css({
		display:'none'
	});
   
	$('#comment-wrap').css({
		display:'none'
	});		
	
	$('#type-wrap').css({
		display:'none'
	});		
	
	$('.button-save').css({
		display:'none'
	});	
	
	trackSeconds = 0;
	trackMinutes = 0;
	trackHours = 0;
	
	setTrackingDisplay();	
	
	$('.logout').fadeTo(200,1,function() {
		
		$('.logout').css({
			
			display: 'inline'
			
		});
		
	});
	
	// Set sound interval
	setSoundInterval();
	
}

function checkCommentField() {
	
	if ($('#trackText').val() == '') {
		
		return false;
		
	} else {
		
		return true;
		
	}
	
}

function checkPlayPause() {

	if (trackState == 'none' || trackState == 'pause') {
		
		// Clear interval for sound
		clearInterval(intervalSound);

		trackTimeout = setInterval("addSecond()",1000); 
		trackState = 'record';
		
		$('.logout').fadeTo(200,0,function() {
			
			$('.logout').css({
				
				display: 'none'
				
			});
			
		});

		$('.head-wrap').css({
		
			background:'url(gfx/head-record.png)'
		
		});
		
		$('.head-text').css({
		
			color: '#ffffff'
		
		});		
		
		$('#record-pulse').fadeTo(200,1);
		
		$('.head-text').html('Tracking läuft');
		
		// Disable form fields
		$('#cid').attr('disabled', true);
		$('#pid').attr('disabled', true);
		//$('#catid').attr('disabled', true);
		
		$('#control-play-pause').attr('src','gfx/button-pause.png');
		$('#control-play-pause').attr('title','Tracking pausieren');

	} else {
		
		// Set sound interval
		setSoundInterval();

		trackState = 'pause';
		clearInterval(trackTimeout);
		$('#control-play-pause').attr('src','gfx/button-play.png');
		$('#control-play-pause').attr('title','Tracking starten');
		
		// Change head colour to yellow
		$('.head-wrap').css({
			
			background:'url(gfx/head-pause.png)'
		
		});		
		
		// Fade out record-pulse
		$('#record-pulse').fadeTo(200,0);
		
		$('.head-text').html('Tracking pausiert');
		

	}

	// Hide/display stop button
	if (trackState == 'record' || trackState == 'pause') {

		$('.button-stop').animate({ 

			left: '84'

		},200);
		
		$('#record-pulse').css({ 

			display:'inline'

		});			

	} else {

		$('#button-stop').css({ 

			display:'none'

		});			

	}

}

function addSecond() {

	trackSeconds++;
	if (trackSeconds > 59) {

		trackSeconds = 0;
		trackMinutes++;

		if (trackMinutes > 59) {

			trackMinutes = 0;
			trackHours++;

		}

	}

	setTrackingDisplay();

}

function setTrackingDisplay() {
	
	var secondsAdd = '';
	var minutesAdd = '';
	var hoursAdd = '';

	if (trackSeconds < 10) { secondsAdd = '0'; }
	if (trackMinutes < 10) { minutesAdd = '0'; }
	if (trackHours < 10) { hoursAdd = '0'; }

	$('#counterSeconds').html(secondsAdd+trackSeconds);
	$('#counterMinutes').html(minutesAdd+trackMinutes);
	$('#counterHours').html(hoursAdd+trackHours);

}

function addCustomer() {
	
	$('.overlay-wrap').fadeTo(200,0.9,function() {
		
		$('#customer-add-wrap').fadeTo(200,1);
		
		// Cancel cutomer/project addition
		$('#customerAddCancel').click(function() {
			
			$('#customer-add-wrap').fadeTo(200,0,function() {
				
				$('.overlay-wrap').fadeTo(200,0,function() {
					
					$('.overlay-wrap').css({
						
						display: 'none'
						
					});					
					
				});
				
			});
			
			$('#customer-add-wrap').css({
				
				display: 'none'
				
			});	
			
			$('#customerAddCancel').unbind('click');
			
		});
		
	});
	
}

function addProject() {
	
	$('.overlay-wrap').fadeTo(200,0.9,function() {
		
		$('#project-add-wrap').fadeTo(200,1);
		
	});
	
}

function addProjectCancel() {
	
	$('#project-add-wrap').fadeTo(200,0,function() {
		
		$('.overlay-wrap').fadeTo(200,0,function() {
			
			$('.overlay-wrap').css({
				
				display: 'none'
				
			});					
			
		});
		
	});
	
	$('#project-add-wrap').css({
		
		display: 'none'
		
	});		
	
}

function addProjectSave() {
	
	var contJobnumber = $('#projectJobnumber').val();
	var contTitle = $('#projectTitle').val();
	var errorProjectAdd = false;	
	
}

function checkMessageDisplaying() {
	
	if (messageText != '') {
		
		$('#tracker-message').html(messageText);
		var trackerMessageBg = '1a5a06';
		if (messageType == 'failed') {
			
			trackerMessageBg='b00404';
			
		}
		$('#tracker-message').css({
			
			backgroundColor : '#'+trackerMessageBg
			
		});
		
		$('#tracker-message').fadeTo(200,0.9,function() {
			
			var hideTM = setTimeout('hideTrackerMessage()',2000);
			
		});
		
	}
	
}

function hideTrackerMessage() {
	
	$('#tracker-message').fadeTo(200,0,function() {
		
		$('#tracker-message').css({

			display:'none'
			
		});
		
	});
	
}

function setSoundInterval() {
	
	intervalSound = setInterval('loadSound();',600000);
	
}

function loadSound() {
	
	$('body').prepend(
	
			'<div id="flashSound"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="1" height="1" id="myFlashContent"><param name="movie" value="swf/sound_flash.swf" /><!--[if !IE]>--><object type="application/x-shockwave-flash" data="swf/sound_flash.swf" width="1" height="1"><!--<![endif]--><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a><!--[if !IE]>-->	</object><!--<![endif]--></div>'
	
	);
	
	setTimeout('unloadSound()',10000);
	
}

function unloadSound() {

	$('#flashSound').remove();
	
}