<?php

session_start();


// initializing variables

$ip = "";

$username = "";

$wallet    = "";

$errors = array(); 

// connect to the database

$db = mysqli_connect('', '', '', '');

// REGISTER USER

if (isset($_POST['reg_user'])) {

  // receive all input values from the form

  $username = mysqli_real_escape_string($db, $_POST['username']);

  $wallet = mysqli_real_escape_string($db, $_POST['wallet']);

  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);

  $ref = mysqli_real_escape_string($db, $_POST['ref']);

  // form validation: ensure that the form is correctly filled ...

  // by adding (array_push()) corresponding error unto $errors array

  if (empty($username)) { array_push($errors, "Username is required"); }

  if (empty($wallet)) { array_push($errors, "wallet is required"); }

  if (empty($password_1)) { array_push($errors, "Password is required"); }


  // first check the database to make sure 

  // a user does not already exist with the same username and/or wallet

  $user_check_query = "SELECT * FROM users WHERE username='$username' OR wallet='$wallet' LIMIT 1";

  $result = mysqli_query($db, $user_check_query);

  $user = mysqli_fetch_assoc($result);
 

  if ($user) { // if user exists

    if ($user['username'] === $username) {

      array_push($errors, "Username already exists");

    }

    if ($user['wallet'] === $wallet) {

      array_push($errors, "wallet already exists");

    }

  }


  // Finally, register user if there are no errors in the form

  if (count($errors) == 0) {

  	$password = md5($password_1);//encrypt the password before saving in the database


if (empty($ref)) {


  	$query = "INSERT INTO users (offerids, offers, refearned, username, wallet, password, ref, points, ip) 

  			  VALUES('List IDs\n', '0', '0', '$username', '$wallet', '$password', 'ADMIN', '0', '".$_SERVER['REMOTE_ADDR']."')";

  	mysqli_query($db, $query);

	
} else { 


  	$query = "INSERT INTO users (offerids, offers, refearned, username, wallet, password, ref, points, ip) 

  			  VALUES('List IDs\n', '0', '0', '$username', '$wallet', '$password', '$ref', '0', '".$_SERVER['REMOTE_ADDR']."')";

  	mysqli_query($db, $query);

}	


  	header('location: login.php');

  }

}


// LOGIN USER

if (isset($_POST['login_user'])) {

  $username = mysqli_real_escape_string($db, $_POST['username']);

  $password = mysqli_real_escape_string($db, $_POST['password']);



  if (empty($username)) {

  	array_push($errors, "Username is required");

  }

  if (empty($password)) {

  	array_push($errors, "Password is required");

  }


  if (count($errors) == 0) {

  	$password = md5($password);

  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";

  	$results = mysqli_query($db, $query);

  	if (mysqli_num_rows($results) == 1) {
	

  	  $_SESSION['username'] = $username;

  	  $_SESSION['success'] = "You are now logged in";

  	  header('location: dashboard.php');

  	}else {

  		array_push($errors, "Wrong username or password");

  	}

  }

}


?>