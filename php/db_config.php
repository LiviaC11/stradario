
<?php 
//stabilisce la connessione al database
//dati per connessione 
$server="localhost";
$user="root";
$pw="";
$db="comune_test";

$connection = new mysqli($server, $user, $pw, $db);
if($connection -> connect_error){
    die("Connessione fallita: " . $connection->connect_error);
}
$connection->set_charset("utf8");
?>
