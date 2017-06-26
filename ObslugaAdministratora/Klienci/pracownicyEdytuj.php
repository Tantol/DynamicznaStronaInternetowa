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
if(!isset($_SESSION["zalogowany"]) || ($_SESSION["zalogowany"] == false) || !isset($_SESSION["uzytkownik"]))
{
	$_SESSION["zalogowany"] = false;
	
	if (isset($_SESSION["uzytkownik"]))
		unset($_SESSION["uzytkownik"]);

print("<p class='blad'> Funkcja dostepna tylko dla administratorow</p>");
	
		print("<p><a href='../start.php'>Powrot do ekranu glownego</a></p>");

}
else if (($_SESSION["zalogowany"] == true) && ($_SESSION["uzytkownik"] != "")){
	$IdPracownika = $_GET["IdPracownik"];
		
	if ($IdPracownika == "")
		die("<p class='blad'>Nie wybrano pracownika.</p><p><a href='pracownicyTabela.php'>Powrót do listy pracownikow.</a></p>");


require_once "../../polaczenieZBZ.php";

	if ($polaczenie == false)
	{
		print("<p class='blad'>Poł±czenie z serwerem $serwer nie powiodło się.</p>");
		die(print_r(sqlsrv_errors(), true));
	}
		
	$komenda_sql = "SELECT Imie, Nazwisko, NrTelefonu, Email, Stanowisko, IdPracownika, Licencja, Zdjecie 
 FROM dbo.Pracownik WHERE IdPracownika = $IdPracownika;";
	
	$zbior_wierszy = sqlsrv_query($polaczenie, $komenda_sql);
	
	if (sqlsrv_has_rows($zbior_wierszy) == false)
	{
		print("<p class='blad'>Brak danych pracownika <strong>$IdPracownika</strong> w bazie.</p> 
		<p><a href='pracownicyTabela.php'>Powrót do listy pracownikow.</a></p>");
		print_r(sqlsrv_errors(), true);
	}
	else
	{
	$wiersz = sqlsrv_fetch_array($zbior_wierszy, SQLSRV_FETCH_ASSOC);
	
		$Imie = $wiersz["Imie"];
			$Nazwisko = $wiersz["Nazwisko"];
			$NrTelefonu = $wiersz["NrTelefonu"];
			$Email = $wiersz["Email"];
			$Stanowisko = $wiersz["Stanowisko"];
			$IdPracownika = $wiersz["IdPracownika"];
			$Licencja = $wiersz["Licencja"];
			$Zdjecie = $wiersz["Zdjecie"];
	
	print("
	<form id='frmZlecenie' method='GET' action='pracownicyEdytujTak.php'> <h1>Dodawanie pracownika</h1>
    <fieldset>
    <legend>Dane</legend>    
        <p>
            <label for='textImie'>Imię</label>
            <input id='textImie' type='text' name='textImie' maxlength='40' required='required' value='$Imie'/>
        </p>
        <p>
            <label for='textNazwisko'>Nazwisko</label>
            <input id='textNazwisko' type='text' name='textNazwisko' maxlength='40' required='required' value='$Nazwisko'/>
        </p>
		<p>
            <label for='textNrTelefonu'>Nr. telefonu</label>
            <input id='textNrTelefonu' type='text' name='textNrTelefonu' maxlength='14' pattern='[0-9]{2}-[0-9]{3}-[0-9]{3}-[0-9]{3}' title='Wprowadź numer w formacie xxx-xxx-xxx' placeholder='000-000-000' required='required' value='$NrTelefonu'/>
			</p>
		<p>
            <label for='textEmail'>Email</label>
            <input id='textEmail' type='text' name='textEmail' maxlength='40' required='required' value='$Email' />
        </p>
		<p>
            <label for='textStanowisko'>Stanowisko</label>
            <input id='textStanowisko' type='text' name='textStanowisko' maxlength='40' required='required' value='$Stanowisko' />
        </p>
		<p>
            <label for='textIdPracownika'>IdPracownika</label>
            <input id='textIdPracownika' type='text' name='textIdPracownika' maxlength='40' required='required' value='$IdPracownika' />
        </p>
		<p>
            <label for='textLicencja'>Licencja</label>
            <input id='textLicencja' type='text' name='textLicencja' maxlength='40' required='required' value='$Licencja' />
        </p>
		<p>
					<label for='filZdjecie'>Zdjęcie (opcjonalnie)</label>
					<input id='filZdjecie' type='file' name='filZdjecie' value=$Zdjecie/>
				</p>

      
        

     

         


        
        <p>
            <input class='przycisk' type='submit'/>
            <input class='przycisk' type='reset'/>
        </p>
        </fieldset>
    
    
    </form>");
	print("<p> <br /><a href='pracownicyTabela.php'>Powrót do listy pracownikow.</a></p>");
	
	// Zwolnienie zasobów - wyniku zapytania.
	sqlsrv_free_stmt($zbior_wierszy);

	// Zamknięcie poł±czenia z serwerem.
	if ($polaczenie != false)
		sqlsrv_close($polaczenie);
	} // else		
}	
?>

</body>
</html>