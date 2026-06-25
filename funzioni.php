<?php




  function saluta(string $nome, string $lingua = "it"): string {
    return match($lingua) {
      "en" => "Hello $nome",
      "fr" => "Bonjour $nome",
      default => "Ciao $nome"
    };
  }

  /*echo saluta("Moussa");          // Ciao Moussa
  echo saluta("Moussa", "en");    // Hello Moussa


  function summa(num1, num2): numero
{
    return .-...{

    };
}
function somma(num1, num2): numero
{
    return .-...{

    };
}

somma(525 + 52); */
?>