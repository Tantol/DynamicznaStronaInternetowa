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
if(!isset($_GET["textIdLadunku"]) || ($_GET["textIdLadunku"]== "") || !isset($_GET["textRodzajLadunku"]) || ($_GET["textRodzajLadunku"]== "")
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
	print("<p><a href='wykazZamowien.php'> Powrot do wykazu zamowien</a></p>");

//Pobieranie danych wyslanych z form.
	
			$IdLadunku = $_GET["textIdLadunku"];
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


	if ($polaczenie == false)
	{
		print("<p class='blad'>Poł±czenie z serwerem $serwer nie powiodło się.</p>");
		die(print_r(sqlsrv_errors(), true));
	}
	
	$komenda_sql = "UPDATE dbo.Ladunek SET IdZamowienia='$IdZamowienia', RodzajLadunku='$RodzajLadunku', MasaLadunkuKG='$MasaLadunkuKG', LiczbaSztukLadunku='$LiczbaSztukLadunku', IdAdresStartowyLadunku='$IdAdresStartowyLadunku', IdAdresDocelowyLadunku='$IdAdresDocelowyLadunku', IdKategoria='$IdKategoria', IdPojazd='$IdPojazd', IdNaczepa='$IdNaczepa', IdKierowcy='$IdKierowcy', UszkodzeniaWProc='$UszkodzeniaWProc', Podliczone='$Podliczone'  WHERE IdLadunek='$IdLadunku';";
	
	$rezultat = sqlsrv_query($polaczenie, $komenda_sql);
	
	$wiersze_zmienione = sqlsrv_rows_affected($rezultat);
	
	if ($rezultat == false)
	{
		print("<p class='blad'>Modyfikacja danych pracownika w bazie nie powiodła się.</p>");
		print_r(sqlsrv_errors(), true);
	}
	else if ($wiersze_zmienione == 1)
		print("<p class='sukces'>Zmodyfikowane dan  zostały zapisane w bazie.</p>");
	else if ($wiersze_zmienione == 0)
		print("<p>W bazie nie ma pracownka o identyfikatorze .</p>");
		
	print("<p> <br /><a href='pracownicyTabela.php'>Powrót do listy pracownikow.</a></p>");
	
	// Zwolnienie zasobów - wyniku zapytania.
	sqlsrv_free_stmt($rezultat);
}
	// Zamknięcie poł±czenia z serwerem.
	if ($polaczenie != false)
		sqlsrv_close($polaczenie);

print("</div>");}
?>

</body>
</html>
