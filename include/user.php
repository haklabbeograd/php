<?

session_start();
if( isset( $_SESSION['user'] ) ) {
	$user = $_SESSION['user'];
	echo "User: " . $user->username . "<br>";
} else {
	$user = false;
}

$salt = "dklswerocvn";

function login_user( $username, $password ) {
	global $salt;

	$query = "select * from users where username = '" . mysql_real_escape_string( $username ) . "' && password = '" . md5( $password . $salt ) . "' and status = 'ACTIVE'";
	//$query = "select * from users where username = '" . mysql_real_escape_string( $username ) . "' && password = md5('" . mysql_real_escape_string( $password . $salt ) . "')";
	echo $query . "<br>";
	$rs = mysql_query( $query );
	$user = mysql_fetch_object( $rs );
var_dump( $user );
	return $user;
}

