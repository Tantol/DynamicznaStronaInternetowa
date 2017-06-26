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
<div id='blokMenu'>");
require_once "../menu.php";
require_once "../panelAdministratora.php";
print("
</div>");

if (isset($_GET["sortuj"]))
		$kolumna_sort = $_GET["sortuj"];
	else
		$kolumna_sort = "Cena";
		
	if (($kolumna_sort != "IdPracownika") && ($kolumna_sort != "Imie") && ($kolumna_sort != "Nazwisko") && ($kolumna_sort != "Telefon") && ($kolumna_sort != "Stanowisko")&& ($kolumna_sort != "IdPracownika")&& ($kolumna_sort != "Licencja"))
		$kolumna_sort = "Cena";

	if(isset($_GET["IdPracownik"])){
	$IdZamowienie= $_GET["IdPracownik"];}
	


require_once "../polaczenieZBZ.php";


if($polaczenie == false){
	print("<p class='blad'>Polaczenie z serwerem <strong>$serwer</strong> NIE powiodlo sie.</p>");
	print_r(sqlsrv_errors(), true);
}
else{
	print("<div id='element_z_tlem'>");
	
	//Polaczenie SQL wybierajace wiersze z tabeli
	/*$komendaSql= "SELECT Imie, Nazwisko, NrTelefonu, Email, Stanowisko, IdPracownika, Licencja, Zdjecie
FROM dbo.Pracownik 
ORDER BY $kolumna_sort ASC";*/
$komendaSql = "SELECT IdZamowienia, dbo.Klient.IdKlient AS Nr, dbo.Klient.Imie AS ImieKlienta, OdlegloscKM, Cena, Uwagi, DataZlozenia, DataRealizacji, TreminRealizacji, Opoznienie, DataOdbioruLadunku, dbo.Pracownik.Imie AS Spedytor
FROM dbo.Zamowienie
INNER JOIN dbo.Klient
ON dbo.Zamowienie.IdKlient = dbo.Klient.IdKlient
INNER JOIN dbo.Pracownik
ON dbo.Zamowienie.IdSpedytor = dbo.Pracownik.IdPracownika;
";


	//Proba wykonania polecenia SQL na serwerze bazy danych.
	$zbiorWierszy= sqlsrv_query($polaczenie, $komendaSql);
	if(($zbiorWierszy==null)||(sqlsrv_has_rows($zbiorWierszy)== false)){
		print("<p>Brak danych pracownikow w bazie. </p>");
		print_r(sqlsrv_errors(), true);
	}
	else{
		/*$komendaSql= "SELECT Imie, Nazwisko, NrTelefonu, Email, Stanowisko, IdPracownika, Licencja
FROM dbo.Pracownik 
ORDER BY $kolumna_sort ASC";*/

//ORDER BY $kolumna_sort ASC;

	
		print("<h2>Wykaz zamowien </h2>");
print("<p><a href='dodajZamowienie.php'>Dodaj zamowienie</a></p>");
		//Poczatek tabeli: Imie, Nazwisko, NrTelefonu, Email, Stanowisko, IdPracownika, Licencja 
		print("<table>
				<thead>
				 <tr>
				  <td><a href='pracownicyTabela.php?sortuj=Imie'>Nr</a></td>
				  <td><a href='pracownicyTabela.php?sortuj=Nazwisko'>Imie Klienta</a></td>
				  <td><a href='pracownicyTabela.php?sortuj=NrTelefon'>Odleglosc [km]</a></td>
				  <td><a href='pracownicyTabela.php?sortuj=Email'>Cena</a></td>
				  <td><a href='pracownicyTabela.php?sortuj=Stanowisko'>Uwagi</a></td>
			      <td><a href='pracownicyTabela.php?sortuj=IdPracownika'>Data Zlozenia</a></td>
				  <td><a href='pracownicyTabela.php?sortuj=Licencja'>Data Realizacji</a></td>
				  <td><a href='pracownicyTabela.php?sortuj=Licencja'>Tremin Realizacji</a></td>
				  <td><a href='pracownicyTabela.php?sortuj=Licencja'>Opoznienie</a></td>
				  <td><a href='pracownicyTabela.php?sortuj=Licencja'>Data Odbioru Ladunku</a></td>
				  <td><a href='pracownicyTabela.php?sortuj=Licencja'>Spedytor</a></td>
				  <td>Szczegoly</td>
				  <td>Edycja</td>
				  <td>Usun</td>
				 </tr>
				</thead>
			   <tbody>
		");
		//Pentla wyswietlania wierszy z tabeli.
		while($wiersz = sqlsrv_fetch_array($zbiorWierszy, SQLSRV_FETCH_ASSOC)){ // petla przerobienia
			$IdZamowienia = $wiersz["IdZamowienia"];
			$Nr = $wiersz["Nr"];
			$ImieKlienta = $wiersz["ImieKlienta"];
			$OdlegloscKM = $wiersz["OdlegloscKM"];
			if($wiersz["Cena"]==0){
				$Cena = "for u is for free";
			}
			else{
			$Cena = $wiersz["Cena"];}
			$Uwagi = $wiersz["Uwagi"];
			$DataZlozenia = $wiersz["DataZlozenia"]->format('d/m/Y');
			$TreminRealizacji = $wiersz["TreminRealizacji"]->format('d/m/Y');
		
			$DataOdbioruLadunku = $wiersz["DataOdbioruLadunku"]->format('d/m/Y');
			$Spedytor = $wiersz["Spedytor"];
			if($Spedytor == 'Nieprzypisany'){
				$DataRealizacji = NULL;
			$Opoznienie = NULL;
			}
			else{
				$DataRealizacji = $wiersz["DataRealizacji"]->format('d/m/Y');
				$Opoznienie = $wiersz["Opoznienie"]->format('d/m/Y');
			}
			print("<tr>
					<td>$Nr</td>
					<td>$ImieKlienta</td>
					<td>$OdlegloscKM</td>
					<td>$Cena</td>
					<td>$Uwagi</td>
					<td>$DataZlozenia</td>
					<td>$DataRealizacji</td>
					<td>$TreminRealizacji</td>
					<td>$Opoznienie</td>
					<td>$DataOdbioruLadunku</td>
					<td>$Spedytor</td>
					<td><a href='szczegolyZamowien.php?IdPracownik=$IdZamowienia'>Szczegoly</a></td>
					<td><a href='edycjaZamowien.php?IdPracownik=$IdZamowienia'>Edytuj</a></td>
					<td><a href='usuwanieZamowien.php?IdPracownik=$IdZamowienia'>Usun</a></td>
				</tr>");
			
			
		}
		
		//Koniec tablei
		print("</tbody>
			  </table>");
			 sqlsrv_free_stmt($zbiorWierszy);
			 	} // else (jezeli zostaly zwrocone wiersze)
			 
$komendaSql = "SELECT dbo.Ladunek.IdZamowienia, IdLadunek, RodzajLadunku, MasaLadunkuKG, LiczbaSztukLadunku, IdAdresStartowyLadunku, IdAdresDocelowyLadunku, IdKategoria, IdPojazd, IdNaczepa, IdKierowcy, UszkodzeniaWProc, Podliczone
FROM dbo.Ladunek
INNER JOIN dbo.Zamowienie
ON dbo.Ladunek.IdZamowienia = dbo.Zamowienie.IdZamowienia
WHERE  dbo.Ladunek.IdZamowienia = $IdZamowienie;";
$zbiorWierszy= sqlsrv_query($polaczenie, $komendaSql);
	if(($zbiorWierszy==null)||(sqlsrv_has_rows($zbiorWierszy)== false)){
		print("<h2>Brak ladunkow dla wybranego zamowienia </h2>

		");
	print("<p><a href='dodajLadunek.php?IdZamowienie=$IdZamowienie'>Dodaj ladunek</a></p>");
	}
	else{
		/*$komendaSql= "SELECT Imie, Nazwisko, NrTelefonu, Email, Stanowisko, IdPracownika, Licencja
FROM dbo.Pracownik 
ORDER BY $kolumna_sort ASC";*/

//ORDER BY $kolumna_sort ASC;

			 
print("<h2>Wykaz ladunkow dla zamowienia $IdZamowienie </h2>");
		//Poczatek tabeli: Imie, Nazwisko, NrTelefonu, Email, Stanowisko, IdPracownika, Licencja 
		print("<table>
				<thead>
				 <tr>
				  <td><a href='pracownicyTabela.php?sortuj=NrTelefon'>RodzajLadunku</a></td>
				  <td><a href='pracownicyTabela.php?sortuj=Email'>MasaLadunkuKG</a></td>
				  <td><a href='pracownicyTabela.php?sortuj=Stanowisko'>LiczbaSztukLadunku</a></td>
				  <td>UszkodzeniaWProc</td>
				  <td>Podliczone</td>
				  <td>Edycja</td>
				  <td>Usun</td>
				 </tr>
				</thead>
			   <tbody>
		");
		//Pentla wyswietlania wierszy z tabeli.
		while($wiersz = sqlsrv_fetch_array($zbiorWierszy, SQLSRV_FETCH_ASSOC)){ // petla przerobienia
			$IdZamowienia = $wiersz["IdZamowienia"];
			$IdLadunku = $wiersz["IdLadunek"];
			$RodzajLadunku = $wiersz["RodzajLadunku"];
			$MasaLadunkuKG = $wiersz["MasaLadunkuKG"];
			$LiczbaSztukLadunku = $wiersz["LiczbaSztukLadunku"];
			if($LiczbaSztukLadunku =='' || $LiczbaSztukLadunku==0){
				$LiczbaSztukLadunku = 'Brak sztuk, lub ladunek nie jest mozliwy do policzenia';
			}
			$IdAdresStartowyLadunku = $wiersz["IdAdresStartowyLadunku"];
			$IdAdresDocelowyLadunku = $wiersz["IdAdresDocelowyLadunku"];

			$IdKategoria = $wiersz["IdKategoria"];
			$IdPojazd = $wiersz["IdPojazd"];
			$IdNaczepa = $wiersz["IdNaczepa"];
			$IdKierowcy = $wiersz["IdKierowcy"];
			$UszkodzeniaWProc = $wiersz["UszkodzeniaWProc"];
			if($UszkodzeniaWProc == ''){
				$UszkodzeniaWProc = '0';
			}
			$Podliczone = $wiersz["Podliczone"];
			if($Podliczone == 0){
				$Podliczone='Nie podliczone';
			}
			else{
				$Podliczone='Podliczone';
			}
			print("<tr>
					<td>$RodzajLadunku</td>
					<td>$MasaLadunkuKG</td>
					<td>$LiczbaSztukLadunku</td>
					<td>$UszkodzeniaWProc</td>
					<td>$Podliczone</td>
					<td><a href='edycjaLadunkow.php?IdPracownik=$IdLadunku'>Edytuj</a></td>
					<td><a href='usuwanieLadunkow.php?IdPracownika=$IdLadunku'>Usun</a></td>
				</tr>");
			$LiczbaSztukLadunku = $wiersz["LiczbaSztukLadunku"];
			$UszkodzeniaWProc = $wiersz["UszkodzeniaWProc"];
			$Podliczone = $wiersz["Podliczone"];

		}
		//Koniec tablei
		print("</tbody>
			  </table>");
			  		print("<a href='dodajLadunek.php?IdZamowienie=$IdZamowienie'>Dodaj ladunek</a>");
			

		
	} // else (jezeli zostaly zwrocone wiersze)
	sqlsrv_free_stmt($zbiorWierszy);
	if($polaczenie!=false){
		sqlsrv_close($polaczenie);
	}
	} // else (jezeli polaczenie zostalo nawiazane)
print("</div>");}
	?>




    
    
</body>

</html>
