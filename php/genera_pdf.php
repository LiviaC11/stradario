<?php
require_once 'db_config.php';
require_once '../libr/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;
$realePathImg = 'C:\xampp\htdocs\progetto_vie\img\stemma_faenza_colore.png';

if (file_exists($realePathImg)) {
    $dataImg = file_get_contents($realePathImg);
    $base64 = 'data:image/png;base64,' . base64_encode($dataImg);
} else {
    $base64 = ''; // Se il file non esiste, evita errori fatali
}

if(isset($_GET['vecchia']) && isset($_GET['nuova'])){
    $vecchia = $connection->real_escape_string($_GET['vecchia']);
    $nuova = $connection->real_escape_string($_GET['nuova']);
    
    // Cerchiamo i dati completi (come il DUG) usando la vecchia denominazione
    $sql = "SELECT * FROM stradario WHERE 
            CONCAT(dug, ' ', vecchia_denominazione) = '$vecchia' 
            OR vecchia_denominazione = '$vecchia' 
            LIMIT 1";
            
    $result = $connection->query($sql);
    $data = $result->fetch_assoc();

    if($data){
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true); // Importante per caricare lo stemma/immagini
        $dompdf = new Dompdf($options);

        // Inizio del Template HTML
        $html = '
        <!DOCTYPE html>
        <html lang="it">
        <head>
            <meta charset="UTF-8">
            <style>
                @page { margin: 1.5cm; }
                body { font-family: sans-serif; font-size: 11pt; line-height: 1.4; color: #000; }
                
                header { width: 100%; margin-bottom: 20px; }
                #stemma { float: left; width: 120px; height: auto; }
                #titolo { float: left; width: 75%; text-align: center; }
                #titolo h1 { margin: 0; font-size: 18pt; }
                #titolo h3 { margin-top: 15px; font-size: 9pt; font-weight: normal; }
                
                .clearfix { clear: both; }

                #luogo_data { margin-top: 20px; margin-bottom: 20px; }

                article { text-align: justify; width: 100%; }
                article h2 { text-align: center; margin: 30px 0 5px 0; font-size: 14pt; }
                
                .attestazione-testo {
                    text-align: center;
                    font-size: 13pt;
                    font-weight: bold;
                    width: 100%;       
                    margin: 0 0 40px 0;   
                    
                }

                .attestazione-testo p {
                    margin: 0;         
                    padding: 0;
                    width: 100%;       
                    line-height: 1.8;
                }
                .testo-normale {
    font-weight: normal;
    font-size: 11pt; /* Opzionale: puoi renderlo leggermente più piccolo se preferisci */
}  

                #container-firma { margin-top: 50px; }
                #firma { float: right; width: 300px; text-align: center; font-size: 10pt; }

                footer { 
                    clear: both; 
                    padding-top: 80px; 
                    font-size: 9pt; 
                    color: #444; 
                }
            </style>
        </head>
        <body>
            <header>
                <img src="' . $base64 . '" alt="stemma faenza" id="stemma">
                <div id="titolo">
                    <h1>COMUNE DI FAENZA</h1>
                    <h3>Area Servizi alla Cittadinanza e alla Persona<br>
                    Servizio Sportello per i Cittadini e Servizi delegati dallo Stato<br>
                    U.O. Sportello Polifunzionale</h3>
                </div>
                <div class="clearfix"></div>
            </header>

            <div id="luogo_data">
                Faenza, ' . date('d/m/Y') . '
            </div>

            <article>
                <h2>IL DIRIGENTE</h2>
                <p>Visto l’articolo 3, comma 1 e 2 del D.L. 18/10/2012, n. 179, convertito con modificazioni dalla legge 17/12/2012, n. 221, che prevede la transizione ad un censimento permanente della popolazione e delle abitazioni e l’istituzione dell’Archivio Nazionale dei Numero Civici e delle Strade Urbane (ANNCSU), realizzato ed aggiornato dall’ISTAT e dall’Agenzia delle Entrate;</p>
                <p>Vista la circolare ISTAT, prot. n. 912/2014/P del 15 gennaio 2014 e successivi aggiornamenti ed integrazioni, con la quale veniva richiesto a tutti i Comuni di verificare i disallineamenti riscontrati sui toponimi e numeri civici messi a disposizione sul “Portale” dell’Agenzia delle Entrate, allo scopo di standardizzarli rispetto alle nuove regole comunicate;</p>
                <p>Vista la deliberazione di Giunta Comunale n. 81/2023 del 28/02/2023 con la quale si è provveduto ad approvare il nuovo stradario del Comune di Faenza, standardizzato secondo le regole fornite dall’ISTAT ai fini della costituzione dell’ANNCSU (Archivio Nazionale dei Numeri Civici e delle Strade Urbane);</p>
                <p>Rilevato che per effetto dell’approvazione dello stradario standardizzato secondo le regole fornite dall’ISTAT è stata determinata la variazione di diversi toponimi del Comune di Faenza;</p>
                <p>Tenuto conto delle indicazioni fornite dall’ISTAT in merito alle casistiche per le quali non si ritiene obbligatorio avviare procedure di rettifica di indirizzo, secondo cui: “… se la variazione di toponimo non induce a ambiguità all’interno del Comune … non è necessaria la rettifica di indirizzo”;</p>

                <h2>ATTESTA CHE</h2>
                
                   <p class="attestazione-testo"> ' . $data['dug'] . ' ' . $data['vecchia_denominazione'] . ' 
                    <span class="testo-normale">è ridenominata/o in</span>
                    ' . $data['nuova_denominazione'] . '</p>
            </article>

            <div id="container-firma">
                <div id="firma">
                    <p>Il Dirigente del Servizio Sportello per i<br>
                    Cittadini e Servizi delegati dallo Stato<br>
                    (firma autografa omessa ai sensi<br>
                    dell’art. 3 del d.Lgs. 39/1993)</p>
                </div>
                <div class="clearfix"></div>
            </div>

            <footer>
                stampato il: ' . date('d/m/Y') . ' ore ' . date('H:i') . '
            </footer>
        </body>
        </html>';

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        // Attachment => false apre il PDF nel browser invece di scaricarlo subito
        $dompdf->stream("Attestazione_" . $data['nuova_denominazione'] . ".pdf", array("Attachment" => false));
    } else {
        echo "Errore: Dati della via non trovati.";
    }
}
?>