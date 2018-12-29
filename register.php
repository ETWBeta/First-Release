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
<title>Earn TRON Wall - Register</title>
<meta name="description" content="Earn TRON Wall aka ETW is a Mobile Friendly platform where You can earn Free TRX">
<script src="https://cdnjs.cloudflare.com/ajax/libs/particlesjs/2.2.2/particles.min.js"></script>
<meta name="robots" content="noindex">
<link rel="icon" type="image/png" href="images/relicon.png">
<meta name="theme-color" content="#000000"/>
<body onload="acceptParam()">
<div class="register">
<div class="animated fadeIn delay, registerform">
<img class="logo" src="images/logo.svg">
		<form autocomplete="off" method="post" action="register<?php if (isset($_GET['ref'])){ $name = $_GET['ref']; echo '?ref='.$name.'';} //Keeping ref in the url if user fails to register after submitting form?>">
		<?php include('errors.php') ?>
  	    <p><input type="text" name="username" placeholder="USERNAME" autocomplete="off" onkeyup="this.value = this.value.toUpperCase();"></p>
  	    <p><input type="text" name="wallet" placeholder="YOUR WALLET" autocomplete="off"></p>		
  	    <p><input type="password" name="password_1" placeholder="STRONG PASSWORD" autocomplete="off" onkeyup="this.value = this.value.toUpperCase();"></p>		
  	    <p><input class="hided" id="ref" type="text" name="ref" style="text-transform: uppercase" placeholder="Invited By" autocomplete="off" onkeyup="this.value = this.value.toUpperCase();"></p>
  	    <p><button type="submit" name="reg_user">SIGN UP</button></p>
		</form>
		<p><a href="login.php"><button class="button2">ALREADY HAVE ACCOUNT</button></a></p>		
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
<!-- Putting referral variable into invisible form element -->
<script>
function acceptParam() {
  var hashParams = window.location.href.substr(1).split('?'); // substr(1) to remove the `#`
      hashParams = hashParams[1].split('&');
      var p = hashParams[0].split('=');
      document.getElementById('ref').value = p[1].toUpperCase();
 }
</script>	