<?php
$serwer = "INF-SQL\SQL3";
$uzytkownik = "B40";
$haslo= "1234";
$baza_danych="B40";
$danePolaczenia = array("Database" => $baza_danych, "UID" =>$uzytkownik, "PWD" => $haslo, "CharacterSet" => "UTF-8");
//$danePolaczenia = array("Database" => $baza_danych, "CharacterSet" => "UTF-8");
//Proba polaczenia z serwerem baz danych.
$polaczenie = sqlsrv_connect($serwer, $danePolaczenia);

?>
