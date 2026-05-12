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