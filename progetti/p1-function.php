<?php
//funz(array) ke restit lalista degli stud

function listaStudenti(): array
{
    return [
        [
            "nome" => "Paolo",
            "cognome" => "Basile",
            "eta" => 26,
            "email" => "paolo.basile@gmail.com",
            "telefono" => "3287970383",
            "voti" => [28, 30, 27],
        ],
        [
            "nome" => "Francesca",
            "cognome" => "Rossi",
            "eta" => 22,
            "email" => "francesca.rossi@hotmail.com",
            "telefono" => "3331122334",
            "voti" => [26, 29, 30],
        ],
        [
            "nome" => "Luca",
            "cognome" => "Moretti",
            "eta" => 24,
            "email" => "luca.moretti@outlook.com",
            "telefono" => "3394455667",
            "voti" => [24, 25, 28],
        ],
        [
            "nome" => "Giulia",
            "cognome" => "Ferrari",
            "eta" => 21,
            "email" => "giulia.ferrari@yahoo.com",
            "telefono" => "3279988776",
            "voti" => [30, 30, 29],
        ],
        [
            "nome" => "Marco",
            "cognome" => "Ricci",
            "eta" => 27,
            "email" => "marco.ricci@gmail.com",
            "telefono" => "3345566778",
            "voti" => [22, 24, 26],
        ],
        [
            "nome" => "Anna",
            "cognome" => "Conti",
            "eta" => 23,
            "email" => "anna.conti@libero.it",
            "telefono" => "3312233445",
            "voti" => [27, 28, 29],
        ],
        [
            "nome" => "Matteo",
            "cognome" => "Lombardi",
            "eta" => 25,
            "email" => "matteo.lombardi@virgilio.it",
            "telefono" => "3386677889",
            "voti" => [25, 26, 27],
        ],
        [
            "nome" => "Sara",
            "cognome" => "Galli",
            "eta" => 20,
            "email" => "sara.galli@hotmail.com",
            "telefono" => "3293344556",
            "voti" => [29, 28, 30],
        ],
        [
            "nome" => "Davide",
            "cognome" => "Monti",
            "eta" => 28,
            "email" => "davide.monti@alice.it",
            "telefono" => "3327788990",
            "voti" => [23, 24, 22],
        ],
        [
            "nome" => "Elena",
            "cognome" => "Vitale",
            "eta" => 24,
            "email" => "elena.vitale@gmail.com",
            "telefono" => "3359900112",
            "voti" => [30, 29, 30],
        ]
    ];
};

/* funzione x media voti di uno studente 
    parametri: $voto -> array , contenente tt i voti

    : float  (restit numeri decimali)
*/

function mediaVoti(array $voto): float
{
    //array_sum() -> metodo della somma tt gli elem dell'array
    $somma = array_sum($voto);

    //count()  conta gli elem presenti nell'array
    //query -> select count(voti) from studenti
    $quantiVoti = count($voto);

    //restit la media
    return $somma / $quantiVoti;
}



/******************************** Fine backend ********************************************/



/********************************** Frontend **********************************************/


/* 

    Funzione che genera  card:

    Riceve 1 stud e genera 1 card in HTML

    Parametro: studente -> arra associativo ke contiene i dati dello stud
    
    : string -> restit una stringa HTML
*/



function cardStudente(array $studente): string
{
    //calcolo della media

    $mediaVoti = mediaVoti($studente["voti"]);

    //trasfm l'array dei voti in una stringa usando il metodo implode()
    $stringaVoti = implode(",", $studente["voti"]);

    return "
            
            <div style ='
                            border: double 5px  rgba(243, 207, 1, 0.89);
                            padding:15px;
                            border-radius:50px;
                            font-family:Arial, sans-serif;
                            background: rgba(41, 114, 223, 0.64);
                            box-shadow:0 10px 20px rgba(0,0,0,0.1);
                         
                         >
                        
                         <h2 style='color: #0629f1ff'><b>{$studente['nome']} {$studente['cognome']}</b></h2>
                        <hr>
                         <p>
                            <strong> Eta: </strong>
                            {$studente['eta']}
                         </p>

                          <p>
                            <strong> Email: </strong>
                            <a href='mailto:{$studente['email']}'>
                                {$studente['email']}
                            </a>
                         </p>

                          <p>
                            <strong> Telefono: </strong>
                            {$studente['telefono']}
                         </p>

                        <p>
                            <strong>Voti:</strong>
                            {$stringaVoti}
                        </p>

                          <p>
                            <strong> Media Voti: </strong>
                             " . number_format($mediaVoti, 2) . "
                         </p>
                         
                         </div>
    ";
};

    //funzione principale
    //richiama la funz 
    $studenti = listaStudenti();

    //Css Griglia
    echo "<div style='display:grid; grid-template-columns:repeat(3, 1fr); gap:20px; max-width:1200px; margin:auto;'>";

        /*
|--------------------------------------------------------------------------
| foreach
|--------------------------------------------------------------------------
| Scorre tutti gli elementi dell'array.
|
| Ad ogni ciclo:
| - prende uno studente
| - genera la card HTML
| - la stampa a schermo
|--------------------------------------------------------------------------
*/
foreach ($studenti as $studente) {

    echo cardStudente($studente);
}

// Chiusura del contenitore
echo "</div>";

