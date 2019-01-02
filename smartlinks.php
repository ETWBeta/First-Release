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
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/smartlinks.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<title>Earn TRON Wall - Smart links</title>
<meta name="robots" content="noindex">
<link rel="icon" type="image/png" href="images/relicon.png">
<body>
<br>
<div class="headertext"><span class="colored">Smart links</span></div>	
<p style="color: #FFF;">
</p><br>
<p style="text-transform: uppercase; text-align:center; color: #FFF; font-size: 100%; font-weight: bold; max-width: 95%; margin: 0 auto;">Smart links allow you to discover webpages that might interest you</p><br>
<p style="text-transform: uppercase; text-align:center; color: #FFF; font-size: 100%; font-weight: bold; max-width: 95%; margin: 0 auto;">Each successful visit will instantly grant 0.001 TRX to your wallet</p><br>
<br>
<p style="text-transform: uppercase; text-align:center; color: #FFF; font-size: 100%; font-weight: bold; max-width: 95%; margin: 0 auto;">
<?php
function Visit($url){
       $agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";$ch=curl_init();
       curl_setopt ($ch, CURLOPT_URL,$url );
       curl_setopt($ch, CURLOPT_USERAGENT, $agent);
       curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt ($ch,CURLOPT_VERBOSE,false);
       curl_setopt($ch, CURLOPT_TIMEOUT, 5);
       curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, FALSE);
       curl_setopt($ch,CURLOPT_SSLVERSION,3);
       curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, FALSE);
       $page=curl_exec($ch);
       //echo curl_error($ch);
       $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
       curl_close($ch);
       if($httpcode>=200 && $httpcode<300) return true;
       else return false;
}
if (Visit("86.38.40.97"))
		echo 'Server is currently <span style="color:green;">online</span>';
else
		echo 'Server is currently <span style="color:red;">offline</span>';
?>
</p><br>
<form method="post">
    <input type="submit" name="Link" id="Link" value="Open Smart Link" /><br/>
</form>
<p style="text-transform: uppercase; text-align:center; color: #FFF; font-size: 100%; font-weight: bold; max-width: 95%; margin: 0 auto;">Please do not use smart links while server is offline</p>
</body>
</html>
<style>
input {
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
	margin: 0 auto;
	text-align: center;
    display: block;	
}
</style>
<?php

function Smartlink()
{
	$username = $_SESSION['username'];	
	include('dbcon.php');	
	$query = "SELECT * FROM users WHERE username='$username' ";
	$result = mysqli_query($db, $query);
	$row = mysqli_fetch_array($result);
	$wallet = $row['wallet'];	
	file_get_contents('http://86.38.40.97/?wallet=' . $wallet);	
	sleep (2);
	header('Location: http://bodelen.com/afu.php?zoneid=2272227');
}

if(array_key_exists('Link',$_POST)){
   Smartlink();
}

?>