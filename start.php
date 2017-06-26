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
      <link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>
	<?php
print("
	<div id='element_z_tlem'>
<div id='blokLogo'>
<a href='start.php'><img src='Logo/logo.jpg' alt='logo firmy'></a>
</div>
   
    <div id='blokMenu'>
    ");
require_once "menuStart.php";
if(!isset($_SESSION["zalogowany"]) || ($_SESSION["zalogowany"] == false) || !isset($_SESSION["uzytkownik"]))
{
	$_SESSION["zalogowany"] = false;
	
	if (isset($_SESSION["uzytkownik"]))
		unset($_SESSION["uzytkownik"]);

require_once "panelLogowania.php";
} else if (($_SESSION["zalogowany"] == true) && ($_SESSION["uzytkownik"] != "")&&  ($_SESSION["Klient"] == true)){
require_once "panelUzytkownika.php";
} else if (($_SESSION["zalogowany"] == true) && ($_SESSION["uzytkownik"] != "") && ($_SESSION["Pracownik"] == true)&& ($_SESSION["PracownikId"] != "")){

require_once "panelAdministratoraStart.php";
}
print("
</div>
   

        <div id='blokGlowny'>
			");
require_once "blokLewy1.php";

require_once "blokPrawy1.php";
require_once "blokLewy2.php";			
require_once "blokStopka.php";
print("
</div>

	</div>
");
?>
</body>

</html>
    