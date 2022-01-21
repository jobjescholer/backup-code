<?php
ob_start();
session_start();

$Message = NULL;

try
	{
		$pdo = new PDO("mysql:host=localhost;dbname=fastfood;","root","");
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}

if(isset($_POST["Send"]))
{
	$parameters = array(":Email" => $_POST["Email"]);
	$sth = $pdo->prepare('SELECT * FROM gegevens WHERE Email = :Email');

	$sth->execute($parameters);	
		
		
	// controleren of de username voorkomt in de DB
	if ($sth->rowCount() == 1) 
	{
		// Variabelen inlezen uit query
		$row = $sth->fetch();

					
			
			// paswoord hashen met de unieke Salt uit de DB
			$password = hash('sha512', $_POST['Password'] . $row['Salt']);

			// controleren of het paswoord overeenkomt met het paswoord uit de DB
			if ($row['Wachtwoord'] == $password) 
			{
				// vraagt de user agent op (later nodig)
				$user_browser = $_SERVER['HTTP_USER_AGENT'];

				/*
				Opdracht PM07 STAP 6: Inlogsysteem
				Omschrijving: Vul tot slot de sessie met de juiste gegevens
				*/
				$_SESSION['user_id'] = $row['ID'];
				$_SESSION['email'] = $row['Email'];
				$_SESSION['level'] = $row['Level'];
				$_SESSION['login_string'] = hash('sha512',
						  $password . $user_browser);
				
				// Login successful.
				$Message = "u bent ingelogd";
			 } 
			 else 
			 {
				// password incorrect
				$Message = "het paswoord is incorrect";
			 }
		}
		else
		{
			// username bestaat niet
			$Message ="De gebruikersnaam is niet gevonden";
		}
}
?>
<h1>Inloggen</h1>
	<?php echo '<br />'.$Message.'<br />';?>
	<form name="InlogFormulier" action="" method="post">
		<label for="Email">Inlognaam:</label>
		<input type="text" id="Email" name="Email" />
		<br />
		<label for="Password">Wachtwoord:</label>
		<input type="password" id="Password" name="Password" />
		<br />		
		<input type="submit" name="Send" value="Log in!" />
	</form>
	<br />

