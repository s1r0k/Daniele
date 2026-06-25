<?php
/*

//array
    $studenti = [
        "Francesco",
        "Luana",
        "Annalisa",
        "Marco",
        "Paolo",
        "Davide",
        "Carlo",
        "Moussa",
        "Daniele",
        "Fabio",
        "Luca"
    ];
//ciclo for
    for ($i=0; $i < sizeof($studenti); $i++){
        echo "<b>[".$i."] </b> ".$studenti[$i];
        if($i < count($studenti)-1){
             echo" -->";
        }else break;
    };
*/

//lista della spesa di Daniele Benetti
$listaSpesa = [
    "Uova",
    "Pancetta",
    "Latte",
    "Farina",
    "Olio",
    "Surgelati",
    "Pomodori",
    "Moussa",
    "Maionese",
    "Pollo",
    "Pesce"
];

//ciclo for
echo "<b>[Lista della spesa di Daniele]</b><br>";
for ($i = 0; $i < sizeof($listaSpesa); $i++) {
    if ($i < count($listaSpesa)) {
        echo "[" . $i . "] --> ";
    } else break;
    echo $listaSpesa[$i] . "<br>";
};
