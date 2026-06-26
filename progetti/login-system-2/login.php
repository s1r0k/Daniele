<?php
//namespace dei file
require_once "utenti.php";
require_once "functions.php";

//
include "header.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 📧 dati form
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";


    //🔐 Creazione chiave login
    $loginKey = createLoginKey($email, $password);
    //$nome = volore ? true : false;

     //🔎 Ricerca l'utente nel database
    $utente = trovaUtente($loginKey, getUtenti());

    echo "<h2>Risultatodel login</h2>";

      if ($utente) {
        echo "<script>
                Swal.fire({
                    icon:  'success',
                    title: 'Accesso effettuato',
                    text:  'Benvenuto {$utente['email']}',
                    confimButtonText: 'Continua'
                }).then() => {
                    // Gestione del ruolo
                    switch ('{$utente['ruolo']}') {
                            case 'admin':
                            window.location.href = 'admin.php';
                            break;

                        case 'docente':
                            window.location.href = 'docente.php';
                            break;

                        default:
                            window.location.href = 'index.php';
                    }
                };
            </script>";
    } else {
        echo "<script>Swal.fire({
                    icon:  'Errore',
                    title: 'Accesso negato',
                    text:  'Verifica la password',
                    confimButtonText: 'Riprova'
                }).then() => {
                    window.location.href = 'index.php';
                }
                </script>;"
    }
}