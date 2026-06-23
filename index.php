<?php
 echo "Chi sono: Daniele Benetti - Corso Full Stack";
 echo "<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque placeat ullam, qui ea soluta tenetur fugit veniam deserunt a repellendus nemo magni 
 sequi dolorum ex optio quo vero quae praesentium!</p>";

 // Tipi di dato e variabili e ;la concatenazione
 $nomeCorso = "Full-Stack Developers";  // variabile contenente stringa (string)
 $totaleMesi = 12;                      // intero (integer / in / number)
 $prezzoOra = 24.99;                    // Decimale/Float (numeri con virgole)
 $scelta = true;                        // Booolean(vero/falso) Bool(true/false)
 echo $nomeCorso; 
 echo $totaleMesi; 
 echo $prezzoOra;

 //stampa e concatenazione
echo $nomeCorso, $totaleMesi, $prezzoOra; 

echo "Il corso" . $nomeCorso . "ha 1 durata di" . $totaleMesi . "il suo costo è: $" .$prezzoOra;



?>