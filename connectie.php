<?php
try {
  $db = new PDO("mysql:host=localhost;dbname=cyclo" , "root", "");

} catch(PDOException $e)  {
  die("Error!: " . $e->getMessage());
}
?>
