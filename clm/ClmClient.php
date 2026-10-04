<?php

/*
|--------------------------------------------------------------------------
| ClmClient: client PHP per il server CLM (Contrastive Language Model v0.1)
|--------------------------------------------------------------------------
| CLM non gira dentro PHP: e' un servizio Python separato (clm-serve,
| porta 8700) che a sua volta usa un server di embedding (vLLM + Qwen3-8B).
| PHP gli parla via HTTP + JSON, come con qualsiasi API.
|
| Endpoint usati (da src/clm/server.py del repo Contrastive-LM/CLM):
|   POST /v1/systemone  -> domande tipizzate (noul / choice / score)
|   POST /v1/rank       -> ordina una lista di risposte candidate
|   GET  /health        -> stato del server
|--------------------------------------------------------------------------
*/

class ClmException extends RuntimeException
{
}

class ClmClient
{
    private string $baseUrl;
    private ?string $apiKey;
    private float $timeout;

    /*
        $baseUrl -> indirizzo di clm-serve, es. http://127.0.0.1:8700
        $apiKey  -> opzionale, se il server e' avviato con CLM_API_KEY
        $timeout -> secondi massimi di attesa (CLM risponde in ~30-60 ms)
    */
    public function __construct(string $baseUrl = "http://127.0.0.1:8700", ?string $apiKey = null, float $timeout = 2.0)
    {
        $this->baseUrl = rtrim($baseUrl, "/");
        $this->apiKey = $apiKey;
        $this->timeout = $timeout;
    }

    /********************************** Costruttori di domande **********************************/

    // Domanda si/no: la risposta e' una probabilita' 0-1 in ["noul"]
    public static function noul(string $istruzioni): array
    {
        return ["type" => "noul", "instructions" => $istruzioni];
    }

    // Scelta tra categorie: $criteri = ["chiave" => "descrizione", ...]
    public static function choice(string $istruzioni, array $criteri): array
    {
        return ["type" => "choice", "instructions" => $istruzioni, "criteria" => $criteri];
    }

    // Punteggio su scala ordinata: $livelli = ["basso", "medio", "alto"] (almeno 2)
    public static function score(string $istruzioni, array $livelli): array
    {
        return ["type" => "score", "instructions" => $istruzioni, "criteria" => array_values($livelli)];
    }

    /********************************** Chiamate all'API **********************************/

    /*
        $stato    -> testo, oppure array associativo (diventa "chiave: valore")
        $domande  -> ["id" => ClmClient::choice(...), ...]
        : array   -> ["id" => risposta, ...]
    */
    public function systemOne(string|array $stato, array $domande, string $modello = "clm-latest"): array
    {
        $risposta = $this->richiesta("POST", "/v1/systemone", [
            "state" => $stato,
            "model" => $modello,
            "questions" => $domande,
        ]);

        return $risposta["answers"];
    }

    /*
        Ordina le $risposte (array di stringhe) dalla piu' adatta alla meno adatta.
        : array -> [["rank" => 1, "candidate" => "...", "prob" => 0.8], ...]
    */
    public function rank(string $contesto, array $risposte, ?string $domanda = null): array
    {
        $risposta = $this->richiesta("POST", "/v1/rank", [
            "context" => $contesto,
            "question" => $domanda,
            "answers" => array_values($risposte),
        ]);

        return $risposta["ranked"];
    }

    public function health(): array
    {
        return $this->richiesta("GET", "/health");
    }

    /********************************** HTTP con cURL **********************************/

    private function richiesta(string $metodo, string $percorso, ?array $corpo = null): array
    {
        $ch = curl_init($this->baseUrl . $percorso);

        $header = ["Accept: application/json"];
        if ($this->apiKey !== null) {
            $header[] = "Authorization: Bearer " . $this->apiKey;
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, (int) ($this->timeout * 1000));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $metodo);

        if ($corpo !== null) {
            $header[] = "Content-Type: application/json";
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($corpo, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR));
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $testo = curl_exec($ch);
        $errore = curl_error($ch);
        $codice = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        curl_close($ch);

        // Server spento o troppo lento
        if ($testo === false) {
            throw new ClmException("CLM non raggiungibile: $errore");
        }

        $dati = json_decode($testo, true);

        // 401 chiave errata, 422 richiesta non valida, 502 server di embedding giu'
        if ($codice !== 200 || !is_array($dati)) {
            $dettaglio = is_array($dati) ? ($dati["detail"] ?? $testo) : $testo;
            throw new ClmException("CLM errore $codice: " . (is_string($dettaglio) ? $dettaglio : json_encode($dettaglio)));
        }

        return $dati;
    }
}
