<?php
//array
    $studenti = [
        "Francesco",
        "Luana",
        "Annalisa",
        "Marco",
        "Paolo",
        "Davide",
        "Carlo",
        "Daniele",
    ];
//una funz che conta gli elem all'interno di $studenti utilizzando count()

$totaleStudenti = count($studenti);

// stampo il risultato
echo"Il numero totale degli studenti è: " .$totaleStudenti . "<br>";

//stampo l'ultimo elem dell'array (o lista)
    echo "L\'ultimo studente è: ". $studenti[7]. "<br>";
    echo" Il quinto studente è: " . $studenti[4]. "<br>";
    echo"<hr>";


    //aggiungere 1 el in array(aggiunto alla fine)
    $studenti[]= "Fabio";
    //array_push($array, "elemento1", ...., "elementoN");
    echo "<b>[AGGIUNTA]:</b> Abbiamo aggiunto 1 studnt ,<br>";
    echo "Ora l\'ultimo studente è: ". $studenti[8]. "<br>";
    
    //stampo il totale degli elem nell'array aggiornato
    echo "Il totale degli studenti è: " . count($studenti) ." studenti! <br>"; //utilizzando count
    echo "Il totale degli studenti è: " . sizeof($studenti) ." studenti! <br>"; //utilizzando size_of

    echo"<hr>";
//modifica dello studente: 
    $studenti[2] = "Giovanni";
     echo"<b>[UPDATE]</b> Il terzo studente ora è: " . $studenti[2]. "<br>";


//elimino  1 elem array_splice (può rimuovere + elem, può inserire elem,  restit elem rimossi):
//array_splice($array, el di partenza (compreso), quanti elem eliminare);
//array_pop elimina l'ultimo elem dell'array 
//array_shif elimina   il primo el dell'array
echo"<hr>";
echo "<b>[ELIMINAZIONE]</b> Abbiamo tolto uno studente con l'indice 2: ".$studenti[2]. " <br>";
array_splice($studenti, 2, 1); //elimino Annalisa

 echo "Il totale degli studenti è: " . count($studenti) ." studenti! <br>";


 //CRUD - create  read update delete 
?>

