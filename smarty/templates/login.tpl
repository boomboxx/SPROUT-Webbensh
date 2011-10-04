<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="de">
<head>
	<title>{$title}</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link href="index.css" rel="stylesheet" type="text/css" />   
	<script type="text/javascript" src="js/jquery-1.5.js"></script>
</head>
<body>
	{if $loginError == true}
	<div id="loginErrorWrap">
		Fehler: {$errorText}
	</div>
	{/if}
	<div id="loginWrap"{if $loginError == true} style="top:23px"{/if}>
		<div id="loginInnerWrap">
			<img src="gfx/index/login-sprout-logo.png" alt="SPROUT Webbench" />
			<form name="swbLogin" action="checkLogin.php" method="post" accept-charset="utf-8">
				<input type="text" name="loginUser" id="loginUser" />
				<input type="password" name="loginPassword" id="loginPassword" />
				<input type="submit" name="loginButton" id="loginButton" class="loginButton" value="Enter" />
			</form>
		</div>
	</div>
</body>
</html>