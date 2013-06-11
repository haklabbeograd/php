<?

require_once( "include/db.php" );


$date = strtotime( $_GET['date'] );
if( $date == 0 ) {
	die( "Unknown date" );
}
$day = date( "j", $date );

$date_str = date( "Y-m-d", $date );
$query = "
select *
from events
where
		time_start	<	date( '$date_str' + interval 1 day )
	and	time_end	>=	date( '$date_str' )
";
$rs = mysql_query( $query );
$events = array();
while( $row = mysql_fetch_object( $rs ) ) {
	$events[] = $row;
}

?><table border="1">
<tr><th>Sat</th><th>Desavanje</th></tr>
<?
for(
	;
	date( "j", $date ) == $day;
	$date += 3600
	//$date = strtotime( date( "Y-m-d H:i:s", $date ) . " +1 hour" )
) {
	$date_str = date( "Y-m-d H:i:s", $date );
	$hourly_events = array();
	foreach( $events as $event ) {
		if(
			$date_str >=	$event->time_start &&
			$date_str <	$event->time_end
		) {
			$hourly_events[] = $event->description;
		}
	}
	?><tr>
		<td><?= date( "H", $date ) ?></td>
		<td><?= implode( ", ", $hourly_events ) ?>&nbsp;</td>
	</tr><?
}
?>
</table>
