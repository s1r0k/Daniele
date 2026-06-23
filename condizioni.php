<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // ...existing code...

    /*
    Operatori di confronto:
    == | Uguaglianza
    === | Identico (uguaglianza stretta)
    != | diverso da/a
    > | maggiore
    < | minore 
    >= | maggiore uguale
    <= | minore uguale
*/

    /*
    Controllo di flusso e strutture di iterazione:
    Logica condizionale con if else if else
*/

    
    /* Esempio 1 */
 
    // if ($eta == $eta_database = 40) {
    //     echo "<h1>Eta corretta <strong> ❕❤️ </strong></h1>";
    // } else if ($eta < 18) {
    //     echo "<h1>minorenne❕❕❕❕❕</h1>";
    // } else {
    //     echo "maggiorenne";
    // }
    //     echo"<p>
    //             Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, quos iure? Nesciunt eveniet,
    //             maiores sit ratione reprehenderit nulla. Ab soluta nam alias architecto, atque ad explicabo sit magni tempora fugit.
    //         </p>"

    /*Esempio 2 */
    /*
    $etaUtente = 14;
    $etaMinima = 18;

    if($etaUtente >= $etaMinima){
        echo"Acquisto autorizzato! 😁";
    }else{
        echo"Spiazze non hai raggiunto l'età minima valida per l'acquisto, riprova tra " .$etaMinima-$etaUtente . " anni!";
    }
    */

/*    $nomeUtente = "Utente";
    $pwdUtente =  "Password";

    $nomeUtenteDb = "Utente";
    $pwdUtenteDb =  "Password";

    if ($nomeUtente == $nomeUtenteDb && $pwdUtente == $pwdUtenteDb){
        echo"Accesso eseguito!";
    }else{
        echo"Nome Utente o Password errati!";
    }

    if ($nomeUtente == $nomeUtenteDb){
        if($pwdUtente == $pwdUtenteDb){
            echo"Accesso eseguito!";
        }
        else{
            echo"Nome Utente o Password errati!";
        }
    }else{
        echo"Nome Utente o Password errati!";
    } */


     $totaleSpesa = 899; // in Euro
    $tipoCliente = "Gold";

    $clientePlatinum = "Platinum";
    $clienteGold = "Gold";
    $clienteSilver = "Silver";
    $clienteScopper = "Scopper";

    if ($tipoCliente == $clientePlatinum) {
        $totaleScontato = $totaleSpesa - ($totaleSpesa * 0.35); 
            echo "Cliente premium Platinum! Hai gudagnato 35% di sconto. il suo prezzo finale è " . $totaleScontato . "€";
        }else if($tipoCliente == $clienteGold){
            $totaleScontato = $totaleSpesa - ($totaleSpesa * 0.20); 
             echo "Cliente premium Gold! Hai gudagnato 20% di sconto. il suo prezzo finale è " . $totaleScontato . "€";
        }else if($tipoCliente == $clienteSilver){
            $totaleScontato = $totaleSpesa - ($totaleSpesa * 0.10); 
             echo "Cliente premium Silver! Hai gudagnato 10% di sconto. il suo prezzo finale è " . $totaleScontato . "€";
        }else if($tipoCliente == $$clienteScopper){
            $totaleScontato = $totaleSpesa - ($totaleSpesa * 0.05); 
            echo "Cliente premium Scopper! Hai gudagnato 5% di sconto. il suo prezzo finale è " . $totaleScontato . "€";
    } else {
        echo "Nessuno sconto applicato per clienti standard";
    }
    ?>
    ?>
</body>
    
</html>