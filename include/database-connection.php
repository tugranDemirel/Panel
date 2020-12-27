<?php 
   try {
    $conn = new PDO('mysql:host=localhost;dbname=blogadministration', 'root','');

} catch (PDOException $e) {
    print "Hata!: " . $e->getMessage() . "<br/>";
    die();
}
?>