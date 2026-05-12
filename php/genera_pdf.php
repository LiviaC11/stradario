<?php
require_once 'db_config.php';
// Percorso verso l'autoloader di dompdf
require_once '../libs/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

if(isset($_GET['via'])){
    $via = $connection->real_escape_string($_GET['via']);
    
    // Recuperiamo i dati dal DB per il PDF
    $sql = "SELECT * FROM stradario WHERE nuova_denominazione = '$via' LIMIT 1";
    $result = $connection->query($sql);
    $data = $result->fetch_assoc();

    if($data){
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);

        // Qui inserisci il tuo template HTML
        $html = '
        <html>
        <head>
            
        </head>
        <body>
            <header>
                <h1>Comune di Faenza</h1>
                <h3>Attestazione di Corrispondenza Toponomastica</h3>
            </header>
            <div class="content">
                <p>Si attesta che la denominazione storica:</p>
                <h2>' . $data['dug'] . ' ' . $data['vecchia_denominazione'] . '</h2>
                <p>corrisponde attualmente a:</p>
                <h2 style="color: #0066cc;">' . $data['nuova_denominazione'] . '</h2>
                <p style="margin-top:100px;">Data: ' . date('d/m/Y') . '</p>
            </div>
        </body>
        </html>';

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        // Invia il PDF al browser
        $dompdf->stream("Attestazione_" . $data['nuova_denominazione'] . ".pdf", array("Attachment" => false));
    }
}
?>