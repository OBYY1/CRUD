<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add data</title>
</head>
<body>
<?php
// Include the database connection file
require_once("dbConnection.php");

if (isset($_POST['submit'])) {
	// Escape special characters in string for use in SQL statement	
	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$umur = mysqli_real_escape_string($mysqli, $_POST['umur']);
	$asal_kota = mysqli_real_escape_string($mysqli, $_POST['asal_kota']);
		
	// Check for empty fields
	if (empty($name) || empty($umur) || empty($asal_kota)) {
		if (empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if (empty($umur)) {
			echo "<font color='red'>Umur field is empty.</font><br/>";
		}
		
		if (empty($asal_kota)) {
			echo "<font color='red'>Asal Kota field is empty.</font><br/>";
		}
		
		// Show link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// If all the fields are filled (not empty) 

		// Insert data into database
		$result = mysqli_query($mysqli, "INSERT INTO penduduk (`name`, `umur`, `asal_kota`) VALUES ('$name', '$umur', '$asal_kota')");
		
		// Display success message
		echo "<p><font color='green'>Data added successfully!</p>";

		// Redirect to dhasboard.php after a short delay (e.g., 2 seconds)
		echo "<script>
        		setTimeout(function() {
           		window.location.href = 'dhasboard.php';
       			}, 2000); // 2000 milliseconds = 2 seconds
      		 </script>";

	}
}
?>
</body>
</html>
