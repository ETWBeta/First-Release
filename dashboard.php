<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<?php
$username = $_SESSION['username'];	
include('dbcon.php');	
 //Loading user data from database
        $query = "SELECT * FROM users WHERE username='$username' ";
		$result = mysqli_query($db, $query);
		$row = mysqli_fetch_array($result);
		$points = $row['points'];
		$offers = $row['offers'];
		$refearned = $row['refearned'];		
//Counting referrals	
		$query2 = "SELECT * FROM users WHERE ref = '$username'";
		$result = mysqli_query($db, $query2);
		$refs = mysqli_num_rows($result);
?>
<!DOCTYPE html> 
<html lang="en">
<head> 
<title>Earn TRON Wall - Dashboard</title>
<meta name="description" content="Earn TRON Wall aka ETW is a Mobile Friendly platform where You can earn Free TRX">
<meta charset="utf-8">
<meta name="robots" content="noindex">
<meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1" media="(device-height: 568px)">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="HandheldFriendly" content="True">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel="stylesheet" type="text/css" media="all" href="css/reset.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/trunk.css" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
<link rel="icon" type="image/png" href="images/relicon.png">
<meta name="theme-color" content="#000000"/>
<link href="css/animate.css" rel="stylesheet">
<script src="js/sweetalert2.min.js"></script>
<link rel="stylesheet" href="css/sweetalert2.min.css">
<script type="text/javascript">
	if (typeof jQuery == 'undefined')
		document.write(unescape("%3Cscript src='js/jquery-1.9.js'" + 
															"type='text/javascript'%3E%3C/script%3E"))
</script>
<script type="text/javascript" language="javascript" src="js/trunk.js"></script>
</head> 
<body> 
<div class="container">
	<header class="slide">     <!--	Add "slideRight" class to items that move right when viewing Nav Drawer  -->
		<ul id="navToggle" class="burger slide">    <!--	Add "slideRight" class to items that move right when viewing Nav Drawer  -->
			<li></li><li></li><li></li>
		</ul>
		<h1>EARN<img class="h1img" src="images/tron.svg">WALL</h1> <!--	Add vector image between text -->
	</header>
	<nav class="slide">
		<ul>
			<li><a href="#Earn" onclick="earn()"><i class="far fa-hand-point-up"></i> EARN</a></li>
			<li><a href="#Withdraw" onclick="withdraw()"><i class="fas fa-exchange-alt"></i> WITHDRAW</a></li>
			<li><a href="#Invite" onclick="invite()"><i class="fas fa-users"></i> INVITE</a></li>
			<li><a href="#Faq" onclick="faq()"><i class="fas fa-question-circle"></i> FAQ</a></li>	
			<li><a href="#Contact" onclick="contact()"><i class="fas fa-envelope"></i> CONTACT</a></li>					
			<li><a href="?logout"><i class="fas fa-sign-out-alt"></i> LOGOUT</a></li>					
		</ul>
	</nav>
	<div class="content slide">     <!--	Add "slideRight" class to items that move right when viewing Nav Drawer  -->
		<ul class="responsive">
			<li class="body-section">
				<div class="scroll">
				<div class="placefiller">				
				<div class="animated fadeIn delay, contentwhite zoom">  <!-- Username -->
				<br>
				<p><img class="dashimg" src="images/user.svg"></p>
				<br>
				<p>LOGGED IN AS <span class="colored"><?php echo $username; ?></span></p>
				<br>
				</div>
				<div class="animated fadeIn delay, contentwhite zoom">  <!-- Tron Price -->
				<br>
				<p><img class="dashimg" src="images/tron.svg"></p>
				<br>
				<p>TRX PRICE <span class="colored">
				<?php
				$url = 'https://coinmarketcap.com/currencies/tron/';
				$html = file_get_contents( $url);
				libxml_use_internal_errors( true);
				$doc = new DOMDocument;
				$doc->loadHTML( $html);
				$xpath = new DOMXpath( $doc);
				$node = $xpath->query( '//span[@class="h2 text-semi-bold details-panel-item--price__value"]')->item( 0);
				echo $node->textContent;
				?>
				 USD</span></p>
				<br>
				</div>
				<div class="animated fadeIn delay, contentwhite zoom">  <!-- Balance -->
				<br>
				<p><img class="dashimg" src="images/balance.svg"></p>
				<br>
				<p>BALANCE <span class="colored"><?php echo $points; ?> POINTS</span></p>
				<br>
				</div>
				<div class="animated fadeIn delay, contentwhite zoom">  <!-- Completed offers stats -->
				<br>
				<p><img class="dashimg" src="images/checked.svg"></p>
				<br>
				<p>COMPLETED TASKS <span class="colored"><?php echo $offers; ?></span></p>
				<br>
				</div>
				<div class="animated fadeIn delay, contentwhite zoom">  <!-- Referrals -->
				<br>
				<p><img class="dashimg" src="images/users.svg"></p>
				<br>
				<p>REFERRALS <span class="colored"><?php echo $refs; ?></span></p>
				<br>
				</div>
				<div class="animated fadeIn delay, contentwhite zoom">  <!-- Referral earnings -->
				<br>
				<p><img class="dashimg" src="images/chart.svg"></p>
				<br>
				<p>REFERRAL EARNINGS <span class="colored"><?php echo $refearned; ?>&nbsp;POINTS</span></p>
				<br>
				</div>
				</div>
				</div>
			</li>
		</ul>
	</div>
