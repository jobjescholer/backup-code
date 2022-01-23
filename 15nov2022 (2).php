<?php
ob_start();
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>15 nov 2022</title>
</head>
<body>
<!--
<h1> Vul hier uw nieuwe snack in </h1>

<form method="post" action="">

Naam snack: <input type="text" name="Naam" /><br />
Omschrijving: <input type="text" name="Omschrijving" /><br />
Prijs: <input type="text" name="Prijs" /><br />

<input type="submit" name="Send" value="Toevoegen!" /><br />
</form>
-->

<?php


try
	{
		$pdo = new PDO("mysql:host=localhost;dbname=fastfood;","root","");
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}


$parameters = array();
$sth = $pdo->prepare('select * from snacks');

$sth->execute($parameters);

?>
<table border="0">
	<tr>
		<th>Naam:</th>
		<th>Omschrijving</th>
		<th>Prijs</th>
		<th></th>
	</tr>
<?php

while($row = $sth->fetch())
{

	?>
	
	<tr>
		<td><?php echo $row["Naam"];?></td>
		<td><?php echo $row["Omschrijving"];?></td>
		<td><?= $row["Prijs"];?></td>
		<td><a href="updaten.php?ID=<?php echo $row["ID"]?>">Aanpassen</a></td>
	
	</tr>

	<?php
}

echo "</table>";

/*
//Controleren of de knop van het formulier is ingedrukt
if(isset($_POST["Send"]))
{
	
	$parameters = array(':Naam' => $_POST["Naam"],
						':Omschrijving' => $_POST["Omschrijving"],
						':Prijs' => $_POST["Prijs"]);

	$sth = $pdo->prepare('INSERT INTO snacks (Naam,Omschrijving,Prijs) VALUES (:Naam,:Omschrijving,:Prijs)');

	$sth->execute($parameters);

	if($pdo->lastInsertId() != 0)
	{
		echo" toevoegen geslaagd met nr.: ";
		echo $pdo->lastInsertId();
	}

}


*/






?>