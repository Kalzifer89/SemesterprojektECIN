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
  $_SESSION['ergebnis'] = $_SESSION['wert1'] + $_SESSION['wert2'];
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
  echo "              <td><input type=\"password\" name=\"passwort\"></td>\n";
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
  echo "<form method=\"post\" class=\"register\" action=\"index.php\">\n";
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

//Funktion um den Schwerikeitsgrad auszuwählen
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

//Funktion für das Quit auf Mittelerem Schwerikeitsgrad
function quizmittel ()
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

//funktion für das Quiz auf Leicht
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
                      //Zufällig bestimmen ob die Richtige Antwort als erstes oder als Letztes Kommt.
                      $zufall = rand(0, 1);
                      if ($zufall == 1)
                      {
                        echo "       <td><button type=\"submit\" name=\"answer\" value=\"".$zeile['questionAnswerRight']."\">".$zeile['questionAnswerRight']."</button></td>\n";
                      }
                      //ÜBerprüfung damit die Richtige Antwort nicht zufällig 2 mal ausgegeben wird.
                      if ($zeile['questionAnswer1'] == $zeile['questionAnswerRight']) {
                        echo "      <td><button type=\"submit\" name=\"answer\" value=\"".$zeile['questionAnswer2']."\">".$zeile['questionAnswer2']."</button></td>\n";
                      }
                      elseif ($zeile['questionAnswer2'] == $zeile['questionAnswerRight']) {
                        echo "      <td><button type=\"submit\" name=\"answer\" value=\"".$zeile['questionAnswer3']."\">".$zeile['questionAnswer3']."</button></td>\n";
                      }
                      elseif ($zeile['questionAnswer3'] == $zeile['questionAnswerRight']) {
                        echo "      <td><button type=\"submit\" name=\"answer\" value=\"".$zeile['questionAnswer4']."\">".$zeile['questionAnswer4']."</button></td>\n";
                      }
                      elseif ($zeile['questionAnswer4'] == $zeile['questionAnswerRight']) {
                        echo "      <td><button type=\"submit\" name=\"answer\" value=\"".$zeile['questionAnswer1']."\">".$zeile['questionAnswer1']."</button></td>\n";
                      }
                      //Zufällig bestimmen ob die Richtige Antwort als erstes oder als Letztes Kommt.
                      if ($zufall == 0)
                      {
                        echo "     <td><button type=\"submit\" name=\"answer\" value=\"".$zeile['questionAnswerRight']."\">".$zeile['questionAnswerRight']."</button></td>\n";
                      }
                      echo "      <input type=\"hidden\" name=\"rightanswer\" value=\"".$zeile['questionAnswerRight']."\">";

                  }
                echo "    </tr>\n";
                echo "  </table>\n";
                echo "</form>";
             }
}

//Funktion für das Quiz auf Schwer
function quizschwer ()
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
          echo "      <td><input type=\"text\" name=\"answer\"></td>\n";
          echo "      <input type=\"hidden\" name=\"rightanswer\" value=\"".$zeile['questionAnswerRight']."\">";
          echo "      <td><button type=\"submit\">Absenden</button></td>\n";
                  }
             }
          echo "    </tr>\n";
          echo "  </table>\n";
          echo "</form>";
}

//Funktion für den Nächste Frage Button
function nextQuestion() {
  echo "<form class=\"nextQuestion\" action=\"index.php\" method=\"post\">\n";
  echo "  <button type=\"submit\" name=\"nextQuestion\">Nächste Frage</button>\n";
  echo "</form>";

}

//Funktion für eine Zufällige Frage
function randomQuestion() {
  global $Category;
  global $DatenbankAbfrageUser;
  global $FragenArray;
  global $db_link;
  //Datenbank Abfrage nach Fragen aus der Kategorie und Zufällig eine Frage auswählen
  $DatenbankAbfrageFragen= "SELECT * FROM questions WHERE questionCategory = '$Category' ORDER BY RAND() LIMIT 0,1";
  $FragenArray = mysqli_query ($db_link, $DatenbankAbfrageFragen);
}

//Funktion zum Erhöhen der Punktezahl für einen User
function scoreup($user, $score) {
  global $db_link;
  $DatenbankÄnderungPunkte = "UPDATE score SET score = score + $score, questionsRight = questionsRight + 1 WHERE userID = $user";
  $ÄnderungPunkte = mysqli_query ($db_link, $DatenbankÄnderungPunkte );
}

//Funktionen um die Falschen Antworten zu speichern
function wrongAnswer($user) {
  global $db_link;
  $DatenbankÄnderungFrageFalsch = "UPDATE score SET questionsWrong = questionsWrong + 1 WHERE userID = $user";
  $ÄnderungPunkte = mysqli_query ($db_link, $DatenbankÄnderungFrageFalsch );
}
?>
