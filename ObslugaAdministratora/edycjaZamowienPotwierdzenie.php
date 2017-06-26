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

	print("<h3>Edycja danych pracownika</h3>");

	if(!isset($_GET["textOdleglosc"]) || ($_GET["textOdleglosc"]== "") || !isset($_GET["textCena"]) || ($_GET["textCena"]== "")
|| !isset($_GET["textDataZlozenia"]) || ($_GET["textDataZlozenia"]== "") || !isset($_GET["textDataRealizacji"]) || ($_GET["textDataRealizacji"]== "")
|| !isset($_GET["textTerminRealizacji"]) || ($_GET["textTerminRealizacji"]== "")
|| !isset($_GET["textOpoznienie"]) || ($_GET["textOpoznienie"]== "")
|| !isset($_GET["textDataOdbioruLadunku"]) || ($_GET["textDataOdbioruLadunku"]== "")
|| !isset($_GET["textIdZamowienia"]) || ($_GET["textIdZamowienia"]== "")
|| ($_GET["wybierz"]== "0")|| ($_GET["wybierz2"]== "0")){
	print("<p class='blad'> Nie mozna zapisac danych pracownika w bazie</p>");
	print("<p><a href='pracownicyTabela.php'> Powrot do wykazu pracownikow.</a></p>");
}
else{
	print("<div id='element_z_tlem'>
<p class='sukces'> Dodano</p>");
	print("<p><a href='wykazZamowien.php'>Powrot do wykazu zamowien</a></p>");

			$Odleglosc = $_GET["textOdleglosc"];
			$Cena = $_GET["textCena"];
			$DataZlozenia = $_GET["textDataZlozenia"];
			$DataRealizacji = $_GET["textDataRealizacji"];
			$TerminRealizacji = $_GET["textTerminRealizacji"];
			$Opoznienie = $_GET["textOpoznienie"];
			$DataOdbioruLadunku = $_GET["textDataOdbioruLadunku"];
			$IdZamowienia = $_GET["textIdZamowienia"];
			if(!isset($_GET["textUwagi"]) || ($_GET["textUwagi"]== "")){
				$Uwagi ='';
			}else{
			$Uwagi = $_GET["textUwagi"];}
			$IdKlienta = $_GET["wybierz"];
			$IdPracownika = $_GET["wybierz2"];

	
require_once "../polaczenieZBZ.php";


	if ($polaczenie == false)
	{
		print("<p class='blad'>Poł±czenie z serwerem $serwer nie powiodło się.</p>");
		die(print_r(sqlsrv_errors(), true));
	}
	
	$komenda_sql = "UPDATE dbo.Zamowienie SET IdKlient='$IdKlienta', OdlegloscKM='$Odleglosc', Cena='$Cena', Uwagi='$Uwagi', DataZlozenia='$DataZlozenia', DataRealizacji='$DataRealizacji', TreminRealizacji='$TerminRealizacji', Opoznienie='$Opoznienie', DataOdbioruLadunku='$DataOdbioruLadunku', IdSpedytor='$IdPracownika' WHERE IdZamowienia = $IdZamowienia;";
	
	$rezultat = sqlsrv_query($polaczenie, $komenda_sql);
	
	$wiersze_zmienione = sqlsrv_rows_affected($rezultat);
	
	if ($rezultat == false)
	{
		print("<p class='blad'>Modyfikacja danych pracownika w bazie nie powiodła się.</p>");
		print_r(sqlsrv_errors(), true);
	}
	else if ($wiersze_zmienione == 1)
		print("<p class='sukces'>Zmodyfikowane dane pracownika  zostały zapisane w bazie.</p>");
	else if ($wiersze_zmienione == 0)
		print("<p>W bazie nie ma pracownka o identyfikatorze .</p>");
		
	print("<p> <br /><a href='pracownicyTabela.php'>Powrót do listy pracownikow.</a></p>");
	
	// Zwolnienie zasobów - wyniku zapytania.
	sqlsrv_free_stmt($rezultat);
	sqlsrv_close($polaczenie);
}


print("</div>");}
?>

</body>
</html>
