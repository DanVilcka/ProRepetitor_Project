<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("localhost", "demo", "DemoUs#01", "Users");

$result = $mysqli->query("SELECT id, name FROM users");
$row = $result->fetch_assoc();

foreach ($result as $row) {
	echo " id = " . $row['id'] . "<br>";
	printf("id = %s (%s)<br>", $row['id'], gettype($row['id']));
	printf("name = %s (%s)<br>", $row['name'], gettype($row['name']));
}
?>
