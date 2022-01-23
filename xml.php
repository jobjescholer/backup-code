<?php

//db connectie
try
{
	$pdo = new PDO("mysql:host=localhost;dbname=fastfood;","root","");
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

/*----------------------------------------------------
				FILE UPLOAD
----------------------------------------------------*/
if (isset($_POST['Send'])) 
{	
	
	$currentDirectory = getcwd();
    $uploadDirectory = "/";

    $fileName = $_FILES['fileToUpload']['name'];
    $fileTmpName  = $_FILES['fileToUpload']['tmp_name'];

    $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 

	move_uploaded_file($fileTmpName, $uploadPath);

/*----------------------------------------------------
				END FILE UPLOAD
----------------------------------------------------*/

/*----------------------------------------------------
		  XML Inlezen en in DB verwerken
----------------------------------------------------*/
	
	//XML file openen
	$xml = simplexml_load_file($fileName) or die("Error: Cannot create object");

	//loop door alle elementen heen
	foreach($xml->children() as $Snack)
	{
		//per element een insert doen
		$parameters = array(':Naam' => $Snack->Naam,
							':Omschrijving' => $Snack->Omschrijving,
							':Prijs' => $Snack->Prijs);

		$sth = $pdo->prepare('INSERT INTO snacks (Naam,Omschrijving,prijs) VALUES (:Naam,:Omschrijving,:Prijs)');

		$sth->execute($parameters);
	}
}
/*----------------------------------------------------
		END OFXML Inlezen en in DB verwerken
----------------------------------------------------*/


?>


<form action="" method="post" enctype="multipart/form-data">
  Select file to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload XML" name="Send">
</form>
