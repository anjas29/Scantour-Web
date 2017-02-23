<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Scantour - Log In</title>

	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="/css/login/animate.css">
	<!-- Custom Stylesheet -->
	<link rel="stylesheet" href="/css/login/style.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>

<body>
	<div class="container">
		<div class="top" style="margin-top: 50px;">
			
		</div>
		<form action="/login" method="post">
			<div class="login-box animated fadeInUp">
				<div class="box-header">
					<h2>Scantour Web Login</h2>
				</div>
				<label for="email" style="margin-right: 5px;">Username </label>
				<input type="text" id="email" name="email">
				<br/>
				<label for="password" style="margin-right: 5px;">Password </label>
				<input type="password" id="password" name="password">
				<br/>
				{{csrf_field()}}
				<button type="submit">Log In</button>
				<br/>
			</div>
		</form>
	</div>
</body>

<script>
	$(document).ready(function () {
    	$('#logo').addClass('animated fadeInDown');
    	$("input:text:visible:first").focus();
	});
	$('#username').focus(function() {
		$('label[for="username"]').addClass('selected');
	});
	$('#username').blur(function() {
		$('label[for="username"]').removeClass('selected');
	});
	$('#password').focus(function() {
		$('label[for="password"]').addClass('selected');
	});
	$('#password').blur(function() {
		$('label[for="password"]').removeClass('selected');
	});
</script>

</html>