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


print("
<div id='element_z_tlem'>
<div id='blokMenu'>");
require_once "../menu.php";
require_once "../panelAdministratora.php";
print("
</div>");

require_once "../polaczenieZBZ.php";


if($polaczenie == false){
	print("<p class='blad'>Polaczenie z serwerem <strong>$serwer</strong> NIE powiodlo sie.</p>");
	print_r(sqlsrv_errors(), true);
}
else{
	print("
<div id='blokGlowny'>
<form id='frmZlecenie' method='GET' action='dodajZamowieniePotwierdzenie.php'> <h1>Dodawanie zamowienia</h1>
    <fieldset>
    <legend>Dane</legend>   

");
				print("
		<p>Wybierz Klienta z listy
		<select value ='wybierz' id='select' name='wybierz'>
  <option value='0'>wybierz...</option>
			
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
			<option value='$Idd' name='$Idd'>$Dane</option>	
		");
     
		}
         

print("
	</select>
        <p>
            <label for='textOdleglosc'>Odleglosc [km]</label>
            <input id='textOdleglosc' type='text' name='textOdleglosc' maxlength='40' required='required' />
        </p>
		<p>
            <label for='textCena'>Cena</label>
            <input id='textCena' type='text' name='textCena' maxlength='14' required='required'/>
			</p>
		<p>
            <label for='textDataZlozenia'>Data Zlozenia</label>
            <input id='textDataZlozenia' type='text' name='textDataZlozenia' maxlength='40' required='required' />
        </p>
		<p>
            <label for='textDataRealizacji'>Data Realizacji</label>
            <input id='textDataRealizacji' type='text' name='textDataRealizacji' maxlength='40' required='required' />
        </p>
		<p>
            <label for='textTerminRealizacji'>Termin Realizacji</label>
            <input id='textTerminRealizacji' type='text' name='textTerminRealizacji' maxlength='40' required='required' />
        </p>
		<p>
            <label for='textOpoznienie'>Opoznienie</label>
            <input id='textOpoznienie' type='text' name='textOpoznienie' maxlength='40' required='required' />
        </p>
		<p>
            <label for='textDataOdbioruLadunku'>Data Odbioru Ladunku</label>
            <input id='textDataOdbioruLadunku' type='text' name='textDataOdbioruLadunku' maxlength='40' required='required' />
        </p>
");
				print("
		<p>Wybierz Spedytora z listy
		<select value ='wybierz2' name=wybierz2 id='select'>
  <option value='0' name='0'>wybierz...</option>
			
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
			<option value='$Idd' name='$Idd'>$Dane</option>	
		");
     
		}
         

print("
</select>
<p> Uwagi
<textarea name='textUwagi' cols='5' rows='5'></textarea>
</p>
        <p>
            <input class='przycisk' type='submit'/>
            <input class='przycisk' type='reset'/>
        </p>
        </fieldset>
    
    
    </form></div>");

	
	
	
	
	if($polaczenie!=false){
		sqlsrv_close($polaczenie);
	}
	} // else (jezeli polaczenie zostalo nawiazane)
print("</div>");}
	?>




    
    
</body>

</html>
