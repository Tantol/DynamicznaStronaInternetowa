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

if (isset($_GET["sortuj"]))
		$kolumna_sort = $_GET["sortuj"];
	else
		$kolumna_sort = "IdPracownika";
		
	if (($kolumna_sort != "IdPracownika") && ($kolumna_sort != "Imie") && ($kolumna_sort != "Nazwisko") && ($kolumna_sort != "Telefon") && ($kolumna_sort != "Stanowisko")&& ($kolumna_sort != "IdPracownika")&& ($kolumna_sort != "Licencja"))
		$kolumna_sort = "IdPracownika";
	


require_once "../../polaczenieZBZ.php";

if($polaczenie == false){
	print("<p class='blad'>Polaczenie z serwerem <strong>$serwer</strong> NIE powiodlo sie.</p>");
	print_r(sqlsrv_errors(), true);
}
else{
	print("<p class='sukces'>Polaczenie z serwerem <strong>$serwer</strong> powiodlo sie.</p>");
	
	//Polaczenie SQL wybierajace wiersze z tabeli
	$komendaSql= "SELECT Imie, Nazwisko, NrTelefonu, Email, Stanowisko, IdPracownika, Licencja, Zdjecie
FROM dbo.Pracownik 
ORDER BY $kolumna_sort ASC";
	//Proba wykonania polecenia SQL na serwerze bazy danych.
	$zbiorWierszy= sqlsrv_query($polaczenie, $komendaSql);
	if(($zbiorWierszy==null)||(sqlsrv_has_rows($zbiorWierszy)== false)){
		print("<p>Brak danych pracownikow w bazie. </p>");
		print_r(sqlsrv_errors(), true);
	}
	else{
		$komendaSql= "SELECT Imie, Nazwisko, NrTelefonu, Email, Stanowisko, IdPracownika, Licencja
FROM dbo.Pracownik 
ORDER BY $kolumna_sort ASC";

	
		print("<h2>Pracownicy </h2>");
		//Poczatek tabeli: Imie, Nazwisko, NrTelefonu, Email, Stanowisko, IdPracownika, Licencja 
		print("<table>
				<thead>
				 <tr>
				 <td>Zdjecie</td>
				  <td><a href='pracownicyTabela.php?sortuj=Imie'>Imie</a></td>
				  <td><a href='pracownicyTabela.php?sortuj=Nazwisko'>Nazwisko</a></td>
				  <td><a href='pracownicyTabela.php?sortuj=NrTelefon'>Telefon</a></td>
				  <td><a href='pracownicyTabela.php?sortuj=Email'>Email</a></td>
				  <td><a href='pracownicyTabela.php?sortuj=Stanowisko'>Stanowisko</a></td>
			      <td><a href='pracownicyTabela.php?sortuj=IdPracownika'>IdPracownika</a></td>
				  <td><a href='pracownicyTabela.php?sortuj=Licencja'>Licencja</a></td>
				  <td></td>
				  <td></td>
				 </tr>
				</thead>
			   <tbody>
		");
		//Pentla wyswietlania wierszy z tabeli.
		while($wiersz = sqlsrv_fetch_array($zbiorWierszy, SQLSRV_FETCH_ASSOC)){ // petla przerobienia
			$Imie = $wiersz["Imie"];
			$Nazwisko = $wiersz["Nazwisko"];
			$NrTelefonu = $wiersz["NrTelefonu"];
			$Email = $wiersz["Email"];
			$Stanowisko = $wiersz["Stanowisko"];
			$IdPracownika = $wiersz["IdPracownika"];
			$Licencja = $wiersz["Licencja"];
			$Zdjecie = $wiersz["Zdjecie"];
			print("<tr>
			<td><a href='image/$Zdjecie'><img src='image/$Zdjecie' alt='$Imie $Nazwisko'/></a></td>
					<td>$Imie</td>
					<td>$Nazwisko</td>
					<td>$NrTelefonu</td>
					<td>$Email</td>
					<td>$Stanowisko</td>
					<td>$IdPracownika</td>
					<td>$Licencja</td>
					<td><a href='pracownicyEdytuj.php?IdPracownik=$IdPracownika'>Edytuj</a></td>
					<td><a href='pracownicyUsun.php?IdPracownik=$IdPracownika'>Usun</a></td>
				</tr>");
			
			
		}
		
		//Koniec tablei
		print("</tbody>
			  </table>");
			 sqlsrv_free_stmt($zbiorWierszy);
	print("
 <form id='frmZlecenie' method='GET' action='pracownicyDodaj.php'> <h1>Dodawanie pracownika</h1>
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
	?>





</body>

</html>
