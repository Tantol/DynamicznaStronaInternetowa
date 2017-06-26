<?php
	session_name("PSIN");
	session_start();
?>

<!DOCTYPE html>
<html lang="pl-PL">

<head>


<link rel="stylesheet" type="text/css" href="style.css"/>
</head>


<body>

<?php

if(!isset($_SESSION["zalogowany"]) || ($_SESSION["zalogowany"] == false) || !isset($_SESSION["uzytkownik"]))
{
	$_SESSION["zalogowany"] = false;
	
	if (isset($_SESSION["uzytkownik"]))
		unset($_SESSION["uzytkownik"]);
		
	print("<p class='blad'> Funkcja dostępna tylko dla użytkowników uwierzytelnionych.</p>");
	
	print("<p><a href='start.php'>Powrot do ekranu logowania</a></p>");
}
else if (($_SESSION["zalogowany"] == true) && ($_SESSION["uzytkownik"] != ""))
{
	session_destroy();
	print("<div id='element_z_tlem'> <p class='sukces'>Wylogowano pomyślnie.</p>");
	print("<p><a href='start.php'>Wroć do strony glownej.</p></div>");
}

?>

</body>

</html> 