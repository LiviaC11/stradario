<?php 
require_once 'db_config.php';

if(isset($_GET['via'])){
    $via = $connection->real_escape_string($_GET['via']);
    
    // Cerchiamo la riga che corrisponde alla vecchia denominazione unita al DUG
    $sql = "SELECT nuova_denominazione FROM stradario 
            WHERE CONCAT(dug, ' ', vecchia_denominazione) = '$via' 
            OR vecchia_denominazione = '$via' 
            LIMIT 1";
            
    $result = $connection->query($sql);

    if($row = $result->fetch_assoc()){
        header('Content-Type: application/json');
        echo json_encode($row);
    } else {
        http_response_code(404);
        echo json_encode(["errore" => "Via non trovata"]);
    }
    exit;
}
?>