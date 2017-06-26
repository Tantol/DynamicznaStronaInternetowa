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
//Sprawdzenie czy wszystkie wartosci pol wymaganych tabeli
//zostalay wyslane z formularza.
if(!isset($_SESSION["zalogowany"]) || ($_SESSION["zalogowany"] == false) || !isset($_SESSION["uzytkownik"]))
{
	$_SESSION["zalogowany"] = false;
	
	if (isset($_SESSION["uzytkownik"]))
		unset($_SESSION["uzytkownik"]);

print("<p class='blad'> Funkcja dostepna tylko dla administratorow</p>");
	
		print("<p><a href='../start.php'>Powrot do ekranu glownego</a></p>");

}
else if (($_SESSION["zalogowany"] == true) && ($_SESSION["uzytkownik"] != "")){
if(!isset($_GET["textImie"]) || ($_GET["textImie"]== "") || !isset($_GET["textNazwisko"]) || ($_GET["textNazwisko"]== "")
|| !isset($_GET["textNrTelefonu"]) || ($_GET["textNrTelefonu"]== "") || !isset($_GET["textEmail"]) || ($_GET["textEmail"]== "")
|| !isset($_GET["textStanowisko"]) || ($_GET["textStanowisko"]== "")
|| !isset($_GET["textIdPracownika"]) || ($_GET["textIdPracownika"]== "")
|| !isset($_GET["textLicencja"]) || ($_GET["textLicencja"]== "")){
	print("<p class='blad'> Nie mozna zapisac danych pracownika w bazie</p>");
	print("<p><a href='pracownicyTabela.php'> Powrot do wykazu pracownikow.</a></p>");
}
else{
	print("<p class='sukces'> Dodano</p>");
	print("<p><a href='pracownicyTabela.php'> Powrot do wykazu pracownikow.</a></p>");

//Pobieranie danych wyslanych z form.
			$Imie = $_GET["textImie"];
			$Nazwisko = $_GET["textNazwisko"];
			$NrTelefonu = $_GET["textNrTelefonu"];
			$Email = $_GET["textEmail"];
			$Stanowisko = $_GET["textStanowisko"];
			$IdPracownika = $_GET["textIdPracownika"];
			$Licencja = $_GET["textLicencja"];
			$Zdjecie = $_GET["filZdjecie"];
			
			
	

require_once "../../polaczenieZBZ.php";

if($polaczenie == false){
	print("<p class='blad'>Polaczenie z serwerem <strong>$serwer</strong> NIE powiodlo sie.</p>");
	print_r(sqlsrv_errors(), true);
}
else{
	
	
	
	print("<p class='sukces'>Polaczenie z serwerem <strong>$serwer</strong> powiodlo sie.</p>");
	
	//Polaczenie SQL wybierajace wiersze z tabeli
	$komendaSql= "INSERT dbo.Pracownik (Imie, Nazwisko, NrTelefonu, Email, Stanowisko, IdPracownika, Licencja, Zdjecie) 
	VALUES
	('$Imie', '$Nazwisko', '$NrTelefonu', '$Email', '$Stanowisko', $IdPracownika, '$Licencja', '$Zdjecie');";
	//test
	print($komendaSql);
	
	//Proba wykonania polecenia SQL na serwerze bazy danych.
	$wynik= sqlsrv_query($polaczenie, $komendaSql);
	if(($wynik==null)){
		print("<p class='blad'>Zapisanie danych pracownika <strong>$Imie $Nazwisko </strong> nie powiodlo sie </p>");
		print_r(sqlsrv_errors(), true);
	}
	else{
		print("<p class='sukces'> Dane pracownika zostaly zapisane</p>");
			 sqlsrv_free_stmt($wynik);
	print(" <form id='frmZlecenie' method='GET' action='pracownicyDodaj.php'> <h1>Dodawanie pracownika</h1>
    <fieldset>
    <legend>Dane</legend>    
        <p>
            <label for='textImie'>Imię</label>
            <input id='textImie' type='text' name='textImie' maxlength='40' required='required'/>
        </p>
        <p>
            <label for='textNazwisko'>Nazwisko</label>
            <input id='textNazwisko' type='text' name='textNazwisko' maxlength='40' required='required' />
        </p>
		<p>
            <label for='textNrTelefonu'>Nr. telefonu</label>
            <input id='textNrTelefonu' type='text' name='textNrTelefonu' maxlength='14' pattern='[0-9]{2}-[0-9]{3}-[0-9]{3}-[0-9]{3}' title='Wprowadź numer w formacie xxx-xxx-xxx' placeholder='000-000-000' required='required'/>
			</p>
		<p>
            <label for='textEmail'>Email</label>
            <input id='textEmail' type='text' name='textEmail' maxlength='40' required='required' />
        </p>
		<p>
            <label for='textStanowisko'>Stanowisko</label>
            <input id='textStanowisko' type='text' name='textStanowisko' maxlength='40' required='required' />
        </p>
		<p>
            <label for='textIdPracownika'>IdPracownika</label>
            <input id='textIdPracownika' type='text' name='textIdPracownika' maxlength='40' required='required' />
        </p>
		<p>
            <label for='textLicencja'>Licencja</label>
            <input id='textLicencja' type='text' name='textLicencja' maxlength='40' required='required' />
        </p>
		<p>
					<label for='filZdjecie'>Zdjęcie (opcjonalnie)</label>
					<input id='filZdjecie' type='file' name='filZdjecie'/>
				</p>

	
      
        

     

        </fieldset>
         


        
        <p>
            <input class='przycisk' type='submit'/>
            <input class='przycisk' type='reset'/>
        </p>
        </fieldset>
    
    
    </form>");

		
	} // else (jezeli zostaly zwrocone wiersze)
	


	
	
	
	
	if($polaczenie!=false){
		sqlsrv_close($polaczenie);
	}
	} // else (jezeli polaczenie zostalo nawiazane)
}
}
?>







    
</body>

</html>
