<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>15 nov 2022</title>
</head>
<body>
<?php
$Message = NULL;


try
	{
		$pdo = new PDO("mysql:host=localhost;dbname=fastfood;","root","");
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}


//dit gebeurd alleen wanneer de knop van het formulier is ingedrukt
if(isset($_POST["Send"]))
{
	$parameters = array(':ID' => $_GET['ID'],
						':Naam' => $_POST['Naam'],
						':Omschrijving' => $_POST['Omschrijving'] ,
						':Prijs' => $_POST['Prijs']);

	$sth = $pdo->prepare('UPDATE snacks SET Naam=:Naam,Omschrijving=:Omschrijving,Prijs=:Prijs WHERE ID = :ID');

	$sth->execute($parameters);

	$Message = "Het is succesvol aangepast";
}

//dit gebeurd altijd
$parameters = array("ID" => $_GET["ID"]);
$sth = $pdo->prepare('select * from snacks WHERE ID=:ID');

$sth->execute($parameters);

$row = $sth->fetch();


?>

<h1> Pas de gegevens van de snack aan </h1>

<form method="post" action="">

Naam snack: <input type="text" name="Naam" value="<?php echo $row['Naam'];?>" /><br />
Omschrijving: <textarea name="Omschrijving" rows="5" cols="45"><?php echo $row['Omschrijving'];?></textarea><br />
Prijs: <input type="text" name="Prijs" value="<?php echo $row['Prijs']?>" /><br />

<input type="submit" name="Send" value="Aanpassen!" /><br />
</form>

<?php
echo $Message;
?>


	
