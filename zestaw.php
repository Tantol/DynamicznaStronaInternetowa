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
<a href='start.php'><img src='Logo/logo.jpg'></a>
</div>
   
    <div id='blokMenu'>
    ");
require_once "menuStart.php";
if(!isset($_SESSION["zalogowany"]) || ($_SESSION["zalogowany"] == false) || !isset($_SESSION["uzytkownik"]))
{
	$_SESSION["zalogowany"] = false;
	
	if (isset($_SESSION["uzytkownik"]))
		unset($_SESSION["uzytkownik"]);

} else if (($_SESSION["zalogowany"] == true) && ($_SESSION["uzytkownik"] != "")&&  ($_SESSION["Klient"] == true)){
require_once "panelUzytkownika.php";
} else if (($_SESSION["zalogowany"] == true) && ($_SESSION["uzytkownik"] != "") && ($_SESSION["Pracownik"] == true)&& ($_SESSION["PracownikId"] != "")){

require_once "panelAdministratoraStart.php";
}
print("
</div>
   

        <div id='blokGlowny'>
			");

			print("
				<div id='blok1'>
				<label>
				<h1> Naczepa STANDARD/MEGA </h1>
				<p> Rozmiary: 13,6 x 2,45 x 2,75/3,0 m  Kubatura: 90/100 m3  Ładowność: 24t  Ilość europalet: 33 </p>
				<p><img src='ZdjeciaCiezarowek/naczepa.png' alt='Naczepa STANDARD/MEGA'/>
				</label>
				</div>
				<div id='blok2'>
				<label>
				<h1> Naczepa DWIE W CENIE JEDNEJ </h1>
				<p> Rozmiary: 2 x [7,8 x 2,48 x 3,0] m  Kubatura: 118 m3  Ładowność: 24t  Ilość europalet: 38 </p>
				<p><img src='ZdjeciaCiezarowek/naczepa2.png' alt='Naczepa STANDARD/MEGA'/>
				</label>
				</div>
				");

			
require_once "blokStopka.php";
print("
</div>
");
print("
	</div>

");

?>
</body>

</html>
    