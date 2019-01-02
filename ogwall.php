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
//getting ids list of already completed offers
$username = $_SESSION['username'];	
include('dbcon.php');	

        $query = "SELECT * FROM users WHERE username='$username' ";
		$result = mysqli_query($db, $query);
		$row = mysqli_fetch_array($result);
		$offerids = $row['offerids'];		

$arr = explode( "\n", $row['offerids'] );
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/wall.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<title>Earn TRON Wall - OGAds</title>
<meta name="robots" content="noindex">
<link rel="icon" type="image/png" href="images/relicon.png">
<body>
<br>
<div class="headertext"><span class="colored">OGAds Wall</span></div>	
<p style="text-align:center; color: #FFF; font-size: 100%; font-weight: bold; max-width: 95%; margin: 0 auto;">Complete offers below to earn points</p><br>
<div class="list animated fadeIn" ng-show="List">
<?php
//getting user device
if( !function_exists('mobile_user_agent_switch') ){
	function mobile_user_agent_switch(){
		$device = 'desktop';
		
		if( stristr($_SERVER['HTTP_USER_AGENT'],'ipad') ) {
			$device = "ipad";
		} else if( stristr($_SERVER['HTTP_USER_AGENT'],'iphone') || strstr($_SERVER['HTTP_USER_AGENT'],'iphone') ) {
			$device = "iphone";
		} else if( stristr($_SERVER['HTTP_USER_AGENT'],'android') ) {
			$device = "android";
		}
		
		if( $device ) {
			return $device; 
		} return false; {
			return false;
		}
	}
}

$echdev = mobile_user_agent_switch();
 
//getting user ip
$ip = $_SERVER['REMOTE_ADDR'];
//getting user username
$username = $_SESSION['username'];
//url to request
$url = "https://mobverify.com/api/v1/?affiliateid=21867&ip=$ip&device=$echdev&aff_sub4=$username";

//initialize curl
$ch = curl_init();

//setup curl options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

//make request
$response = curl_exec($ch);

if($response === false) {
//curl error occurred
}

//close the curl object
curl_close($ch);

if($response !== false) {
	//curl request was successful
	//decode the json response into a php array
	$json = json_decode($response, true);

	if($json === false) {
		//failed to decode json response
		echo json_last_error_msg();

	} elseif($json['success']) {
		//api call was successful

		//loop through the offers and remove already completed
		$ids = array_map('trim', $arr);
		$i = 0;
		foreach($json['offers'] as $offer) {
			if (in_array($offer['offerid'], $ids)) {
        // skipping
        continue;
    }
			$i++;			
			//output
			$subject = $offer['adcopy'];
			
			$search  = array('content','unlock','this','?');
			$replace = array('points','get','','');
			$subject = $offer['adcopy'];
			
			echo '<a target="_blank" href='.$offer["link"].'>';
			echo '<div class="offer animated fadeIn zoom">';
			echo '<div class="image"><img src="'.$offer['picture'].'"></div>';
			echo '<div class="info">';
			
			echo "<div class='name ng-binding'>".$offer['name_short']."</div>";				
			echo "<div class='description ng-binding'>".str_replace($search, $replace, $subject)."</div>";
			
			echo '</div>';
			echo '<div class="points ng-binding"><b>+ '. round($offer["payout"] * 100) . '</b></div>';
			echo '</div>';
            echo "</a>";    

			if($i==40) break;			
		
		}

	} else {
	//api error occurred
	}

}

?>		
</div>			
</body>
</html>


