<?php
///////////////////////////////////////////////
// Semesterproject - ECIN                     //
// Fachbereich Medien FH-Kiel - 4. Semester  //
// Beschreibung : Funktionen                 //
// Ersteller    : Sven Krumbeck              //
// Stand        : 23.05.19                   //
// Version      : 1.0                        //
///////////////////////////////////////////////

//Funktion zum Ständig neuen Zerugen von Captcha Zahlen
function anzeige()
{
  // zwei zufällige Zahlen ermitteln -------
  $_SESSION['wert1'] = rand(0,10);
  $_SESSION['wert2'] = rand(0,10);
  // Berechnung des Ergebnisses ------------
  $_SESSION['ergebnis'] = $_SESSION['wert1']
  + $_SESSION['wert2'];
}

//Funktion zum Erzeugen eines Captcha Bildes
function captcha ()
{
  $bild = imagecreate(175, 25);
  $hg = imagecolorallocate ($bild,255,255,255);
  $vg = imagecolorallocate ($bild,0,0,0);
  imagefill($bild,0,0,$hg);
  $Bildtext = $_SESSION['wert1']."+".$_SESSION['wert2']."=?";
  imagestring($bild,15,0,5,$Bildtext,$vg);
  imagepng($bild, "./img/captcha.png");
}

//Funktion zum Anzeigen des Login Bereiches
function loginArea()
{
  //Ermöglicht es Fehlermeldung Global Anzusprechen
  global $Fehlermeldung;
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
  echo "              <td><img src =\"./img/captcha.png\" alt=\"Captcha\"></td>\n";
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

//Funktion für den Regestrien button
function registerButtion ()
{
  echo "<br>Sie haben noch keinen Account? Registrieren sie sich jetzt:<br>";
  echo "<form method=\"post\" action=\"index.php\">\n";
  echo "<button name=\"register\" type=\"submit\">Registrieren</button>\n";
  echo "</form>\n";
}

//Funktion zum Anzeigen des Registrierungsformulars
function registerArea()
{
  include './core/register.php';
  echo "\n";
  echo "<table>\n";
  echo "<form method=\"post\" action=\"index.php\">\n";
  echo "   <tr>\n";
  echo "    <td>".$RegisterFehlermeldung."</td>\n";
  echo "   </tr>\n";
  echo "  <tr>\n";
  echo "    <td>Benutzer Name:</td>\n";
  echo "    <td><input type=\"text\" name=\"registername\"></td>\n";
  echo "  </tr>\n";
  echo "  <tr>\n";
  echo "    <td>Benutzer Email</td>\n";
  echo "    <td><input type=\"text\" name=\"registermail\"></td>\n";
  echo "  </tr>\n";
  echo "  <tr>\n";
  echo "    <td>Passwort:</td>\n";
  echo "    <td><input type=\"password\" name=\"registerpassword\" ></td>\n";
  echo "  </tr>\n";
  echo "  <tr>\n";
  echo "    <td>Captcha</td>\n";
  echo "    <td><img src =\"./img/captcha.png\" alt=\"Captcha\"></td>\n";
  echo "  </tr>\n";
  echo "  <tr>\n";
  echo "    <td>Ergebniss eingeben:</td>\n";
  echo "    <td><input type=\"text\" name=\"captcha\" value=\"Eingabe Ergebniss\"></td>\n";
  echo "  </tr>\n";
  echo "  <tr>\n";
  echo "    <td><input type=\"submit\" name=\"register\"  value=\"Absenden\">\n</td>";
  echo "  </tr>\n";
  echo "</form>\n";
  echo "</table>\n";
}

function schwerikeitsgrad()
{
  echo "Bitte wählen sie einen Schwerikeitsgrad aus: <br>";
  echo "<form class=\"Schwerikeitsgrad\" action=\"index.php\" method=\"post\">\n";
  echo "<table>\n";
  echo "  <tr>\n";
  echo "  <td><button type=\"submit\" name=\"Schwerikeitsgrad\" value=\"leicht\">leicht</button></td>  \n";
  echo "  <td>2 Mögliche Antworten, eine davon richtig. 50% Gewinnchance</td>\n";
  echo "  </tr>\n";
  echo "  <tr>\n";
  echo "  <td><button type=\"submit\" name=\"Schwerikeitsgrad\" value=\"mittel\">mittel</button></td>  \n";
  echo "  <td>4 Mögliche Antworten, eine davon richtig. 25% Gewinnchance</td>\n";
  echo "  </tr>\n";
  echo "  <tr>\n";
  echo "    <td><button type=\"submit\" name=\"Schwerikeitsgrad\" value=\"hoch\">hoch</button></td>\n";
  echo "    <td>Keine vorgegebene Antwort, Freie Texteingabe.</td>\n";
  echo "  </tr>\n";
  echo "</table>  \n";
  echo "</form>";
}

function quizleicht ()
{
  global $FragenArray;
          if (mysqli_num_rows ($FragenArray) > 0)
              {

      // aktuelles Tupel ausgeben --------------------------------------------------
                  while ($zeile = mysqli_fetch_array($FragenArray))
                   {
          echo "<form class=\"question\" action=\"index.php\" method=\"post\">\n";
          echo "  <table>\n";
          echo "    <tr>\n";
          echo "      <td colspan=\"4\">".$zeile['questionContent']."</td>\n";
          echo "    </tr>\n";
          echo "    <tr>\n";
          echo "      <td><button type=\"submit\" name=\"answer\" value=\"".$zeile['questionAnswer1']."\">".$zeile['questionAnswer1']."</button></td>\n";
          echo "      <td><button type=\"submit\" name=\"answer\" value=\"".$zeile['questionAnswer2']."\">".$zeile['questionAnswer2']."</button></td>\n";
          echo "      <td><button type=\"submit\" name=\"answer\" value=\"".$zeile['questionAnswer3']."\">".$zeile['questionAnswer3']."</button></td>\n";
          echo "      <td><button type=\"submit\" name=\"answer\" value=\"".$zeile['questionAnswer4']."\">".$zeile['questionAnswer4']."</button></td>\n";
          echo "      <input type=\"hidden\" name=\"rightanswer\" value=\"".$zeile['questionAnswerRight']."\">";
                  }
             }
          echo "    </tr>\n";
          echo "  </table>\n";
          echo "</form>";
}

function nextQuestion() {
  
}
?>
