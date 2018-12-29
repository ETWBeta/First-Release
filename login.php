<?php include('server.php') ?>
<?php
header("Cache-Control: private, max-age=10800, pre-check=10800");
header("Pragma: private");
header("Expires: " . date(DATE_RFC822,strtotime("+2 day")));
?>
<!DOCTYPE html>
<!-- Avoiding white flicker while navigating through pages -->
<style> 
body {
	font-family: Helvetica;	
	background-color: #000000;	
}
</style>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/animate.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<title>Earn TRON Wall - Login</title>
<meta name="description" content="Earn TRON Wall aka ETW is a Mobile Friendly platform where You can earn Free TRX">
<script src="https://cdnjs.cloudflare.com/ajax/libs/particlesjs/2.2.2/particles.min.js"></script>
<meta name="robots" content="noindex">
<link rel="icon" type="image/png" href="images/relicon.png">
<meta name="theme-color" content="#000000"/>
<body>
<div class="register">
<div class="animated fadeIn delay, registerform">
<img class="logo" src="images/logo.svg">
		<form autocomplete="off" method="post" action="login">
		<?php include('errors.php') ?>
  		<p><input type="text" name="username" placeholder="USERNAME" autocomplete="off" onkeyup="this.value = this.value.toUpperCase();"></p>
  		<p><input type="password" name="password" placeholder="PASSWORD" autocomplete="off" onkeyup="this.value = this.value.toUpperCase();"></p>
		<p><button type="submit" name="login_user">LOG IN</button></p>
		</form>
		<p><a href="register.php"><button class="button2">CREATE ACCOUNT</button></a></p>	
</div>
</div>
<canvas class="animated fadeIn delay, background"></canvas>
<!-- Loading particles -->
<script>
var particles = Particles.init({
	selector: '.background',
  color: ['#591710', '#FFFFFF', '#591710'],
maxParticles: '100',
sizeVariations: '4'
});
</script>	
</body>
</html>