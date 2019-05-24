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

?>
