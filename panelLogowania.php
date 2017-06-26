
	<?php
	print("
    <div id='blokLogowania'>
    <form id='blokLogowania1' method='POST' action='logowanieWeryfikacja.php'> 
	<h1>Panel Logowania</h1>

<p>
            <label for='txtLogin'>Nazwa Uzytkownika
            <input id='txtLogin' type='text' name='txtLogin' maxlength='40' required='required' /></label>
        </p>
<p>
            <label for='passLogin'>Haslo
            <input id='passLogin' type='password' name='pwdLogin' maxlength='20' required='required' /></label>
        </p>

 
<p>
            <input class='przycisk' type='submit' value='Zaloguj'/>
        </p>

    </form> 
<p><a href='zarejestruj.php'>Zarejestruj </a> </p>
</div>
");
?>

    