</div>
<canvas class="animated fadeIn delay, background"></canvas>
<script src="https://cdnjs.cloudflare.com/ajax/libs/particlesjs/2.2.2/particles.min.js"></script>
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
<!-- Additional styles -->
<style>
.background {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 0;
}

.swal2-popup {
	border-radius: 0px;
	background-color: #000000;
    border: 1px solid #591710;	
	font-family: Helvetica;	
	text-transform: uppercase;	
}

.swal2-confirm {
	font-family: Helvetica;		
	width: auto;
    height: 45px;
    padding: 6px 10px;
	background: none;
    border: 1px solid #591710;
    box-shadow: none;
    box-sizing: border-box;
	color: #FFF;
    outline:none;
	font-weight: bold;
	font-size: 15px;
	outline: none;
	text-transform: uppercase;
}

.button2 {
	font-family: Helvetica;		
	width: auto;
    height: 45px;
    padding: 6px 10px;
	background: none;
    border: 1px solid #591710;
    box-shadow: none;
    box-sizing: border-box;
	color: #FFF;
    outline:none;
	font-weight: bold;
	font-size: 15px;
	outline: none;
	text-transform: uppercase;
}

.swal2-popup #swal2-content {
	color: #FFF;	
	font-weight: bold;
	font-size: 15px;
}

input {
	font-weight: bold;	
	font-family: Helvetica;				
    color: #FFF;
	width: 300px;
    height: 45px;
    padding: 6px 10px;
    border: none;
    box-shadow: none;
    box-sizing: border-box;	
    text-align: center;	
	font-size: 100%;
	outline: none;
	background-color: #000
}

.stroked {
    border-bottom: 1px solid #FFFFFF;	
}

a {
  color: white;
  text-decoration: none; /* no underline */
}
</style>
<!-- Main scripts -->

<!-- Faq swal -->
<script>
function faq() {
  
swal({
  html: "<span class='colored'>Frequently asked questions</span><p><span class='stroked'>How Do I Earn Points ?</span></p><br><p>Simply complete offers from selected ad network</p><br><p><span class='stroked'>When I will get my points ?</span></p><br><p>Points are mostly added instantly sometimes it may take a longer due to fraud checks</p><br><p><span class='stroked'>Why Didnt I Get My Points ?</span></p><br><p>You may have already completed that offer on some of your devices in the past</p><br><p><span class='stroked'>How to get more offers ?</span></p><br><p>You can use your android or ios device since ad networks has lots of app install and other mobile related offers</p><br><p><span class='stroked'>Why Dont I See Any Offers ?</span></p><br><p>You may have completed all the offers or you may be located in an area which does not have any offers available</p>",
  buttonsStyling: false,
  heightAuto: false
})

}

