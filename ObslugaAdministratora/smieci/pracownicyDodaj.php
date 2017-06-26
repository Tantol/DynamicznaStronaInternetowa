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
//Sprawdzenie czy wszystkie wartosci pol wymaganych tabeli
//zostalay wyslane z formularza.
if(!isset($_GET["textOdleglosc"]) || ($_GET["textOdleglosc"]== "") || !isset($_GET["textCena"]) || ($_GET["textCena"]== "")
|| !isset($_GET["textDataZlozenia"]) || ($_GET["textDataZlozenia"]== "") || !isset($_GET["textDataRealizacji"]) || ($_GET["textDataRealizacji"]== "")
|| !isset($_GET["textTerminRealizacji"]) || ($_GET["textTerminRealizacji"]== "")
|| !isset($_GET["textOpoznienie"]) || ($_GET["textOpoznienie"]== "")
|| !isset($_GET["textDataOdbioruLadunku"]) || ($_GET["textDataOdbioruLadunku"]== "")
|| !isset($_GET["textIdZamowienia"]) || ($_GET["textIdZamowienia"]== "")
|| !isset($_GET["textUwagi"]) || ($_GET["textUwagi"]== "")
|| ($_GET["wybierz"]== "0")|| ($_GET["wybierz2"]== "0")){
	print("<p class='blad'> Nie mozna zapisac danych</p>");
	print("<p><a href='pracownicyTabela.php'> Powrot do wykazu.</a></p>");
}
else{
	print("<p class='sukces'> Dodano</p>");
	print("<p><a href='pracownicyTabela.php'> Powrot do wykazu pracownikow.</a></p>");

//Pobieranie danych wyslanych z form.
	
			$Odleglosc = $_GET["textOdleglosc"];
			$Cena = $_GET["textCena"];
			$DataZlozenia = $_GET["textDataZlozenia"];
			$DataRealizacji = $_GET["textDataRealizacji"];
			$TerminRealizacji = $_GET["textTerminRealizacji"];
			$Opoznienie = $_GET["textOpoznienie"];
			$DataOdbioruLadunku = $_GET["textDataOdbioruLadunku"];
			$IdZamowienia = $_GET["textIdZamowienia"];
			$Uwagi = $_GET["textUwagi"];
			$IdKlienta = $_GET["wybierz"];
			$IdPracownika = $_GET["wybierz2"];

			
			
	

// Dane serwera bazy danych i polaczenia.
$serwer = "INF-SQL\SQL3";
//$serwer = "SZATAN\SQLEXPRESS";
$danePolaczenia = array("Database" => "B40", "UID" =>"B40", "PWD" => "tracer552188", "CharacterSet" => "UTF-8");
//$danePolaczenia = array("Database" => "Nowa", "CharacterSet" => "UTF-8");
//Proba polaczenia z serwerem baz danych.
$polaczenie = sqlsrv_connect($serwer, $danePolaczenia);

if($polaczenie == false){
	print("<p class='blad'>Polaczenie z serwerem <strong>$serwer</strong> NIE powiodlo sie.</p>");
	print_r(sqlsrv_errors(), true);
}
else{
	
	
	
	print("<p class='sukces'>Polaczenie z serwerem <strong>$serwer</strong> powiodlo sie.</p>");
	
	//Polaczenie SQL wybierajace wiersze z tabeli
	$komendaSql= "INSERT dbo.Zamowienie (IdZamowienia,IdKlient, OdlegloscKM, Cena, Uwagi, DataZlozenia, DataRealizacji, TreminRealizacji, Opoznienie, DataOdbioruLadunku, IdSpedytor) 
	VALUES
	('$IdZamowienia','$IdKlienta', '$Odleglosc', $Cena, '$Uwagi', '$DataZlozenia', '$DataRealizacji', '$TerminRealizacji', '$Opoznienie','$DataOdbioruLadunku','$IdPracownika');";
	//test
	print($komendaSql);
	
	//Proba wykonania polecenia SQL na serwerze bazy danych.
	$wynik= sqlsrv_query($polaczenie, $komendaSql);
	if(($wynik==null)){
		print("<p class='blad'>Zapisanie danych nie powiodlo sie </p>");
		print_r(sqlsrv_errors(), true);
	}
	else{
		print("<p class='sukces'> Dane zostaly zapisane</p>");
			 sqlsrv_free_stmt($wynik);

		
	} // else (jezeli zostaly zwrocone wiersze)
	


	
	
	
	
	if($polaczenie!=false){
		sqlsrv_close($polaczenie);
	}
	} // else (jezeli polaczenie zostalo nawiazane)
}
?>







</body>

</html>
