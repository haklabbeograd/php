<?php
require_once('include/user.php');
if($user)
{
	echo "You are logged in, no need for registration";
	//TODO redirekcija na homepage
	die();
} 
$username = isset($_POST['username'])? trim($_POST['username']) : "" ;
$password = isset($_POST['password'])? trim($_POST['password']) : "";
$password2 = isset($_POST['password2'])? trim($_POST['password2']): "";
$email = isset($_POST['email'])? trim($_POST['email']):"";
$realname = isset($_POST['realname'])? $_POST['realname']: "";

if(empty($username) || empty($password) || empty($password2) || empty($email))
{
	if(isset($_POST['submit'])) 
		echo "<span style='display: block; color: red;'>Please fill form correctly</span>";
}
else
{
	require_once('include/db.php');

	$query = "select * from users where username='".mysql_real_escape_string($username)."' or email='".mysql_real_escape_string($email)."'";	
	$rs = mysql_query( $query);
	$user = mysql_fetch_object( $rs );
	if( $user ) {
		echo "<span style='display: block; color: red;'>User already exist</span>";
	} else if($password!= $password2) {
		echo "<span style='display: block; color: red;'>Password missmatch</span>";
	} else {
		$query = "insert into users (username,realname,email,password,status) values 							('$username','$realname','$email',md5('$password$salt'),'NEW')";
		mysql_query( $query );
		echo $query."<br>";
		mail( $email, "Haklab calendar registration confirmation", "To confirm your registration, click on http://" . $_SERVER['HTTP_HOST'] . "/calendar/verify.php?username=" . urlencode( $username ) . "&hash=" . md5( $username . $salt ) );
		echo "Check your inbox";
		/*
		if(mysql_query( $query ))
		{
			$user = login_user( $username, $password );
			if( $user ) {
				$_SESSION['user'] = $user;
				header("location: login.php");
			} else {
				echo "<span style='display: block; color: red;'>Can't load user</span>";
			}
		}
		*/
	}
	
	
}		
?>

<form method="post">
  Username*: <input name="username" type="text" /><br>
  Password*: <input name="password" type="password"/><br>
  Repeat password*: <input name="password2" type="password"/><br>
  Email*: <input name="email" type="text"/><br>
  Real name: <input name="realname" type="text"/><br>
  <input type="submit" name="submit" value="register"/>
</form>
<span>* required</span>