</script>
<!-- Earn swal -->
<script>
function earn() {
  
swal({
  html: "<span class='colored'>Earn points</span><p>Select ad network you wish to work with</p><br><p><span class='stroked'><a href='/ogwall.php' target='_blank'>OGAds</a></span></p><br><p><span class='stroked'><a href='http://wall.adgaterewards.com/nqacrQ/<?php echo $username; ?>' target='_blank'>Adgatemedia</a></span></p><br><p><span class='stroked'><a href='https://www.ayetstudios.com/offers/web_offerwall/507/TronWall?external_identifier=<?php echo $username; ?>' target='_blank'>Ayet-studios</a></span></p>",
  buttonsStyling: false,
  heightAuto: false
})

}

</script>
<!-- Withdraw swal -->
<script>
function withdraw() {
  
swal({
  html: "<span class='colored'>Withdraw to wallet</span><p>As of current rate 250 Points equals to 1 USD</p><br><p>You have <?php echo $points; ?> points which turns out to be <?php echo round($points / 100 / $node->textContent,6) / 2.5; ?> TRX</p><br><a href='?withdraw'><button type='button' class='button2'>Withdraw</button></a>",
  buttonsStyling: false,
  heightAuto: false
})

}

</script>
<!-- Invite swal -->
<script>
function invite() {
copyTextToClipboard('https://www.earntronwall.com/?ref=<?php echo strtolower($username); ?>');		
swal({
  html: "<span class='colored'>Invite friends</span><p>Invitation link has been copied to your clipboard</p><br><p>You will get 20% commission of their lifetime earnings</p>",
  buttonsStyling: false,
  heightAuto: false
})

}
</script>
<!-- Contact swal -->
<script>
function contact() {
swal({
  html: "<span class='colored'>Contact</span><p>Write us at mail@earntronwall.com</p>",
  buttonsStyling: false,
  heightAuto: false
})

}
</script>
<!-- Adding ref link to clipboard -->
<script>
function copyTextToClipboard(text) {
    var copyFrom = $('<textarea/>');
    copyFrom.text(text);
    $('body').append(copyFrom);
    copyFrom.select();
    document.execCommand('copy');
    copyFrom.remove();
}
</script>
<!-- Used to remove variables from url -->
<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", "/dashboard");
    }
</script>
<!-- Withdrawal -->
<?php
if (isset($_GET['withdraw'])){
$username = $_SESSION['username'];	
include('dbcon.php');	
        $query = "SELECT * FROM users WHERE username='$username' ";
		$result = mysqli_query($db, $query);
		$row = mysqli_fetch_array($result);
		$points = $row['points'];
		$wallet = $row['wallet'];	
        $points2trx = round($points / 100 / $node->textContent,6) / 2.5;		
		if ($points > 0) {
		echo '<script>swal({text: "TRX Will be sent to your wallet within 24 hours", buttonsStyling: false, heightAuto: false}).then(function(){ location.reload();});</script>';	
		$query = "INSERT INTO transactions (trx, wallet, username) 
  			  VALUES('$points2trx', '$wallet', '$username')"; // Adding user wallet and amount of TRX to database, that will be sent manually on the Mainnet
		mysqli_query($db, $query);
		$query2 = "UPDATE users SET points = points - $points WHERE username='$username'";
		mysqli_query($db, $query2);	
		} 
		else {	
	    echo '<script>swal({text: "It would be wise to earn some points before withdrawing", buttonsStyling: false, heightAuto: false});</script>';
}
} 
?>	