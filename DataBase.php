<?php
function db_connect($dbservername,$dbusername,$dbpassword,$dbname)
{
	$conn = mysql_connect($dbservername,$dbusername,$dbpassword);
	if(!$conn)
		die("Connection failed");
	if(!mysql_select_db($dbname))
		die("Selection of the database error");
	return $conn;
}
function db_query($sql)
{
	$result = mysql_query($sql);
	if(!$result)
		die("Query Failed : ".$sql);
	return $result;
}
function db_fetch_assoc($query)
{
	return mysql_fetch_assoc($query);
}
function db_num_rows($query)
{
	return mysql_num_rows($query);
}

?>