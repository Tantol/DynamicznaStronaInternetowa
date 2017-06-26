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

if(!isset($_GET["textRodzajLadunku"]) || ($_GET["textRodzajLadunku"]== "")
|| !isset($_GET["textIdAdresStartowyLadunku"]) || ($_GET["textIdAdresStartowyLadunku"]== "") 
|| !isset($_GET["textIdAdresDocelowyLadunku"]) || ($_GET["textIdAdresDocelowyLadunku"]== "")
|| !isset($_GET["textIdKategoria"]) || ($_GET["textIdKategoria"]== "")
|| !isset($_GET["textIdPojazd"]) || ($_GET["textIdPojazd"]== "")
|| !isset($_GET["textIdNaczepa"]) || ($_GET["textIdNaczepa"]== "")
|| !isset($_GET["textIdKierowcy"]) || ($_GET["textIdKierowcy"]== "")
|| !isset($_GET["textIdKierowcy"]) || ($_GET["textIdKierowcy"]== "")
|| !isset($_GET["IdZamowienia"]) || ($_GET["IdZamowienia"]== "")){
	print("<p class='blad'> Nie mozna zapisac danych</p>");
	print("<p><a href='pracownicyTabela.php'> Powrot do wykazu.</a></p>");
}
else{
	print("<div id='element_z_tlem'>
	<p class='sukces'> Dodano</p>");
	print("<p><a href='wykazZamowien.php'> Powrot do wykazu.</a></p>");

//Pobieranie danych wyslanych z form.
	
			$IdZamowienia = $_GET['IdZamowienia'];
			$RodzajLadunku = $_GET["textRodzajLadunku"];
			$MasaLadunkuKG = $_GET["textMasaLadunkuKG"];
			$LiczbaSztukLadunku = $_GET["textLiczbaSztukLadunku"];
			$IdAdresStartowyLadunku = $_GET["textIdAdresStartowyLadunku"];
			$IdAdresDocelowyLadunku = $_GET["textIdAdresDocelowyLadunku"];
			$IdKategoria = $_GET["textIdKategoria"];
			$IdPojazd = $_GET["textIdPojazd"];
			$IdNaczepa = $_GET["textIdNaczepa"];
			$IdKierowcy = $_GET["textIdKierowcy"];
			$UszkodzeniaWProc = $_GET["textUszkodzeniaWProc"];
			$Podliczone = $_GET["textPodliczone"];

			
			
	

require_once "../polaczenieZBZ.php";


if($polaczenie == false){
	print("<p class='blad'>Polaczenie z serwerem <strong>$serwer</strong> NIE powiodlo sie.</p>");
	print_r(sqlsrv_errors(), true);
}
else{
	
	
	
	print("<p class='sukces'>Polaczenie z serwerem <strong>$serwer</strong> powiodlo sie.</p>");
	
	//Polaczenie SQL wybierajace wiersze z tabeli
	$komendaSql= "INSERT dbo.Ladunek (IdZamowienia, RodzajLadunku, MasaLadunkuKG, LiczbaSztukLadunku, IdAdresStartowyLadunku, IdAdresDocelowyLadunku, IdKategoria, IdPojazd, IdNaczepa, IdKierowcy, UszkodzeniaWProc, Podliczone) 
	VALUES
	('$IdZamowienia', '$RodzajLadunku', $MasaLadunkuKG, '$LiczbaSztukLadunku', '$IdAdresStartowyLadunku', '$IdAdresDocelowyLadunku', '$IdKategoria', '$IdPojazd','$IdNaczepa','$IdKierowcy','$UszkodzeniaWProc','$Podliczone');";
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
print("</div>");}
?>







</body>

</html>
