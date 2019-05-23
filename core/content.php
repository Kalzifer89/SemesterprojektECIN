<?php
///////////////////////////////////////////////
// Semesterproject - ECIN                     //
// Fachbereich Medien FH-Kiel - 4. Semester   //
// Beschreibung : Content                     //
// Ersteller    : Sven Krumbeck              //
// Stand        : 22.05.19                   //
// Version      : 1.0                        //
///////////////////////////////////////////////

//Anzeigen des Einlog Formular wenn der LoginCoockie auf False steht
if ($_COOKIE['LoggedIn'] == "false") {
  //Captcha Zahlen Zerugen
  echo "          <table>\n";
  echo "           <form action=\"index.php\" method=\"POST\">";
  echo "            <tr>\n";
  echo "              <td>".$Fehlermeldung."</td>\n";
  echo "            </tr>\n";
  echo "            <tr>\n";
  echo "              <td>Anmeldename:</td>\n";
  echo "              <td><input type=\"text\" name=\"name\"></td>\n";
  echo "            </tr>\n";
  echo "            <tr>\n";
  echo "              <td>Passwort:</td>\n";
  echo "              <td><input type=\"text\" name=\"passwort\"></td>\n";
  echo "            </tr>\n";
  echo "            <tr>\n";
  echo "              <td>Captcha</td>\n";
  echo "              <td>".$_SESSION['wert1']."+".$_SESSION['wert2']."=?</td>\n";
  echo "            </tr>\n";
  echo "            <tr>\n";
  echo "              <td>Ergebniss eingeben:</td>\n";
  echo "              <td><input type=\"text\" name=\"captcha\" value=\"Eingabe Ergebniss\"></td>\n";
  echo "            </tr>\n";
  echo "            <tr>\n";
  echo "              <td><input type=\"submit\" value=\"Anmelden\"></td>\n";
  echo "            </tr>\n";
  echo "          </form>\n";
  echo "        </table>\n";
}
else if ($_COOKIE['LoggedIn'] == "True") {
  echo "Erfolreich Eingelogt";
}

?>
