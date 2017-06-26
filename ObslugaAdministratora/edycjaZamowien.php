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
		
	$komenda_sql = "SELECT dbo.Klient.IdKlient AS Nr, dbo.Klient.Imie AS ImieKlienta, OdlegloscKM, Cena, Uwagi, DataZlozenia, DataRealizacji, TreminRealizacji, Opoznienie, DataOdbioruLadunku, dbo.Pracownik.Imie AS Spedytor
FROM dbo.Zamowienie
INNER JOIN dbo.Klient
ON dbo.Zamowienie.IdKlient = dbo.Klient.IdKlient
INNER JOIN dbo.Pracownik
ON dbo.Zamowienie.IdSpedytor = dbo.Pracownik.IdPracownika
WHERE IdZamowienia = $IdPracownika;
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
			$Nr = $wiersz["Nr"];
			$ImieKlienta = $wiersz["ImieKlienta"];
			$OdlegloscKM = $wiersz["OdlegloscKM"];
			$Cena = $wiersz["Cena"];
			$Uwagi = $wiersz["Uwagi"];
			$DataZlozenia = $wiersz["DataZlozenia"]->format('Y-m-d');
			$TreminRealizacji = $wiersz["TreminRealizacji"]->format('Y-m-d');
			$DataOdbioruLadunku = $wiersz["DataOdbioruLadunku"]->format('Y-m-d');
			$Spedytor = $wiersz["Spedytor"];
			if($Spedytor == 'Nieprzypisany'){
				$DataRealizacji = NULL;
			$Opoznienie = NULL;
			}
			else{
				$DataRealizacji = $wiersz["DataRealizacji"]->format('d/m/Y');
				$Opoznienie = $wiersz["Opoznienie"]->format('d/m/Y');
			}
	
	print("
<form id='frmZlecenie' method='GET' action='edycjaZamowienPotwierdzenie.php'> <h1>Edycja zamowienia</h1>
    <fieldset>
    <legend>Dane</legend>   


            <input id='textIdZamowienia' type='hidden' name='textIdZamowienia' maxlength='40' required='required' value='$IdPracownika' />


");
$komendaSql_Klient2 = "SELECT IdKlient, Imie+' z '+Miejscowosc AS [KlientDane]
FROM dbo.Klient
WHERE IdKlient = $Nr
ORDER BY Imie ASC;
";
$zbiorWierszy_Klient2= sqlsrv_query($polaczenie, $komendaSql_Klient2);
$Dane2='nic';
$wiersz_Klient2 = sqlsrv_fetch_array($zbiorWierszy_Klient2, SQLSRV_FETCH_ASSOC);
$Dane2 = $wiersz_Klient2["KlientDane"];
				print("
		<p>Wybierz Klienta z listy
		<select id='select' name='wybierz'>
  <option value='0'>$Dane2</option>
			
		");
      $komendaSql_Klient = "SELECT IdKlient, Imie+' z '+Miejscowosc AS [KlientDane]
FROM dbo.Klient
ORDER BY Imie ASC;
";
	$zbiorWierszy_Klient= sqlsrv_query($polaczenie, $komendaSql_Klient);
		while($wiersz_Klient = sqlsrv_fetch_array($zbiorWierszy_Klient, SQLSRV_FETCH_ASSOC)){
			$Idd = $wiersz_Klient["IdKlient"];
			$Dane = $wiersz_Klient["KlientDane"];
        print("
			<option value='$Idd' id='$Idd'>$Dane</option>
		");
     
		}
         

print("
	</select>
        <p>
            <label for='textOdleglosc'>Odleglosc [km]</label>
            <input id='textOdleglosc' type='text' name='textOdleglosc' maxlength='40' required='required' value='$OdlegloscKM' />
        </p>
		<p>
            <label for='textCena'>Cena</label>
            <input id='textCena' type='text' name='textCena' maxlength='14' required='required' value='$Cena'/>
			</p>
		<p>
            <label for='textDataZlozenia'>Data Zlozenia</label>
            <input id='textDataZlozenia' type='text' name='textDataZlozenia' maxlength='40' required='required' value='$DataZlozenia'/>
        </p>
		<p>
            <label for='textDataRealizacji'>Data Realizacji</label>
            <input id='textDataRealizacji' type='text' name='textDataRealizacji' maxlength='40' required='required' value='$DataRealizacji' />
        </p>
		<p>
            <label for='textTerminRealizacji'>Termin Realizacji</label>
            <input id='textTerminRealizacji' type='text' name='textTerminRealizacji' maxlength='40' required='required' value='$TreminRealizacji'/>
        </p>
		<p>
            <label for='textOpoznienie'>Opoznienie</label>
            <input id='textOpoznienie' type='text' name='textOpoznienie' maxlength='40' required='required' value='$Opoznienie'/>
        </p>
		<p>
            <label for='textDataOdbioruLadunku'>Data Odbioru Ladunku</label>
            <input id='textDataOdbioruLadunku' type='text' name='textDataOdbioruLadunku' maxlength='40' required='required' value='$DataOdbioruLadunku' />
        </p>
");
$komendaSql_Klient2 = "SELECT IdPracownika, Imie+' '+Nazwisko AS [KlientDane]
FROM dbo.Pracownik
WHERE Imie = '$Spedytor'
ORDER BY Imie ASC;
";
$zbiorWierszy_Klient2= sqlsrv_query($polaczenie, $komendaSql_Klient2);
$wiersz_Klient2 = sqlsrv_fetch_array($zbiorWierszy_Klient2, SQLSRV_FETCH_ASSOC);
$Dane2 = $wiersz_Klient2["KlientDane"];

				print("
		<p>Wybierz Spedytora z listy
		<select  name=wybierz2 id='select2'>
  <option value='0' id='0'>$Dane2</option>
			
		");
      $komendaSql_Klient = "SELECT IdPracownika, Imie+'  '+Nazwisko AS [PracownikDane]
FROM dbo.Pracownik
ORDER BY Imie ASC;
";
	$zbiorWierszy_Klient= sqlsrv_query($polaczenie, $komendaSql_Klient);
		while($wiersz_Klient = sqlsrv_fetch_array($zbiorWierszy_Klient, SQLSRV_FETCH_ASSOC)){
			$Idd = $wiersz_Klient["IdPracownika"];
			$Dane = $wiersz_Klient["PracownikDane"];
        print("
			<option value='$Idd' id='$Idd'>$Dane</option>
		");
     
		}
         

print("
</select>
<p> Uwagi
<textarea name='textUwagi' cols='5' rows='5' >$Uwagi</textarea>
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