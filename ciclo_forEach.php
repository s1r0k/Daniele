<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Corso PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            /* padding: 0px; */
            background-color: #e8ebed;
            color: #2d3748;
        }

        .box {
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            max-width: 500px;
        }


        .studente-box {
            background-color: #FFFFEF;
            padding: 20px;
            border-left: 5px solid #9be476;

        }

        h3 {
            color: #2d3748;
            border-bottom: 2px solid #5e6c83;
            border-top: 2px solid #5e6c83;
            padding-top: 8px;
            padding-bottom: 8px;
        }

        li {
            margin-bottom: 6px;
        }
    </style>
</head>

<body>
    <div class="contain">
        <h1> Cicli <i>foreach in php</i></h1>
        <div class="box">
            <h3>Corso1: Lettura di chiave e valore</h3>

            <?php
            //foreach scorre dirett gli el di 1 array

            $profiloStudenti = [
                [
                    "Nome" => "Luana",
                    "Corso" => "PHP Full-Stack",
                    "Stato" => "Iscritta",
                    "Voto Medio" => 9
                ],

                [
                    "Nome" => "Francesco",
                    "Corso" => "PHP Full-Stack",
                    "Stato" => "In corso",
                    "Voto Medio" => 8
                ],

                [
                    "Nome" => "Andrea",
                    "Corso" => "C# Developer",
                    "Stato" => "Iscritto",
                    "Voto Medio" => 9
                ],

                [
                    "Nome" => "Paolo",
                    "Corso" => "Python Data Analyst",
                    "Stato" => "Sospeso",
                    "Voto Medio" => 6
                ],

                [
                    "Nome" => "Fabio",
                    "Corso" => "Sql Server",
                    "Stato" => "In corso",
                    "Voto Medio" => 10
                ],
            ];
            // Il foreach mappa la chiave in $proprieta e il contenuto in $dato
            // foreach ($profiloStudente as $proprieta => $dato) {
            //     echo "<li>" . $proprieta . ": <strong>" . $dato . "</strong></li>";
            // }
            // Primo ciclo: Entra nella lista  e prende uno studente alla volta
            foreach ($profiloStudenti as $studente) {
                // Apriamo il contenitore del box HTML per lo studente corrente
                echo '<div class="studente-box">';

                // Stampiamo il nom dello studente come titolo del box
                echo "<h3>Profilo di:" . $studente["Nome"] . " </h3>";
                echo "<ul>";
                //secondo ciclo (Annidato) mappa le chiavi e i valori:
                foreach ($studente as $proprieta => $dato) {
                    // verifica se la proprieta à uguale al Nome 
                    if ($proprieta != "Nome") {
                        echo "<li>" . $proprieta . ": <strong>" . $dato . "</strong></li>";
                    }
                    echo "</ul>";
                }
                echo "</div>";
            }


            ?>


        </div>
    </div>

</body>

</html>