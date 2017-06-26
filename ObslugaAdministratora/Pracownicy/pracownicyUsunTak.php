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
print("<h3>Usuwanie danych klienta</h3>");

	$IdPracownika = $_GET["IdPracownika"];
	
	if ($IdPracownika == "")
		die("<p class='blad'>Nie wybrano pracownika.</p><p><br /><a href='pracownicyTabela.php'>Powrót do listy klientów.</a></p>");

	
require_once "../../polaczenieZBZ.php";

	if ($polaczenie == false)
	{
		print("<p class='blad'>Poł±czenie z serwerem $serwer nie powiodło się.</p>");
		die(print_r(sqlsrv_errors(), true));
	}
	
	$komenda_sql = "DELETE dbo.Pracownik WHERE IdPracownika = $IdPracownika;";
	
	$rezultat = sqlsrv_query($polaczenie, $komenda_sql);
	
	$wiersze_zmienione = sqlsrv_rows_affected($rezultat);
	
	if ($rezultat == false)
	{
		print("<p class='blad'>Usunięcie pracownika <strong>$IdPracownika</strong> z bazy nie powiodło się.</p>");
		print_r(sqlsrv_errors(), true);
	}
	else if ($wiersze_zmienione == 1)
		print("<p class='sukces'>Dane pracownika <strong>$IdPracownika</strong> zostały usunięte z bazy.</p>");
	else if ($wiersze_zmienione == 0)
		print("<p>W bazie nie ma pracownika o identyfikatorze <strong>$IdPracownika</strong>.</p>");
		
	print("<p> <br /><a href='pracownicyTabela.php'>Powrót do listy pracownikow.</a></p>");
	
	// Zwolnienie zasobów - wyniku zapytania.
	sqlsrv_free_stmt($rezultat);

	// Zamknięcie poł±czenia z serwerem.
	if ($polaczenie != false)
		sqlsrv_close($polaczenie);
}

?>
</body>
</html>