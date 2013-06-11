<?
require_once( "include/user.php" );

if( $user ) {
	echo "You are already logged in.";
	die();
}

//$username = isset( $_POST['username'] )? trim ( $_POST['username'] ): "";
if( isset( $_POST['username'] ) ) {
	$username = trim( $_POST['username'] );
} else {
	$username = "";
}
$password = isset( $_POST['password'] )? trim( $_POST['password'] ): "";

if( !empty( $username ) && !empty( $password ) ) {
	require_once( "include/db.php" );
	$user = login_user( $username, $password );
	if( $user ) {
		echo "logging in";
		$_SESSION['user'] = $user;
		die();
	}
}
?>
<form method="post">
Username: <input type="text" name="username" value="<?= htmlspecialchars( $username ) ?>"><br>
Password: <input type="password" name="password"><br>
<input type="submit">
</form>
