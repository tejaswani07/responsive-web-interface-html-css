<?php

session_start();

// initializing variables

$username = "";

$password = "";
$email = "";

$errors = array();

// connect to the database

$db = mysqli_connect('localhost', 'root','', 'project');

// REGISTER USER

if (isset($_POST['reg_user'])) {

// receive all input values from the form

$username = mysqli_real_escape_string($db, $_POST['username']):

$email = mysqli_real_escape_string ($db, $_POST['email']);

$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);

Spassword 2 = mysqli_real_escape_string($db, $_POST['password_2']);

// form validation: ensure that the form is correctly filled

/

/ by adding (array push()) corresponding error unto Serrors array

if (empty($username)) ( array_push($errors, "Username is required"); }

if (empty($email)) ( array_push($errors, "Email is required"); }

if (empty($password_1)) ( array_push($errors, "Password is required"); }

if ($password_1 !=  $password_2){
 array_push($errors, "The two passwords do not match");
}





 // first check the database to make sure


// a user does not already exist with the same username and/or email

$user_check_query = "SELECT * FROM project WHERE username='$username' OR password='$password' LIMIT 1";

$result = mysqli_query($db, $user_check_query);

$user = mysqli_fetch_assoc($result);
if ($user) { // if user exists
if ($user['username'] === $username) {

array_push($errors, "Username already exists");
}
if ($user['password')=== $password) {

array_push($errors, "password already exists");
}
}
// Finally, register user if there are no errors in the form

if (count($errors)==0) {

$password = md5($password_1);//encrypt the password before saving in the database

$query ="INSERT INTO users (username, password)
         VALUES('$username', '$password')";

mysqli_query($db, $query);

$_SESSION['username'] = $username;

$_SESSION['success']="You are now logged in";

header ('location: csp login.html');
}
else{
array_push($errors, "wrong username/password combination");
}
}
}
?>



















