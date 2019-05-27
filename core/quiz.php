<?php
///////////////////////////////////////////////
// Semesterproject - ECIN                     //
// Fachbereich Medien FH-Kiel - 4. Semester   //
// Beschreibung : Quiz Logic                  //
// Ersteller    : Sven Krumbeck              //
// Stand        : 27.05.19                   //
// Version      : 1.0                        //
///////////////////////////////////////////////

$Category = 1;

//Wenn Schwerikeitsgrad gewählt, diesen in Cookie speichern
if (isset($_POST['Schwerikeitsgrad']) ) {
            setcookie("Schwerikeitsgrad", $_POST['Schwerikeitsgrad'], 0);
            echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
        }

//Wenn keine Kategorie gewählt ist, um Auswahl der Katgeorie bitten
if(!isset($_COOKIE['category']))
      {
          echo "Bitte wählen sie eine Kategorie in der Linken Sidebar aus um mit dem Spielen zu beginnen";
      }
      //Wenn kein Schwerikeitsgrad geäwhlt ist um Auswahl bitten:
      elseif (!isset($_COOKIE['Schwerikeitsgrad']) ) {
        Schwerikeitsgrad();
      }
      //Wenn beides eingestellt ist, das Quiz start
      else {

        //Datenbank Abfrage nach Fragen
        $DatenbankAbfrageFragen= "SELECT * FROM questions WHERE questionID = 1";
        $FragenArray = mysqli_query ($db_link, $DatenbankAbfrageFragen);


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
                }
           }
        echo "    </tr>\n";
        echo "  </table>\n";

        echo "</form>";
      }


?>
