<?php 

//Getting data from variables

$db = mysqli_connect('', '', '', '');
$getusername = mysqli_real_escape_string($db,$_GET['username']); 
$getpayout = mysqli_real_escape_string($db,$_GET['payout']); 
$offerid = mysqli_real_escape_string($db,$_GET['offerid']); 

//Converting usd value to points value

$okpayout = round($getpayout * 100);

//Define reff payout

$refpayout = round($okpayout * 20 / 100); 

//Update points for user that made conversion

$query = "UPDATE users SET points = points + '$okpayout' WHERE username='$getusername' ";
mysqli_query($db, $query);

$query2 = "UPDATE users SET offers = offers + '1' WHERE username='$getusername' ";
mysqli_query($db, $query2);

//Getting ref username from row that made conversion

$query = "SELECT * FROM users WHERE username='$getusername' ";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);
$refusername = $row['ref'];

//And giving ref points

$query = "UPDATE users SET points = points + '$refpayout' WHERE username='$refusername' ";
mysqli_query($db, $query);

$query3 = "UPDATE users SET refearned = refearned + '$refpayout' WHERE username='$refusername' ";
mysqli_query($db, $query3);

//Adding completed offer ids for user basis

$query4 = "UPDATE users SET offerids = concat(offerids,'$offerid\n') WHERE username='$getusername' ";
mysqli_query($db, $query4);

?>