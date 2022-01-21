<html>
<html>
<a href="homepagina.php">Homepagina</a></br>
<html>


<form>
  <label for="ID">ID:</label>
  <input type="text" id="ID" name="ID"><br>
  <label for="Naam">Naam:</label>
  <input type="text" id="Naam" name="Naam"><br>
  <label for="Beschrijving">Beschrijving:</label>
  <input type="text" id="Beschrijving" name="Beschrijving"><br>
  <label for="Prijs">Prijs:</label>
  <input type="Interger" id="Prijs" name="Prijs"><br>
  <input type="submit" value="Submit">
</form>
<html>

<?php
include("connectie.php");
$query = $db->prepare("SELECT * FROM Snacks");
$query->execute();

while ($row = $query->fetch()) {
  echo $row['ID'] . " " . $row['Naam'] . '</br>';
}

  include("connectie.php");
  if (ISSET($_REQUEST['Naam'],$_REQUEST['Beschrijving'],$_REQUEST['Prijs'])) {
    $parameters = array(':ID'=>$_REQUEST['ID'],
                      ':Naam'=>$_REQUEST['Naam'],
                      ':Beschrijving'=>$_REQUEST['Beschrijving'],
                      ':Prijs'=>$_REQUEST['Prijs']);
  
  $query = $db->prepare('UPDATE snacks SET Naam = :Naam, Beschrijving = :Beschrijving, Prijs = :Prijs WHERE snacks.ID = :ID;');
  $query->execute($parameters);
  }

?>



