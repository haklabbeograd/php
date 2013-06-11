<?

$days = array( 1 => "Pon", "Uto", "Sre", "Cet", "Pet", "Sub", "Ned" );

?>
<table border="1">
<tr>
	<? for( $i = 1; $i <= 7; $i++ ) { ?>
	<th><?= $days[$i] ?></th>
	<? } ?>
</tr>
<?

$first = date( "Y-m-01" );
//echo "$first<br>";

$offset = date( "N", strtotime( $first ) ) - 1;
//echo "$offset<br>";

//echo "$first -$offset days"."<br>";

$date = strtotime( "$first -$offset days" );
//echo "$start<br>";

$curmonth = date( "n" );
do {
?><tr><?
	for( $i = 1; $i <= 7; $i++ ) {
		$nowmonth = date( "n", $date );
		?><td<? if( $curmonth == $nowmonth ) { ?> style="font-weight: bold;"<? } ?>><a href="day.php?date=<?= date( "Y-m-d", $date ) ?>"><?= date( "j", $date ) ?></a></td><?
		$date = strtotime( date( "Y-m-d", $date ) . " +1 day" );
	}
?></tr><?
} while( $curmonth >= date( "n", $date ) );
?>
</table>
