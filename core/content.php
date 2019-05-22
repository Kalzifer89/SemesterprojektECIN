<?php
///////////////////////////////////////////////
// Semesterproject - ECIN                     //
// Fachbereich Medien FH-Kiel - 4. Semester   //
// Beschreibung : Content                     //
// Ersteller    : Sven Krumbeck              //
// Stand        : 22.05.19                   //
// Version      : 1.0                        //
///////////////////////////////////////////////


if ($_COOKIE['LoggedIn'] == "false") {
  echo "          <table>\n";
  echo "           <form action=\"index.php\" method=\"POST\">";
  echo "            <tr>\n";
  echo "              <td>".$Fehlermeldung."</td>\n";
  echo "            </tr>\n";
  echo "              <td>Anmeldename:</td>\n";
  echo "              <td><input type=\"text\" name=\"name\"></td>\n";
  echo "            </tr>\n";
  echo "            <tr>\n";
  echo "              <td>Passwort:</td>\n";
  echo "              <td><input type=\"text\" name=\"passwort\"></td>\n";
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
