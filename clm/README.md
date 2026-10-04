# Integrazione CLM v0.1 (prototipo)

[CLM-v0.1-8B](https://github.com/Contrastive-LM/CLM) (Stanford + NVIDIA, 23/09/2026, Apache 2.0) è un modello di **decisione**: non scrive testo, sceglie l'opzione migliore tra quelle che gli dai, in circa 30–60 ms.

## Architettura

```
PHP (questa app)  --HTTP/JSON-->  clm-serve :8700  --HTTP-->  vLLM + Qwen3-8B :8090
                                  (Python, heads)            (embedding, GPU)
```

PHP non carica il modello: chiama `clm-serve` come una qualsiasi API REST.
`ClmClient.php` usa solo cURL e JSON, senza Composer.

| Endpoint | Uso |
|---|---|
| `POST /v1/systemone` | domande tipizzate: `noul` (sì/no), `choice` (categoria), `score` (scala) |
| `POST /v1/rank` | ordina una lista di risposte candidate |
| `GET /health` | stato del server e dell'embedder |

## Come provarlo

```bash
php clm/demo.php        # senza server: usa il fallback a regole
```

**Senza GPU (verifica del formato, non dei risultati):**

```bash
git clone https://github.com/Contrastive-LM/CLM && cd CLM
pip install fastapi uvicorn numpy requests
python tools/playground_mock.py --port 8700
```

Il mock usa n-grammi di caratteri al posto di Qwen3-8B: i numeri che restituisce **non** sono predizioni di CLM.

**Con GPU (risultati reali):** vedi il README di CLM. Servono `vllm serve Qwen/Qwen3-8B --runner pooling ...` e `clm-serve`.

## Test eseguiti (contro il mock)

| Scenario | Esito |
|---|---|
| Server spento | eccezione `ClmException`, si usa il fallback a regole |
| Mock attivo | risposte `choice` / `noul` / `score` e `rank` lette correttamente |
| Embedder giù (`--broken`) | errore 502 gestito, fallback |
| `CLM_API_KEY` errata / corretta | 401 gestito / risposta ok |

## Valutazione

**Pro**
- Integrazione semplice: un client HTTP di circa 150 righe.
- Molto veloce, adatto a decisioni ripetute su ogni richiesta.
- Le risposte sono strutturate (categoria e probabilità), quindi non serve interpretare testo libero.
- Licenza Apache 2.0, si può ospitare in proprio, i dati restano nostri.

**Contro**
- Serve una GPU (classe RTX 4090) per l'embedder Qwen3-8B, più due servizi Python da gestire. Le sole heads girano anche su CPU.
- È alla versione 0.1. I punteggi non sono calibrati: soglie come "confidenza > 0.7" vanno tarate su dati nostri.
- Solo testo, e lo stato viene troncato oltre 2048 token.
- Zero-shot è buono ma non perfetto. Per il nostro dominio servirebbe un fine-tuning delle heads (circa 1 ora su una 4090, vedi `docs/FINETUNING.md`).

**Quando conviene**
Ha senso solo quando l'app ha decisioni testuali ad alto volume: smistare messaggi o ticket, scegliere lo strumento giusto, classificare feedback. Con i volumi attuali (esercizi del corso) costa meno usare regole PHP o un'API LLM ospitata.

**Regola di progetto:** CLM resta sempre opzionale. Timeout breve (2 s) e fallback obbligatorio, così l'app funziona anche senza il server.
