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
if(!isset($_GET["txtLogin"]) || ($_GET["txtLogin"]== "") || !isset($_GET["passHaslo"]) || ($_GET["passHaslo"]== "")
|| !isset($_GET["txtImie"]) || ($_GET["txtImie"]== "") 
|| !isset($_GET["txtUlica"]) || ($_GET["txtUlica"]== "")
|| !isset($_GET["txtMiejscowosc"]) || ($_GET["txtMiejscowosc"]== "")
|| !isset($_GET["txtNrDomu"]) || ($_GET["txtNrDomu"]== "")
|| !isset($_GET["txtKodPocztowy"]) || ($_GET["txtKodPocztowy"]== "")
|| !isset($_GET["txtNrTelefonu"]) || ($_GET["txtNrTelefonu"]== "")){

	print("<p class='blad'>Nie poprawnie wypelniony formularz rejestracyjny</p>");
	print("<p><a href='zarejestruj.php'> Powrot do rejestracji</a></p>");
}
else{

//Pobieranie danych wyslanych z form.
	
			$Login = $_GET["txtLogin"];
			$Haslo = $_GET['passHaslo'];
			$Imie = $_GET["txtImie"];
			$Ulica = $_GET["txtUlica"];
			$Miejscowosc = $_GET["txtMiejscowosc"];
			$NrDomu = $_GET["txtNrDomu"];
			$KodPocztowy = $_GET["txtKodPocztowy"];
			$NrTelefonu = $_GET["txtNrTelefonu"];
			
			$NrBudynku = $_GET["txtNrBudynku"];
			$Poczta = $_GET["txtPoczta"];
			$Email = $_GET["txtEmail"];
			$Pesel = $_GET["txtPesel"];
			$Nip = $_GET["txtNip"];
			$Regon = $_GET["txtRegon"];
			$Fax = $_GET["txtFax"];

			
			
	

require_once "polaczenieZBZ.php";


if($polaczenie == false){
	print("<p class='blad'>Polaczenie z serwerem <strong>$serwer</strong> NIE powiodlo sie.</p>");
	print_r(sqlsrv_errors(), true);
}
else{
	
	
	$komendaSql= "INSERT dbo.Klient (Imie, Ulica, Miejscowosc, NrDomu, NrBudynku, KodPocztowy, Poczta, NrTelefonu, Email, Pesel, Nip, Regon, Fax) 
	VALUES
				  ('$Imie','$Ulica', '$Miejscowosc', '$NrDomu', '$NrBudynku', '$KodPocztowy', '$Poczta', '$NrTelefonu', '$Email',$Pesel,'$Nip','$Regon','$Fax');";
	if(!isset($_GET["txtPesel"]) || ($_GET["txtPesel"]== "")){
		$komendaSql= "INSERT dbo.Klient (Imie, Ulica, Miejscowosc, NrDomu, NrBudynku, KodPocztowy, Poczta, NrTelefonu, Email, Pesel, Nip, Regon, Fax) 
	VALUES
				  ('$Imie','$Ulica', '$Miejscowosc', '$NrDomu', '$NrBudynku', '$KodPocztowy', '$Poczta', '$NrTelefonu', '$Email','$Pesel','$Nip','$Regon','$Fax');";
	}
	//Polaczenie SQL wybierajace wiersze z tabeli
	
	
	//Proba wykonania polecenia SQL na serwerze bazy danych.
	$wynik= sqlsrv_query($polaczenie, $komendaSql);
	if(($wynik==null)){
		print("<p class='blad'>1Nie poprawnie wypelniony formularz rejestracyjny</p>");
	print("<p><a href='zarejestruj.php'> Powrot do rejestracji</a></p>");
	}
	else{

$komendaSql="SELECT MAX(IdKlient) AS IdKlient FROM dbo.Klient
SELECT IdKlient FROM dbo.Klient ORDER BY IdKlient;";
$wynik= sqlsrv_query($polaczenie, $komendaSql);
if(($wynik==null)){
		print("<p class='blad'>2Nie poprawnie wypelniony formularz rejestracyjny</p>");
	print("<p><a href='zarejestruj.php'> Powrot do rejestracji</a></p>");
	}
else{
	$wiersz = sqlsrv_fetch_array($wynik, SQLSRV_FETCH_ASSOC);
	$IdKlienta = $wiersz["IdKlient"]; 


	$komendaSql="INSERT dbo.Uzytkownik ( Login, Haslo, DataRejestracji, IdKlient, IdPracownik) 
	VALUES
('$Login',lower(convert(varchar(32), hashbytes('MD5', '$Haslo'), 2)), getdate(), '$IdKlienta', NULL);";

	$wynik= sqlsrv_query($polaczenie, $komendaSql);
if(($wynik==null)){
		print("<p class='blad'>3Nie poprawnie wypelniony formularz rejestracyjny</p>");
	print("<p><a href='zarejestruj.php'> Powrot do rejestracji</a></p>");
	}
else{


			print("<p class='sukces'> Rejestracja przebiegla pomyslnie</p>");
	print("<p><a href='start.php'> Powrot do strony glownej</a></p>");}
}
		
	} // else (jezeli zostaly zwrocone wiersze)
	


	
	
	
	
	if($polaczenie!=false){
		sqlsrv_close($polaczenie);
	}
	} // else (jezeli polaczenie zostalo nawiazane)
}

?>







</body>

</html>
