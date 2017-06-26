<?php

	session_name("PSIN");
	session_start();
?>
<head>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<?php

// sprawdzenie czy z formularz logowania zostaly wyslane dane: nazwa konta uzytkownika i haslo
print("<div id='element_z_tlem'>");
if(!isset($_POST['txtLogin']) || ($_POST["txtLogin"] == "") || !isset($_POST['pwdLogin']) || ($_POST["pwdLogin"] == ""))
{
	$_SESSION["zalogowany"] = false;
	
	if (isset($_SESSION["uzytkownik"]))
		unset($_SESSION["uzytkownik"]);
		
	print("<p class='blad'> Nieprawidłowa nazwa użytkownika lub hasło.</p>");
	
	print("<p><a href='start.php'>Powrot do ekranu logowania</a></p>");
	

}
else // blok konczy sie przed koncem bloku php
{

// dane serwera baz danych i polaczenia

require_once "polaczenieZBZ.php";

if($polaczenie==false){
	$_SESSION["zalogowany"] = false;
	
	if (isset($_SESSION["uzytkownik"]))
		unset($_SESSION["uzytkownik"]);

	print("<p class='blad'>Polaczenie z serwerem NIE powiodlo sie.</p>");
	print_r(sqlsrv_errors(), true);
}
else{

	
	$konto = $_POST["txtLogin"];
	$haslo = $_POST["pwdLogin"];

	$komendaSql = "SELECT IdUzytkownik,Login, Haslo, DataRejestracji, IdKlient, IdPracownik
	from dbo.Uzytkownik
	where Login = '$konto';";

	// proba wykonania polecenia sql na serwerze baz danych
	$zbior_wierszy = sqlsrv_query($polaczenie, $komendaSql);
	if(($zbior_wierszy == null) || (sqlsrv_has_rows($zbior_wierszy) == false))
	{
		$_SESSION["zalogowany"] = false;
	
		if (isset($_SESSION["uzytkownik"]))
			unset($_SESSION["uzytkownik"]);
		
		print("<p class='blad'> Nieprawidłowa nazwa użytkownika lub hasło.</p>");
	
		print("<p><a href='start.php'>Powrot do ekranu logowania</a></p>");
	
	}
	else{
	// petla wyswietlania wierszy z tabeli
		
		$wiersz = sqlsrv_fetch_array($zbior_wierszy, SQLSRV_FETCH_ASSOC);
		
			$loginBaza = $wiersz["Login"]; 
			$hasloBaza = $wiersz["Haslo"]; 
			$IdKlient = $wiersz["IdKlient"];
			$IdPracownik = $wiersz["IdPracownik"];
			
		// sprawdzenie zgodnosci hasla przechowywanego w bd z  zakodowanym haslem podanym przez uzytkownika.
		
		if(strcmp($hasloBaza, md5($haslo)) == 0)
		{
			$_SESSION["zalogowany"] = true;
			$_SESSION["uzytkownik"] = $konto;
		if(($IdKlient != NULL)&&($IdKlient!=0)&&($IdKlient!="")){
			$_SESSION["Klient"]= true;
			$_SESSION["KlientId"]=$IdKlient;
			$_SESSION["Pracownik"]= false;
		}
		else if(($IdPracownik != NULL)&&($IdPracownik!=0)&&($IdPracownik!="")){
			$_SESSION["Pracownik"]= true;
			$_SESSION["Klient"]= false;
			$_SESSION["PracownikId"]=$IdPracownik;
		}
			
			print("<p class='sukces'>Witaj, Jesteś zalogowany(a)!</p>");
			
			print("<p> <a href='start.php'>Powrot do strony glownej</a></p>");
		}
		else
		{
		
			$_SESSION["zalogowany"] = false;
	
			if (isset($_SESSION["uzytkownik"]))
				unset($_SESSION["uzytkownik"]);
		
			print("<p class='blad'>Nieprawidłowa nazwa użytkownika lub hasło.</p>");
	
			print("<p><a href='start.php'>Powrot do ekranu logowania</a></p>");
		
		}
		sqlsrv_free_stmt($zbior_wierszy);
}
	
	echo "Polaczono";
		
	sqlsrv_close($polaczenie);
} //else (if polaczenie zostalo naowiazane)

}
print("</div>");
?>
