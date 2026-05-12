<?php
require_once 'db_config.php';

//se c'è una chiamata get, ovvero di recupero info dal db
if(isset($_GET['term'])){
    $term=$connection->real_escape_string($_GET['term']); //prevenzione SQL injection aggiunge / per rendere innocui gli '
    $sql_query = "SELECT DISTINCT dug, vecchia_denominazione 
                FROM stradario 
                WHERE vecchia_denominazione LIKE '%$term%' 
                OR CONCAT(dug, ' ', vecchia_denominazione) LIKE '$term%'
                LIMIT 5";
    $result=$connection->query($sql_query);
    $suggerimenti=[];

    //se in result ci sono delle occorrenze
    if($result){
        //row salva ad ogni ciclo una una riga in result fino alla fine e l'aggiunge nell'array suggerimenti
        while($row = $result->fetch_assoc()){
            $nome_completo = trim($row['dug'] . " " . $row['vecchia_denominazione']);
            $suggerimenti[] = $nome_completo;
        }
    }

    header('Content-Type: application/json');
    //l'array suggerimenti è convertito in un formato che anche Javascript capisce
    echo json_encode($suggerimenti); 
    exit;

}//else do nothing
?>