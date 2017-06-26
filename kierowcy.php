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
require_once "polaczenieZBZ.php";
$komendaSql= "SELECT Imie, Nazwisko, Stanowisko, Licencja, Zdjecie
FROM dbo.Pracownik 
WHERE Stanowisko='Kierowca'
ORDER BY Imie ASC";
	//Proba wykonania polecenia SQL na serwerze bazy danych.
	$zbiorWierszy= sqlsrv_query($polaczenie, $komendaSql);
while($wiersz = sqlsrv_fetch_array($zbiorWierszy, SQLSRV_FETCH_ASSOC)){ // petla przerobienia
			$Imie = $wiersz["Imie"];
			$Nazwisko = $wiersz["Nazwisko"];
			$Licencja = $wiersz["Licencja"];
			$Zdjecie = $wiersz["Zdjecie"];
			print("
				<div id='blokPracownika'>
				<p>$Imie  $Nazwisko</p>
				<p><img src='ZdjeciaPracownikow/$Zdjecie' alt='$Imie $Nazwisko'/>
				<p>Licencja: $Licencja </p>
				</div>");
}
			
require_once "blokStopka.php";
print("
</div>

	</div>

");
sqlsrv_free_stmt($zbiorWierszy);
sqlsrv_close($polaczenie);
?>
</body>

</html>
    