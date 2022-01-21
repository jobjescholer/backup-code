<!DOCTYPE html>
<html>
<head>
	<title>Delete</title>
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
  echo 'ID: ' . $row['ID'] . '</br>' . 'Naam: ' . $row['Naam'] . '</br>' . 'Beschrijving: ' . $row['Beschrijving'] . '</br>' . 'Prijs: ' . $row['Prijs'] . '</br>' . '</br>' . '</br>';
}
?>
Voer hier het ID in dat u wilt verwijderen.</br>
<label for="ID">ID:</label>
<input type="Interger" id="ID" name="ID"><br>
<input type="submit" value="Submit">
<?php
if (ISSET($_REQUEST["ID"])) {
  $parameters = array(':ID'=>$_REQUEST["ID"]);
  $query = $db->prepare('DELETE FROM snacks WHERE snacks.ID = :ID');
  $query->execute($parameters);
}

?>
