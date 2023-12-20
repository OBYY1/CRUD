<?php
// Include the database connection file
require_once("dbConnection.php");
if (isset($_POST['update'])) {
	// Escape special characters in a string for use in an SQL statement
	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$umur = mysqli_real_escape_string($mysqli, $_POST['umur']);
	$asal_kota = mysqli_real_escape_string($mysqli, $_POST['asal_kota']); // Update to match the correct form field name
	
	// Check for empty fields
	if (empty($name) || empty($umur) || empty($asal_kota)) {
		if (empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if (empty($umur)) {
			echo "<font color='red'>Umur field is empty.</font><br/>";
		}
		
		if (empty($asal_kota)) {
			echo "<font color='red'>Asal kota field is empty.</font><br/>";
		}
	} else {
		// Update the database table
		$result = mysqli_query($mysqli, "UPDATE penduduk SET `name` = '$name', `umur` = '$umur', `asal_kota` = '$asal_kota' WHERE `id` = $id");

		
		// Display success message
		echo "<p><font color='green'>Data updated successfully!</p>";
		echo "<a href='dhasboard.php'>Kembali ke dhasboard</a>";
	}
}
?>
