<?php

/*
|--------------------------------------------------------------------------
| Demo: smistare i messaggi degli studenti con CLM
|--------------------------------------------------------------------------
| Esecuzione:  php clm/demo.php
| Variabili:   CLM_URL (default http://127.0.0.1:8700), CLM_API_KEY
|
| Se CLM non risponde, si usa una regola semplice (fallback): l'app
| continua a funzionare anche senza il server con la GPU.
|--------------------------------------------------------------------------
*/

require_once __DIR__ . "/ClmClient.php";

$clm = new ClmClient(getenv("CLM_URL") ?: "http://127.0.0.1:8700", getenv("CLM_API_KEY") ?: null);

$messaggi = [
    "Mi avete addebitato due volte la rata di ottobre, chi mi rimborsa?",
    "Il form di login in modulo.php mi dice sempre credenziali errate",
    "Non ho capito la differenza tra for e foreach, potete rispiegarla?",
];

// Le stesse domande per ogni messaggio: CLM mette in cache le opzioni
$domande = [
    "reparto" => ClmClient::choice("Quale reparto deve rispondere?", [
        "amministrazione" => "Pagamenti, rate, fatture, rimborsi",
        "tecnico" => "Errori, bug, problemi di accesso alla piattaforma",
        "didattica" => "Dubbi sulle lezioni, esercizi, spiegazioni",
    ]),
    "urgente" => ClmClient::noul("Il messaggio richiede una risposta urgente?"),
    "tono" => ClmClient::score("Quanto e' frustrato lo studente?", ["Calmo", "Frustrato", "Molto arrabbiato"]),
];

// Fallback senza AI: parole chiave
function repartoConRegole(string $testo): string
{
    $t = strtolower($testo);
    return match (true) {
        str_contains($t, "rata"), str_contains($t, "pagament"), str_contains($t, "rimbors") => "amministrazione",
        str_contains($t, "errore"), str_contains($t, "login"), str_contains($t, "errat") => "tecnico",
        default => "didattica",
    };
}

foreach ($messaggi as $testo) {
    echo "Messaggio: $testo\n";
    try {
        $r = $clm->systemOne($testo, $domande);
        printf(
            "  CLM -> reparto: %s (confidenza %.2f), urgente: %.0f%%, tono: %.2f/2\n",
            $r["reparto"]["choice"],
            $r["reparto"]["confidence"],
            $r["urgente"]["noul"] * 100,
            $r["tono"]["score"]
        );
    } catch (ClmException $e) {
        echo "  CLM non disponibile ({$e->getMessage()})\n";
        echo "  Regole -> reparto: " . repartoConRegole($testo) . "\n";
    }
}

// Rank: quale lezione del corso suggerire per una domanda
try {
    $lezioni = ["Cicli for e foreach", "Funzioni e tipi di ritorno", "Form HTML e metodo POST", "Array associativi"];
    $classifica = $clm->rank("Come faccio a scorrere tutti gli studenti di un array?", $lezioni, "Quale lezione e' piu' utile?");
    echo "\nLezione consigliata: {$classifica[0]["candidate"]} (prob " . number_format($classifica[0]["prob"], 2) . ")\n";
} catch (ClmException $e) {
    echo "\nRank non disponibile: {$e->getMessage()}\n";
}
