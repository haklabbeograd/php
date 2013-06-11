<?

require_once( "include/db.php" );
require_once( "include/user.php" );

$username = $_GET['username'];
$hash = $_GET['hash'];

if( !empty( $username ) && !empty( $hash ) ) {
	if( md5( $username . $salt ) === $hash ) {
		$query = "update users set status = 'ACTIVE' where username = '" . mysql_real_escape_string( $username ) . "' and status = 'NEW'";
echo $query;
		$res = mysql_query( $query );
		if( !$res || mysql_affected_rows() != 1 ) {
			echo "Update failed";
		}
	} else {
		echo "An error occured";
	}
}

