<?php

	session_name("PSIN");
	session_start();
?>
<!doctype html>
<html lang="pl">
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Projekt dynamicznej strony Firmy Transportowej</title>
      <meta name="keywords" content="serwisy, internetowe, programowanie" />
      <meta name="description" content="Strona utworzona w ramach listy C5." />
      <meta name="author" content="Piotr Żarczyński" />
      <link rel="stylesheet" type="text/css" href="style2.css"/>
</head>

<body>
	<?php
if (($_SESSION["zalogowany"] == true) && ($_SESSION["uzytkownik"] != "")&&  ($_SESSION["Klient"] == true)){
print("
	<div id='element_z_tlem'>
   
    <div id='blokMenu'>
    ");
require_once "../menu.php";
print("
</div>
   



<div id='blokRejestracji'>
<form id='blokLogowania1' method='GET' action='zlozZamowieniePotwierdz.php'> <p><h1>Panel Zamowienia</h1> </p>
		<p>
            <label for='txtOdlegloscKM'>Przyblizona odleglosc
            <input id='txtOdlegloscKM' type='text' name='txtOdlegloscKM' maxlength='40' required='required' /></label>
        </p>

<p>
            <label for='txtCena'>Sugerowana cena
            <input id='txtCena' type='text' name='txtCena' maxlength='40' required='required' /></label>
        </p>
<p>
            <label for='txtDataOdbioruLadunku'>Data odbioru ladunku
            <input id='txtDataOdbioruLadunku' type='text' name='txtDataOdbioruLadunku' maxlength='40' required='required' /></label>
        </p>
<p>
            <label for='txtTreminRealizacji'>Tremin Realizacji
            <input id='txtTreminRealizacji' type='text' name='txtTreminRealizacji' maxlength='40' required='required' /></label>
        </p>
<p>
            <input class='przycisk' type='submit' value='Dodaj Zamowienie'/>
        </p>

    </form> 

</div>



	<div id='blokGlowny'>
");
require_once '../blokStopka.php';
print("
</div>
</div>


");
}
else{
	print("Brak dostepu");
}
?>
</body>

</html>
    