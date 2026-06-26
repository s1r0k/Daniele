<?php
include "header.php"
?>

<body>
    <div class="container">
        <h1>🔐Login System</h1>


        <!--form: definisce il modulo, action=login.php con il metodo=POST-->
        <form action="login.php" method="post">

            <label>Indirizzo Email:</label>
            <!--type="email_utente": fondamentale.-->
            <input type="email" name="email" placeholder="Es. m.rossi@exemplet.com" required>

            <label for="password">Password:</label>

            <input type="password" name="password" placeholder="Inserisci la password" required>

            <button type="submit">Accedi</button>
        </form>

    </div>
</body>

</html>