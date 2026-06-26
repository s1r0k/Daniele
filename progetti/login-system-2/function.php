<?php
// Crea la chiave di login
function createLoginKey(string $email, string $password): string
{
    return $email . "|" . $password;
    // es: => email@....|123
}


// Cerca Utente
// Scorre tutti gli utenti e verifica se esite o uguale
function trovaUtente(string $loginKey, array $utenti): ?array
{
    foreach ($utenti as $utente) {
        $key = createLoginKey($utente["email"], $utente["password"]);

        if ($loginKey === $key) {
            return $utente;
        }
    }

    return null;
}


// Gestioine del Ruolo con lo SWITCH
// in base al ruolo mostra un messaggio diverso
// function mostraRuolo di tipo void con un parametro di tipo stringa
function mostraRuolo(string $ruolo): void
{
    switch ($ruolo) {

        case "admin":
            echo "<p>🔴 Admin: accesso completo al sistema</p>";
            break;

        case "studente":
            echo "<p>🟢 Studente: accesso area personale</p>";
            break;

        case "docente":
            echo "<p>🔵 Docente: gestione corsi</p>";
            break;

        default:
            echo "<p>⚠️ Ruolo non riconosciuto</p>";
    }
}
