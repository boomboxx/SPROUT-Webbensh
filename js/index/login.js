$(document).ready(function() {
	
	$('#loginButton').bind('click', function(evt){
		
		// AJAX loader image
		$('#loginButton').css({
			marginTop:'33px',
			border:'none'
			
		});
		$('#loginButton').attr('src','gfx/ajax-loader.gif');
		
		// Check if loginUser and loginPassword have data
		formUserValue = $('#loginUser').val();
		formPasswordValue = $('#loginPassword').val();
		
        $.ajax({
			type: "GET",
			url: "checkLogin.php",
			data: "formUser="+formUserValue+"&formPassword="+formPasswordValue+"",
			success: function(notice){
				
				// AJAX loader image
				$('#loginButton').attr('src','gfx/index/login-button-background.png');
				$('#loginButton').css({
					marginTop:'30px',
					border:'1px solid #bcbcbc'
					
				});				
				    	   
				// Display error notice if error is found
				addErrorNotice(notice);

			}
        });		
  
	});
	
});

function addErrorNotice(errorText) {
	
	$('#loginErrorWrap').remove();
	$('body').prepend("<div id='loginErrorWrap'>"+errorText+"</div>");
	$('#loginWrap').css('top','23px');
	return false;
	
}
