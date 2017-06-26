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

print("<div id='element_z_tlem'>
<p><a href='wykazZamowien.php'> Powrot do wykazu zamowien </a></p>");

	$IdPracownika = $_GET["IdPracownik"];
		
	if ($IdPracownika == "")
		die("<p class='blad'>Nie wybrano pracownika.</p><p><a href='pracownicyTabela.php'>Powrót do listy pracownikow.</a></p>");

require_once "../polaczenieZBZ.php";


	if ($polaczenie == false)
	{
		print("<p class='blad'>Poł±czenie z serwerem $serwer nie powiodło się.</p>");
		die(print_r(sqlsrv_errors(), true));
	}
		
	$komenda_sql = "SELECT IdLadunek, IdZamowienia, RodzajLadunku, MasaLadunkuKG, LiczbaSztukLadunku, IdAdresStartowyLadunku, IdAdresDocelowyLadunku, IdKategoria, IdPojazd, IdNaczepa, IdKierowcy, UszkodzeniaWProc, Podliczone
FROM dbo.Ladunek
WHERE IdLadunek = $IdPracownika;
";
	
	$zbior_wierszy = sqlsrv_query($polaczenie, $komenda_sql);
	
	if (sqlsrv_has_rows($zbior_wierszy) == false)
	{
		print("<p class='blad'>Brak danych <strong>$IdPracownika</strong> w bazie.</p> 
		<p><a href='pracownicyTabela.php'>Powrót do listy.</a></p>");
		print_r(sqlsrv_errors(), true);
	}
	else
	{
	$wiersz = sqlsrv_fetch_array($zbior_wierszy, SQLSRV_FETCH_ASSOC);
			$IdLadunku = $wiersz["IdLadunek"];
			$IdZamowienia = $wiersz['IdZamowienia'];
			$RodzajLadunku = $wiersz["RodzajLadunku"];
			$MasaLadunkuKG = $wiersz["MasaLadunkuKG"];
			$LiczbaSztukLadunku = $wiersz["LiczbaSztukLadunku"];
			$IdAdresStartowyLadunku = $wiersz["IdAdresStartowyLadunku"];
			$IdAdresDocelowyLadunku = $wiersz["IdAdresDocelowyLadunku"];
			$IdKategoria = $wiersz["IdKategoria"];
			$IdPojazd = $wiersz["IdPojazd"];
			$IdNaczepa = $wiersz["IdNaczepa"];
			$IdKierowcy = $wiersz["IdKierowcy"];
			$UszkodzeniaWProc = $wiersz["UszkodzeniaWProc"];
			$Podliczone = $wiersz["Podliczone"];
	
	 print("
<form id='frmLadunek' method='GET' action='edycjaLadunkowPotwierdzenie.php'> <h1>Dodawanie ladunku</h1>
    <fieldset>
    <legend>Dane Ladunku</legend>   
            <input id='textIdLadunku' type='hidden' name='textIdLadunku' maxlength='40' value='$IdLadunku' />

");
        
print("
	</select>
        <p>
            <label for='textRodzajLadunku'>Rodzaj Ladunku</label>
            <input id='textRodzajLadunku' type='text' name='textRodzajLadunku' maxlength='40' required='required' value='$RodzajLadunku' />
        </p>
		<input type='hidden' name='IdZamowienia' value='$IdZamowienia'/>
		<p>
            <label for='textMasaLadunkuKG'>Masa Ladunku w KG</label>
            <input id='textMasaLadunkuKG' type='text' name='textMasaLadunkuKG' maxlength='14' value='$MasaLadunkuKG'/>
			</p>
		<p>
            <label for='textLiczbaSztukLadunku'>Liczba Sztuk Ladunku</label>
            <input id='textLiczbaSztukLadunku' type='text' name='textLiczbaSztukLadunku' maxlength='40' value='$LiczbaSztukLadunku'/>
        </p>
		");
		$komendaSql_Klient2 = "SELECT IdAdresLadunku,Miejscowosc +' ' + Ulica +' ' + KodPocztowy+' ' + NrDomu+'/' + NrBudynku AS [KlientDane]
FROM dbo.AdresLadunku
WHERE IdAdresLadunku = '$IdAdresStartowyLadunku'
ORDER BY Miejscowosc ASC;
";
$zbiorWierszy_Klient2= sqlsrv_query($polaczenie, $komendaSql_Klient2);
$wiersz_Klient2 = sqlsrv_fetch_array($zbiorWierszy_Klient2, SQLSRV_FETCH_ASSOC);
$Dane2 = $wiersz_Klient2["KlientDane"];
$Idd1 = $wiersz_Klient2["IdAdresLadunku"];
				print("
		<p>Wybierz adres startowy
		<select  id='select' name='textIdAdresStartowyLadunku'>
  <option value='$Idd1'>$Dane2</option>
			
		");
      $komendaSql_Klient = "SELECT IdAdresLadunku,Miejscowosc +' ' + Ulica +' ' + KodPocztowy+' ' + NrDomu+'/' + NrBudynku AS [KlientDane]
FROM dbo.AdresLadunku
ORDER BY Miejscowosc ASC;
";
	$zbiorWierszy_Klient= sqlsrv_query($polaczenie, $komendaSql_Klient);
		while($wiersz_Klient = sqlsrv_fetch_array($zbiorWierszy_Klient, SQLSRV_FETCH_ASSOC)){
			if($Idd1==$wiersz_Klient["IdAdresLadunku"]){}
			else{
			$Idd = $wiersz_Klient["IdAdresLadunku"];
			$Dane = $wiersz_Klient["KlientDane"];
        print("
			<option value='$Idd' id='$Idd'>$Dane</option>	
			");}
     
		}
         

print("
</select>
</p>
		");
		$komendaSql_Klient2 = "SELECT IdAdresLadunku,Miejscowosc +' ' + Ulica +' ' + KodPocztowy+' ' + NrDomu+'/' + NrBudynku AS [KlientDane]
FROM dbo.AdresLadunku
WHERE IdAdresLadunku = '$IdAdresDocelowyLadunku'
ORDER BY Miejscowosc ASC;
";
$zbiorWierszy_Klient2= sqlsrv_query($polaczenie, $komendaSql_Klient2);
$wiersz_Klient2 = sqlsrv_fetch_array($zbiorWierszy_Klient2, SQLSRV_FETCH_ASSOC);
$Dane2 = $wiersz_Klient2["KlientDane"];
$Idd1 = $wiersz_Klient2["IdAdresLadunku"];
				print("
		<p>Wybierz adres docelowy
		<select  id='select' name='textIdAdresDocelowyLadunku'>
  <option value='$Idd1'>$Dane2</option>
			
		");
      $komendaSql_Klient = "SELECT IdAdresLadunku,Miejscowosc +' ' + Ulica +' ' + KodPocztowy+' ' + NrDomu+'/' + NrBudynku AS [KlientDane]
FROM dbo.AdresLadunku
ORDER BY Miejscowosc ASC;
";
	$zbiorWierszy_Klient= sqlsrv_query($polaczenie, $komendaSql_Klient);
		while($wiersz_Klient = sqlsrv_fetch_array($zbiorWierszy_Klient, SQLSRV_FETCH_ASSOC)){
			if($Idd1==$wiersz_Klient["IdAdresLadunku"]){}
			else{
			$Idd = $wiersz_Klient["IdAdresLadunku"];
			$Dane = $wiersz_Klient["KlientDane"];
        print("
			<option value='$Idd' id='$Idd'>$Dane</option>	
			");}
     
		}
         

print("
</select>
</p>
		");
		$komendaSql_Klient2 = "SELECT IdKategoria, Kategoria +'/'+ PodKategoria AS [KlientDane]
FROM dbo.Kategoria
WHERE IdKategoria = '$IdKategoria'
ORDER BY Kategoria ASC;
";
$zbiorWierszy_Klient2= sqlsrv_query($polaczenie, $komendaSql_Klient2);
$wiersz_Klient2 = sqlsrv_fetch_array($zbiorWierszy_Klient2, SQLSRV_FETCH_ASSOC);
$Dane2 = $wiersz_Klient2["KlientDane"];
$Idd1 = $wiersz_Klient2["IdKategoria"];
				print("
		<p>Wybierz kategorie
		<select  id='select' name='textIdKategoria'>
  <option value='$Idd1'>$Dane2</option>
			
		");
      $komendaSql_Klient = "SELECT IdKategoria, Kategoria +'/'+ PodKategoria AS [KlientDane]
FROM dbo.Kategoria
ORDER BY Kategoria ASC;
";
	$zbiorWierszy_Klient= sqlsrv_query($polaczenie, $komendaSql_Klient);
		while($wiersz_Klient = sqlsrv_fetch_array($zbiorWierszy_Klient, SQLSRV_FETCH_ASSOC)){
			if($Idd1==$wiersz_Klient["IdKategoria"]){}
			else{
			$Idd = $wiersz_Klient["IdKategoria"];
			$Dane = $wiersz_Klient["KlientDane"];
        print("
			<option value='$Idd' id='$Idd'>$Dane</option>	
			");}
     
		}
         

print("
</select>
</p>
		");
		$komendaSql_Klient2 = "SELECT IdPojazdu, NazwaPojazdu +'-'+ NrRejestracyjny +'-'+MarkaPojazdu +'-'+ Model AS [KlientDane]
FROM dbo.Pojazd
WHERE IdPojazdu = '$IdPojazd'
ORDER BY NazwaPojazdu ASC;
";
$zbiorWierszy_Klient2= sqlsrv_query($polaczenie, $komendaSql_Klient2);
$wiersz_Klient2 = sqlsrv_fetch_array($zbiorWierszy_Klient2, SQLSRV_FETCH_ASSOC);
$Dane2 = $wiersz_Klient2["KlientDane"];
$Idd1 = $wiersz_Klient2["IdPojazdu"];
				print("
		<p>Wybierz pojazd
		<select  id='select' name='textIdPojazd'>
  <option value='$Idd1'>$Dane2</option>
			
		");
      $komendaSql_Klient = "SELECT IdPojazdu, NazwaPojazdu +'-'+ NrRejestracyjny +'-'+MarkaPojazdu +'-'+ Model AS [KlientDane]
FROM dbo.Pojazd
ORDER BY NazwaPojazdu ASC;
";
	$zbiorWierszy_Klient= sqlsrv_query($polaczenie, $komendaSql_Klient);
		while($wiersz_Klient = sqlsrv_fetch_array($zbiorWierszy_Klient, SQLSRV_FETCH_ASSOC)){
			if($Idd1==$wiersz_Klient["IdPojazdu"]){}
			else{
			$Idd = $wiersz_Klient["IdPojazdu"];
			$Dane = $wiersz_Klient["KlientDane"];
        print("
			<option value='$Idd' id='$Idd'>$Dane</option>	
			");}
     
		}
         

print("
</select>
</p>
		");
		$komendaSql_Klient2 = "SELECT IdNaczepa, NazwaNaczepa+'/'+ RodzajNaczepa AS [KlientDane]
FROM dbo.Naczepa
WHERE IdNaczepa = '$IdNaczepa'
ORDER BY NazwaNaczepa ASC;
";
$zbiorWierszy_Klient2= sqlsrv_query($polaczenie, $komendaSql_Klient2);
$wiersz_Klient2 = sqlsrv_fetch_array($zbiorWierszy_Klient2, SQLSRV_FETCH_ASSOC);
$Dane2 = $wiersz_Klient2["KlientDane"];
$Idd1 = $wiersz_Klient2["IdNaczepa"];
				print("
		<p>Wybierz naczepe
		<select  id='select' name='textIdNaczepa'>
  <option value='$Idd1'>$Dane2</option>
			
		");
      $komendaSql_Klient = "SELECT IdNaczepa, NazwaNaczepa+'/'+ RodzajNaczepa AS [KlientDane]
FROM dbo.Naczepa
ORDER BY NazwaNaczepa ASC;
";
	$zbiorWierszy_Klient= sqlsrv_query($polaczenie, $komendaSql_Klient);
		while($wiersz_Klient = sqlsrv_fetch_array($zbiorWierszy_Klient, SQLSRV_FETCH_ASSOC)){
			if($Idd1==$wiersz_Klient["IdNaczepa"]){}
			else{
			$Idd = $wiersz_Klient["IdNaczepa"];
			$Dane = $wiersz_Klient["KlientDane"];
        print("
			<option value='$Idd' id='$Idd'>$Dane</option>	
			");}
     
		}
         

print("
</select>
</p>

		");
			$komendaSql_Klient2 = "SELECT IdPracownika,Imie +' '+Nazwisko+'-'+ Licencja AS [KlientDane]
FROM dbo.Pracownik
WHERE IdPracownika = '$IdKierowcy'
ORDER BY Imie ASC;
";
$zbiorWierszy_Klient2= sqlsrv_query($polaczenie, $komendaSql_Klient2);
$wiersz_Klient2 = sqlsrv_fetch_array($zbiorWierszy_Klient2, SQLSRV_FETCH_ASSOC);
$Dane2 = $wiersz_Klient2["KlientDane"];
$Idd1 = $wiersz_Klient2["IdPracownika"];
				print("
		<p>Wybierz kierowce
		<select  id='select' name='textIdKierowcy'>
  <option value='$Idd1'>$Dane2</option>
			
		");
      $komendaSql_Klient = "SELECT IdPracownika,Imie +' '+Nazwisko+'-'+ Licencja AS [KlientDane]
FROM dbo.Pracownik
ORDER BY Imie ASC;
";
	$zbiorWierszy_Klient= sqlsrv_query($polaczenie, $komendaSql_Klient);
		while($wiersz_Klient = sqlsrv_fetch_array($zbiorWierszy_Klient, SQLSRV_FETCH_ASSOC)){
			if($Idd1==$wiersz_Klient["IdPracownika"]){}
			else{
			$Idd = $wiersz_Klient["IdPracownika"];
			$Dane = $wiersz_Klient["KlientDane"];
        print("
			<option value='$Idd' id='$Idd'>$Dane</option>	
			");}
     
		}
         

print("
</select>
</p>
		<p>
            <label for='textUszkodzeniaWProc'>Uszkodzenia W Proc</label>
            <input id='textUszkodzeniaWProc' type='text' name='textUszkodzeniaWProc' maxlength='40' value='$UszkodzeniaWProc' />
        </p>
		<p>
            <label for='textPodliczone'>Podliczone</label>
            <input id='textPodliczone' type='text' name='textPodliczone' maxlength='40' value='$Podliczone'/>
        </p>

		

        <p>
            <input class='przycisk' type='submit'/>
            <input class='przycisk' type='reset'/>
        </p>
        </fieldset>
    
    
    </form>");
	print("<p><a href='wykazZamowien.php'> Powrot do wykazu zamowien </a></p>");
	
	// Zwolnienie zasobów - wyniku zapytania.
	sqlsrv_free_stmt($zbior_wierszy);

	// Zamknięcie poł±czenia z serwerem.
	if ($polaczenie != false)
		sqlsrv_close($polaczenie);
	} // else	
print("</div>");}		
?>

</body>
</html>