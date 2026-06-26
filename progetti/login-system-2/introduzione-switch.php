<?php

//Lo switch è un costrutto x il controllo condiz
//confronta un valora con diverse opzioni

/*

Sintassi base:

switch($var){

    case valore1:
        //codice
    breaK; //ferma l'esecuzione del costrutto switch a questo punto
    case valore2:
        //codice
    breaK;
    .
    .
    .
    case valoreN:
        //codice
    break;
    
    default 
        //codice;

}

*/

/*
    Come funziona:
    PHP fa questo processo:😅
    1. prende la variabile
    2. la confronta 
    3. quando trova una corrispondeza -> esegue il blocco del codice 
    4. break ferma lo switch(il ciclo)
    5. default è caso "altrimenti come nella condizione if/else"

*/
function lunedi()
{
    echo "Siamo il primo giorno della settimana";
}

$giorno = "lunedi";

switch ($giorno) {
    case "lunedi":
        lunedi();
        break; // ferma lo switch

    case "martedi":
        echo "Siamo il secondo giorno della settimana";
        break;

    case "mercolodi":
        echo "Siamo il sezo giorno della settimana";
        break;

    case "giovedi":
        echo "Mancan solo un giorno per fare l'aperitivo🎉🎉";
        break;

    case "venredi":
        echo "Non dico🎉🎉";
        break;
    default:
        echo "Giorno normale 🤨🤨🤨";
}
echo "<br>";
//verifica se il voto è uguale a 30
$voto = 30;

switch ($voto) {

    case 30:
    echo "Complimenti! 30";
        break;
    case 29:
    case 28:
    echo"Ottimo voto!";
        break;
    case 25 : 
     echo"Bravo!";
        break;
    case  20 : 
     echo"Bravin!";     
        break;
    default: 
     echo"Hai fatto schif!";
        break;
}

?>
