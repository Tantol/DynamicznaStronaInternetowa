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
if (($_SESSION["zalogowany"] == true) && ($_SESSION["uzytkownik"] != "")&&  ($_SESSION["Klient"] == true)){

if(!isset($_GET["txtOdlegloscKM"]) || ($_GET["txtOdlegloscKM"]== "") || !isset($_GET["txtCena"]) || ($_GET["txtCena"]== "")
|| !isset($_GET["txtDataOdbioruLadunku"]) || ($_GET["txtDataOdbioruLadunku"]== "") || !isset($_GET["txtTreminRealizacji"]) || ($_GET["txtTreminRealizacji"]== "")){
	print("<p class='blad'> Nie mozna zapisac danych</p>");
	print("<p><a href='pracownicyTabela.php'> Powrot do wykazu.</a></p>");
}
else{

//Pobieranie danych wyslanych z form.
			$OdlegloscKM = $_GET["txtOdlegloscKM"];
			$Cena = $_GET["txtCena"];
			$DataOdbioruLadunku = $_GET["txtDataOdbioruLadunku"];
			$TerminRealizacji = $_GET["txtTreminRealizacji"];
			$IdKlienta=$_SESSION["KlientId"];

			
			
	

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
	('$IdKlienta', '$OdlegloscKM', '$Cena', NULL, getdate(), NULL, '$TerminRealizacji', NULL,'$DataOdbioruLadunku',11);";
	//test
	//Proba wykonania polecenia SQL na serwerze bazy danych.
	$wynik= sqlsrv_query($polaczenie, $komendaSql);
	if(($wynik==null)){
		print("<p class='blad'>Zapisanie danych nie powiodlo sie </p>");
		print_r(sqlsrv_errors(), true);
	}
	else{
		print("<p class='sukces'> Wstepne zamowienie zostalo przeslane,</p> <p class='sukces'> w celu dokonczenia zamowienia zapraszamy do Salonu Obslugi Klientow przy ul. ...");
			 print("<p><a href='wykaz.php'>Powrot do obecnych zamowien</a></p>");

		
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
