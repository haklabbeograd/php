<?php
	require_once("include/user.php");
	require_once("include/db.php");
	//izdvojiti u poseban fajl zbog duplikacije
	if( !$user ) {
		echo "You must be logged in to add event.";
		die();
	}


	$description = isset($_POST['description'])? trim($_POST['description']) : "";

	if(empty($description) && isset($_POST['submit'])){
		 echo "<span style='color: red;'>Fill data correctly</span>";
	 }
	elseif (isset($_POST['submit'])){
	 		$datefrom = date('Y-m-d H:i',strtotime($_POST['datefromday']."-".$_POST['datefrommonth']."-".$_POST['datefromyear']." ".$_POST['datefromhour'].":".$_POST['datefromminute']));
	 		$dateto = date('Y-m-d H:i',strtotime($_POST['datetoday']."-".$_POST['datetomonth']."-".$_POST['datetoyear']." ".$_POST['datetohour'].":".$_POST['datetominute']));

	 		$query = "INSERT INTO events(time_start,time_end,description) VALUES('$datefrom','$dateto','$description')";
	 		echo $query;

	 		mysql_query($query);
	 		header("location: day.php?date=".date('Y-m-d',strtotime($datefrom)));
	 	}	

?>

<form method="post">
	Date from: <select name="datefromday"><?php for($i=1;$i<=31;$i++) echo "<option>".sprintf("%02d",$i)."</option>"?></select>
			   <select name="datefrommonth"><?php for($i=1;$i<=12;$i++) echo "<option>".sprintf("%02d",$i)."</option>"?></select>
			   <select name="datefromyear"><?php for($i=2013;$i<=2050;$i++) echo "<option>".$i."</option>"?></select>
	Time: <select name="datefromhour"><?php for($i=0;$i<=23;$i++) echo "<option>".sprintf("%02d",$i)."</option>"?></select>
	:&nbsp;<select name="datefromminute"><?php for($i=0;$i<=59;$i++) echo "<option>".sprintf("%02d",$i)."</option>"?></select><br>
	Date to: <select name="datetoday"><?php for($i=1;$i<=31;$i++) echo "<option>".sprintf("%02d",$i)."</option>"?></select>
			   <select name="datetomonth"><?php for($i=1;$i<=12;$i++) echo "<option>".sprintf("%02d",$i)."</option>"?></select>
			   <select name="datetoyear"><?php for($i=2013;$i<=2050;$i++) echo "<option>".$i."</option>"?></select>
	Time: <select name="datetohour"><?php for($i=0;$i<=23;$i++) echo "<option>".sprintf("%02d",$i)."</option>"?></select>
	:&nbsp;<select name="datetominute"><?php for($i=0;$i<=59;$i++) echo "<option>".sprintf("%02d",$i)."</option>"?></select><br>
	Description: <textarea name="description" style="height: 350px; width: 500px;"></textarea><br>
	<input type="submit" name="submit" value="Add Event"/>
</form>