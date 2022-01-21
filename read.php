<!DOCTYPE html>
<html>
<head>
	<title>Read</title>
</head>
<body>

<html>
<a href="homepagina.php">Homepagina</a></br>
<html>

</body>
</html>


<?php
include("connectie.php");
$query = $db->prepare("SELECT * FROM Snacks");
$query->execute();

while ($row = $query->fetch()) {
  echo 'Naam: ' . $row['Naam'] . '</br>' . 'Beschrijving: ' . $row['Beschrijving'] . '</br>' . 'Prijs: ' . $row['Prijs'] . '</br>' . '</br>' . '</br>';
}
?>
