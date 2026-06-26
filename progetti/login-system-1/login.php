<?php
include 'header.php';
?>

<body>
    <div class="form-container">
        <h1>Login System 1</h1>


        <!--form: definisce il modulo, action=login.php con il metodo=POST-->
        <form action="login.php" method="post">

            <label for="email">Indirizzo Email:</label>
            <!--type="email_utente": fondamentale.-->
            <input type="email" name="email_utente" placeholder="Es. m.rossi@exemplet.com" id="email" required>

            <label for="password">Password:</label>

            <input type="password" name="password_utente" id="password">

            <button type="submit">Accedi</button>
        </form>

        <?php
        // IF: Controlla se la pagina è stata e eseguita dall'invio del form
        // $_SERVER["REQUEST_METHOD"] contiene il metodo usato per la richiesta attuale (GET, POSt)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email_utente"];
            $password = $_POST["password_utente"];


            // Dati del Database
            $emailCorrente = "studente@gmail.com";
            $passwordCorrente = "password@123";


            //IF: Condizionale: l'operatore '===' verifica se c'è l'ugualianza dei e dai dati degli utenti
            if ($email === $emailCorrente && $password === $passwordCorrente) {
                echo "<div class='messagio1'>";
                echo "ACCESSO efettuato con successo: Benvenuti nel in Laravel";
                echo "</div>";
            } else {
                echo "<div class='messagio2'>";
                echo "⚠️Errora! Verifica le credenziali";
                echo "</div>";
            }
        }


        ?>

    </div>
</body>

</html>