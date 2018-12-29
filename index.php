<!DOCTYPE html> 
<html lang="en">
<head> 
<title>Earn TRON Wall</title> 
<meta name="description" content="Earn TRON Wall aka ETW is a Mobile Friendly platform where You can earn Free TRX">
<meta charset="utf-8">
<link rel="icon" type="image/png" href="images/relicon.png">
</head> 
</html>
<?php
if (isset($_GET['ref'])){
    $user = $_GET['ref'];	
	header('Location: https://www.earntronwall.com/register.php?ref='.$user.''); //Redirecting invited users to registration form
} else {
	header('Location: https://www.earntronwall.com/dashboard.php');	//Redirecting existing users to dashboard/login
}
?>
