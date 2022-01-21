<html>

<html>
<a href="homepagina.php">Homepagina</a></br>
<html>

<form action="insert.php" method="get">
  <label for="Naam">Naam:</label>
  <input type="text" id="naam" name="naam"><br>
  <label for="materiaal">materiaal:</label>
  <input type="text" id="materiaal" name="materiaal"><br>
  <label for="hoeveelheid">hoeveelheid:</label>
  <input type="number" id="hoeveelheid" name="hoeveelheid"><br>
  <label for="datum">datum:</label>
  <input type="date" id="datum" name="datum"><br>
  <input type="submit" value="Submit">
</form>
<html>


<?php

  include("connectie.php");
  if (ISSET($_REQUEST['naam'], $_REQUEST['medewerker'], $_REQUEST['hoeveelheid'], $_REQUEST['datum'])) {
  $parameters = array(':naam'=>$_REQUEST['naam'],
                      ':materiaal'=>$_REQUEST['materiaal'],
                      ':hoeveelheid'=>$_REQUEST['hoeveelheid'],
                      ':datum'=>$_REQUEST['datum']);

  $query = $db->prepare('INSERT INTO apparaat (id, naam, materiaal, hoeveelheid, datum) VALUES (NULL, :naam, :materiaal, :hoeveelheid, :datum)');
  $query->execute($parameters);
}

?>


