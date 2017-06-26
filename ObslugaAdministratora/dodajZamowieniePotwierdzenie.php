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

if(!isset($_GET["textOdleglosc"]) || ($_GET["textOdleglosc"]== "") || !isset($_GET["textCena"]) || ($_GET["textCena"]== "")
|| !isset($_GET["textDataZlozenia"]) || ($_GET["textDataZlozenia"]== "") || !isset($_GET["textDataRealizacji"]) || ($_GET["textDataRealizacji"]== "")
|| !isset($_GET["textTerminRealizacji"]) || ($_GET["textTerminRealizacji"]== "")
|| !isset($_GET["textOpoznienie"]) || ($_GET["textOpoznienie"]== "")
|| !isset($_GET["textDataOdbioruLadunku"]) || ($_GET["textDataOdbioruLadunku"]== "")
|| !isset($_GET["textUwagi"]) || ($_GET["textUwagi"]== "")
|| ($_GET["wybierz"]== "0")|| ($_GET["wybierz2"]== "0")){
	print("<p class='blad'> Nie mozna zapisac danych</p>");
	print("<p><a href='pracownicyTabela.php'> Powrot do wykazu.</a></p>");
}
else{

//Pobieranie danych wyslanych z form.
			$Odleglosc = $_GET["textOdleglosc"];
			$Cena = $_GET["textCena"];
			$DataZlozenia = $_GET["textDataZlozenia"];
			$DataRealizacji = $_GET["textDataRealizacji"];
			$TerminRealizacji = $_GET["textTerminRealizacji"];
			$Opoznienie = $_GET["textOpoznienie"];
			$DataOdbioruLadunku = $_GET["textDataOdbioruLadunku"];
			$Uwagi = $_GET["textUwagi"];
			$IdKlienta = $_GET["wybierz"];
			$IdPracownika = $_GET["wybierz2"];

			
			
	

require_once "../polaczenieZBZ.php";


if($polaczenie == false){
	print("<p class='blad'>Polaczenie z serwerem <strong>$serwer</strong> NIE powiodlo sie.</p>");
	print_r(sqlsrv_errors(), true);
}
else{
	
	
	
	print("<div id='element_z_tlem'>");
	
	//Polaczenie SQL wybierajace wiersze z tabeli
	$komendaSql= "INSERT dbo.Zamowienie (IdKlient, OdlegloscKM, Cena, Uwagi, DataZlozenia, DataRealizacji, TreminRealizacji, Opoznienie, DataOdbioruLadunku, IdSpedytor) 
	VALUES
	('$IdKlienta', '$Odleglosc', '$Cena', '$Uwagi', '$DataZlozenia', '$DataRealizacji', '$TerminRealizacji', '$Opoznienie','$DataOdbioruLadunku','$IdPracownika');";
	//test
	
	//Proba wykonania polecenia SQL na serwerze bazy danych.
	$wynik= sqlsrv_query($polaczenie, $komendaSql);
	if(($wynik==null)){
		print("<p class='blad'>Zapisanie danych nie powiodlo sie </p>");
		print_r(sqlsrv_errors(), true);
	}
	else{
		print("<p class='sukces'> Dodano zamowienie</p>");
			 print("<p><a href='wykazZamowien.php'>Powrot do wykazu zamowien</a></p>");

		
	} // else (jezeli zostaly zwrocone wiersze)
	


	
	
	
	
	if($polaczenie!=false){
		sqlsrv_close($polaczenie);
	}
	} // else (jezeli polaczenie zostalo nawiazane)
}
print("</div>");}
?>







</body>

</html>
