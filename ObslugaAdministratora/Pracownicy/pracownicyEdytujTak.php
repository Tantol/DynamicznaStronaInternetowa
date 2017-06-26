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
	print("<h3>Edycja danych pracownika</h3>");

	if(!isset($_GET["textImie"]) || ($_GET["textImie"]== "") || !isset($_GET["textNazwisko"]) || ($_GET["textNazwisko"]== "")
|| !isset($_GET["textNrTelefonu"]) || ($_GET["textNrTelefonu"]== "") || !isset($_GET["textEmail"]) || ($_GET["textEmail"]== "")
|| !isset($_GET["textStanowisko"]) || ($_GET["textStanowisko"]== "")
|| !isset($_GET["textIdPracownika"]) || ($_GET["textIdPracownika"]== "")
|| !isset($_GET["textLicencja"]) || ($_GET["textLicencja"]== "")){
	print("<p class='blad'> Nie mozna zapisac danych pracownika w bazie</p>");
	print("<p><a href='pracownicyTabela.php'> Powrot do wykazu pracownikow.</a></p>");
}
else{
	print("<p class='sukces'> Dodano</p>");
	print("<p><a href='pracownicyTabela.php'> Powrot do wykazu pracownikow.</a></p>");

	$Imie = $_GET["textImie"];
			$Nazwisko = $_GET["textNazwisko"];
			$NrTelefonu = $_GET["textNrTelefonu"];
			$Email = $_GET["textEmail"];
			$Stanowisko = $_GET["textStanowisko"];
			$IdPracownika = $_GET["textIdPracownika"];
			$Licencja = $_GET["textLicencja"];
			$Zdjecie = $_GET["filZdjecie"];

	
require_once "../../polaczenieZBZ.php";

	if ($polaczenie == false)
	{
		print("<p class='blad'>Poł±czenie z serwerem $serwer nie powiodło się.</p>");
		die(print_r(sqlsrv_errors(), true));
	}
	
	$komenda_sql = "UPDATE dbo.Pracownik SET Imie = '$Imie', Nazwisko = '$Nazwisko', NrTelefonu = '$NrTelefonu', Email = '$Email', Stanowisko = '$Stanowisko', Licencja = '$Licencja', Zdjecie='$Zdjecie' WHERE IdPracownika = $IdPracownika;";
	
	$rezultat = sqlsrv_query($polaczenie, $komenda_sql);
	
	$wiersze_zmienione = sqlsrv_rows_affected($rezultat);
	
	if ($rezultat == false)
	{
		print("<p class='blad'>Modyfikacja danych pracownika <strong>$Imie $Nazwisko</strong> w bazie nie powiodła się.</p>");
		print_r(sqlsrv_errors(), true);
	}
	else if ($wiersze_zmienione == 1)
		print("<p class='sukces'>Zmodyfikowane dane pracownika <strong>$Imie $Nazwisko</strong> zostały zapisane w bazie.</p>");
	else if ($wiersze_zmienione == 0)
		print("<p>W bazie nie ma pracownka o identyfikatorze <strong>$IdPracownika</strong>.</p>");
		
	print("<p> <br /><a href='pracownicyTabela.php'>Powrót do listy pracownikow.</a></p>");
	
	// Zwolnienie zasobów - wyniku zapytania.
	sqlsrv_free_stmt($rezultat);
}
	// Zamknięcie poł±czenia z serwerem.
	if ($polaczenie != false)
		sqlsrv_close($polaczenie);

}
?>

</body>
</html>
