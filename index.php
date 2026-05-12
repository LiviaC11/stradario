<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Stradario Storico - Comune di Faenza</title>
    
    <!-- CSS di Bootstrap Italia -->
    <link rel="stylesheet" href="https://cdn.retecivica.lepida.it/nrc-ui/nrc-typography-fonts.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-italia@2.0.0/dist/css/bootstrap-italia.min.css">
    <link rel="stylesheet" href="https://cdn.retecivica.lepida.it/nrc-ui/nrc-core-icons.css">
    
</head>

<body class="theme--bsi-comuni">

    <!-- Header Responsivo -->
    <header class="header-custom shadow-sm">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 d-flex align-items-center">
                    <img src="https://cdn.retecivica.lepida.it/tenants/C_D458/favicon/favicon-32x32.png" alt="Logo Faenza" class="me-2" style="width:24px; height:24px;">
                    <div class="brand-title">Comune di Faenza</div>
                </div>
            </div>
        </div>
    </header>

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Su mobile occupa 12 colonne, su tablet 10, su desktop 8 -->
                <div class="col-12 col-md-10 col-lg-8">
                    
                    <!-- Titolo Sezione -->
                    <div class="mb-4 px-2">
                        <h1 class="h4 text-primary d-flex align-items-center">
                            <span class="icon it-search me-2"></span>
                            Nuovo Stradario
                        </h1>
                        <p class="text-muted small">Approvazione nuovo stradario dell'archivio 
                            nazionale dei numeri civici e delle strade urbane (ANNCSU), 
                            standarizzato secondo le regole fornite dall'instat.
                        </p>
                    </div>

                    <!-- Card Form Ricerca -->
                    <div class="card card-custom p-3 p-md-4">
                        <form action="#" method="GET">
                            <div class="form-group position-relative">
                                <label for="nome_strada" class="active">Cerca vecchia denominazione</label>
                                <input type="text" class="form-control" id="nome_strada" name="via" placeholder="es: Via di Porta Imolese" autocomplete="off">
    
                                <ul id="lista-suggerimenti" class="list-group position-absolute w-100 shadow" style="z-index: 1000; display: none;">
                                </ul>
                            </div>
                            <div class="mt-4">
                                <button type="button" class="btn btn-primary btn-lg w-100 w-md-auto">Cerca</button>
                            </div>
                        </form>
                    </div>

                    <!-- Card Risultati Mobile-First -->
                    <div id="sezione-risultati" class="card card-custom p-3 p-md-4" style="display: none;">
    <!--<h2 class="h6 mb-4 text-uppercase fw-bold text-secondary">Dettaglio Corrispondenza</h2> -->
    
    <div class="info-box">
        <span class="label-storica">Denominazione attuale</span>
        <div id="res-nuova" class="denominazione-testo text-primary fw-bold">-</div>
    </div>
    <hr class="my-4">
    </div>

                        <!-- Area Azioni (Stampa) -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end align-items-center">
                            <span class="text-muted small me-md-3 mb-2 mb-md-0 text-center text-md-start">
                                <i class="icon it-info-circle"></i> Documento valido per fini amministrativi
                            </span>
                            <button class="btn btn-outline-primary btn-sm">
                                <span class="icon it-print me-2"></span>
                                Stampa Attestazione PDF
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <!-- JS di Bootstrap Italia (necessario per alcuni componenti interattivi) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-italia@2.0.0/dist/js/bootstrap-italia.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-italia@2.0.0/dist/js/bootstrap-italia.bundle.min.js"></script>
    <script src="js/autocomplete.js"></script>
</body>
</html>