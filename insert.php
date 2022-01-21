<html>

<html>
<a href="homepagina.php">Homepagina</a></br>
<html>

<form action="insert.php" method="get">
  <label for="grondstof">grondstof:</label>
  <input type="text" id="grondstof" name="grondstof"><br>
  <label for="prijs">prijs:</label>
  <input type="number" id="prijs" name="prijs"><br>
  <input type="submit" value="Submit">
</form>
<html>


<?php

  include("connectie.php");
  if (ISSET($_REQUEST['grondstof'], $_REQUEST['prijs'])) {
  $parameters = array(':grondstof'=>$_REQUEST['grondstof'],
                      ':prijs'=>$_REQUEST['prijs']);

  $query = $db->prepare('INSERT INTO grondstof (id, grondstof, prijs) VALUES (NULL, :grondstof, :prijs)');
  $query->execute($parameters);
}

?>


