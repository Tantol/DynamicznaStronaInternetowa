<?php

	session_name("PSIN");
	session_start();
?>
<!doctype html>
<html lang="pl">
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Programowanie serwisów internetowych – lista C3.</title>
      <meta name="keywords" content="serwisy, internetowe, programowanie" />
      <meta name="description" content="Strona utworzona w ramach listy C3." />
      <meta name="author" content="Piotr Żarczyński" />
      <link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>

<?php
if(!isset($_SESSION["zalogowany"]) || ($_SESSION["zalogowany"] == false) || !isset($_SESSION["uzytkownik"]) || !isset($_SESSION["Pracownik"]) || ($_SESSION["Pracownik"] == false) || !isset($_SESSION["PracownikId"]))
{
	$_SESSION["zalogowany"] = false;
	
	if (isset($_SESSION["uzytkownik"]))
		unset($_SESSION["uzytkownik"]);

	print("<p class='sukces'>Brak dostepu</p>");
			
			print("<p> <a href='../start.php'>Powrot do strony glownej</a></p>");

}
else if (($_SESSION["zalogowany"] == true) && ($_SESSION["uzytkownik"] != "") && ($_SESSION["Pracownik"] == true)&& ($_SESSION["PracownikId"] != "")){


$IdPracownika = $_GET["IdPracownika"];
	
	print("<div id='element_z_tlem'>
<h3>Usuwanie Pracownika</h3>");
	print("<p>Czy na pewno usun±ć ladunek o identyfikatorze <strong>$IdPracownika</strong>?<p>");
	print("<p><a href='usuwanieLadunkowPotwierdzenie.php?IdPracownika=$IdPracownika'>Tak</a>&nbsp;&nbsp;&nbsp;
	<a href='wykazZamowien.php'>Nie (powrot do wykazu zamowien)</a></p>");

	print("<p> <br /><a href='pracownicySzczegoly.php?IdPracownik=$$IdPracownika'>Powrót.</a></p>
</div>");
}

?>
</body>
</html>