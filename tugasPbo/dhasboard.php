<?php
// Include the database connection file
require_once("dbConnection.php");
include 'layouts/header.php';
// Fetch data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM penduduk ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.css">
	<title>Dhasboard</title>
</head>

<body>
	<h2>Homepage</h2>
	<table class="table">
  <thead class="table-dark">

  </thead>
  <tbody>
  			<td><strong>Name</strong></td>
			<td><strong>Umur</strong></td>
			<td><strong>Asal Kota</strong></td>
			<td><strong>Action</strong></td>
		</tr>
		<?php
		// Fetch the next row of a result set as an associative array
		while ($res = mysqli_fetch_assoc($result)) {
			echo "<tr>";
			echo "<td>".$res['name']."</td>";
			echo "<td>".$res['umur']."</td>";
			echo "<td>".$res['asal_kota']."</td>";	
			echo "<td><a class='btn  btn-primary' href=\"edit.php?id=$res[id]\">Edit</a> 
			<a class='btn btn-danger'href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
		}
		?>
  </tbody>
</table>
</body>
</html>
