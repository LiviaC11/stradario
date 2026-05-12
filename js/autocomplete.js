document.addEventListener('DOMContentLoaded', function() {
    //dove scrive l'utente
    const inputStrada = document.getElementById('nome_strada');
    //dove compaiono i suggerimenti
    const listaSuggerimenti = document.getElementById('lista-suggerimenti');

    if (!inputStrada || !listaSuggerimenti) return;
//Ogni volta che l'utente preme un tasto, cancella una lettera o incolla del testo, si attiva questa funzione.
    inputStrada.addEventListener('input', function() {
        const query = this.value;

        if (query.length >= 2) {
            
            //encodeURIComponent è sempre per evitare sql injection
            fetch('php/get_suggerimenti.php?term=' + encodeURIComponent(query))
                .then(response => response.json())
                .then(data => {
                    listaSuggerimenti.innerHTML = '';
                    
                    if (data.length > 0) {
                        listaSuggerimenti.style.display = 'block';
                        
                        data.forEach(strada => {
                            const li = document.createElement('li');
                            li.className = 'list-group-item list-group-item-action';
                            li.style.cursor = 'pointer';
                            li.textContent = strada;
                            
                            li.addEventListener('click', function() {
                                inputStrada.value = strada;
                                listaSuggerimenti.style.display = 'none';
                            });
                            
                            listaSuggerimenti.appendChild(li);
                        });
                    } else {
                        listaSuggerimenti.style.display = 'none';
                    }
                })
                .catch(error => console.error('Errore nel recupero suggerimenti:', error));
        } else {
            listaSuggerimenti.style.display = 'none';
        }
    });

    // Chiudi la lista se l'utente clicca altrove
    document.addEventListener('click', function(e) {
        if (e.target !== inputStrada) {
            listaSuggerimenti.style.display = 'none';
        }
    });

});


const btnCerca = document.querySelector('.btn-primary.btn-lg');
const sezioneRisultati = document.getElementById('sezione-risultati');
const resNuova = document.getElementById('res-nuova');

btnCerca.addEventListener('click', function() {
    const viaSelezionata = document.getElementById('nome_strada').value;

    if (viaSelezionata.length >= 2) {
        fetch('php/get_nuova_denominazione.php?via=' + encodeURIComponent(viaSelezionata))
            .then(response => response.json())
            // ... dentro la fetch di get_nuova_denominazione.php ...
.then(data => {
    if (data.nuova_denominazione) {
        resNuova.textContent = data.nuova_denominazione;
        sezioneRisultati.style.display = 'block';
        sezioneRisultati.scrollIntoView({ behavior: 'smooth' });

        // MODIFICA 1: Usiamo l'ID che hai messo nell'HTML
        const btnStampa = document.getElementById('btn-stampa');
        
        if (btnStampa) {
            btnStampa.onclick = function() {
        const vecchiaVia = document.getElementById('nome_strada').value;
        const nuovaVia = data.nuova_denominazione;

        // Passiamo entrambi i parametri nell'URL
        const url = 'php/genera_pdf.php?' + 
                    'vecchia=' + encodeURIComponent(vecchiaVia) + 
                    '&nuova=' + encodeURIComponent(nuovaVia);
        
        window.open(url, '_blank');
    };
        }
    }
})
            .catch(error => {
                console.error('Errore:', error);
                alert("Nessun dettaglio trovato per la via selezionata.");
            });
    } else {
        alert("Per favore, seleziona una via dai suggerimenti.");
    }
});