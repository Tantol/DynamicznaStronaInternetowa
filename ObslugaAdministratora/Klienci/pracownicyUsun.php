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
if(!isset($_SESSION["zalogowany"]) || ($_SESSION["zalogowany"] == false) || !isset($_SESSION["uzytkownik"]))
{
	$_SESSION["zalogowany"] = false;
	
	if (isset($_SESSION["uzytkownik"]))
		unset($_SESSION["uzytkownik"]);

print("<p class='blad'> Funkcja dostepna tylko dla administratorow</p>");
	
		print("<p><a href='../start.php'>Powrot do ekranu glownego</a></p>");

}
else if (($_SESSION["zalogowany"] == true) && ($_SESSION["uzytkownik"] != "")){
$IdPracownika = $_GET["IdPracownik"];
	
	print("<h3>Usuwanie Pracownika</h3>");
	print("<p>Czy na pewno usun±ć pracownika o identyfikatorze <strong>$IdPracownika</strong>?<p>");
	print("<p><a href='pracownicyUsunTak.php?IdPracownika=$IdPracownika'>Tak</a>&nbsp;&nbsp;&nbsp;
	<a href='pracownicyTabela.php'>Nie</a></p>");

	print("<p> <br /><a href='pracownicyTabela.php'>Powrót do listy pracownikow.</a></p>");
}
?>
</body>
</html>