<?php
///////////////////////////////////////////////
// Semesterproject - ECIN                     //
// Fachbereich Medien FH-Kiel - 4. Semester   //
// Beschreibung : Quiz Logic                  //
// Ersteller    : Sven Krumbeck              //
// Stand        : 27.05.19                   //
// Version      : 1.0                        //
///////////////////////////////////////////////

if (isset($_COOKIE['category'])) {
  //Kategorie in Variable speichern
  $AktuelleKategorie = $_COOKIE['category'];

  //Wenn Aktuelle Kategorie Alle ausgewählt ist, das direkt in Variable schreiben
  if ($_COOKIE['category'] == "alle") {
    $AktuellKategorieName = "alle Kategorien";
  }
  //Ansonsten den Namen aus der Datenbank suchen und Abspeichern.
  else {
    $DatenbankAbfrageAktuelleKategorie = "SELECT categoryName FROM categorys WHERE $AktuelleKategorie = categoryID";
    $KategorieAktuellArray = mysqli_query ($db_link, $DatenbankAbfrageAktuelleKategorie);
    if (mysqli_num_rows ($KategorieAktuellArray) > 0)
        {
    // aktuelles Tupel ausgeben --------------------------------------------------
            while ($zeile = mysqli_fetch_array($KategorieAktuellArray))
             {
               $AktuellKategorieName = $zeile['categoryName'];
             }
        }
  }
}


//Wenn Schwerikeitsgrad gewählt, diesen in Cookie speichern
if (isset($_POST['Schwerikeitsgrad']) ) {
            setcookie("Schwerikeitsgrad", $_POST['Schwerikeitsgrad'], 0);
            echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
        }

//Wenn keine Kategorie gewählt ist, um Auswahl der Katgeorie bitten
if(!isset($_COOKIE['category']))
      {
        echo "<h2>Schwerigkeitsgrad</h2>";
        echo "<hr>";
        echo "<table>\n";
        echo "  <tr>\n";
        echo "    <td colspan=\"2\" class=\"question\">Bitte wählen sie eine Kategorie in der Linken Sidebar aus um mit dem Spielen zu beginnen</td>";
        echo "  </tr>\n";
        echo "</table>\n";
      }
      //Wenn kein Schwerikeitsgrad geäwhlt ist um Auswahl bitten:
      elseif (!isset($_COOKIE['Schwerikeitsgrad']) ) {
        schwerikeitsgrad();
      }
      //Wenn der Nächste Frage Knopf gedrückt wurde
      elseif (isset($_POST['nextQuestion'])) {
        $Category = $_COOKIE['category'];
        randomQuestion();
        switch ($_COOKIE['Schwerikeitsgrad']) {
            case "leicht":
              quizleicht ();
              break;

            case "mittel":
              quizmittel ();
              break;

            case "hoch":
              quizschwer ();
              break;
        }

      }
      //Wenn die Frage beantwortet wurde
      elseif (isset($_POST['answer'])) {
        //wenn die Frage Richtig Beantwortet wurde
        if ($_POST['answer'] == $_POST['rightanswer']) {
          echo "<h2>Antwort</h2>";
          echo "<hr>";
          echo "<form class=\"question\" action=\"index.php\" method=\"post\">\n";
          echo "  <table>\n";
          echo "    <tr>\n";
          echo "      <td colspan=\"4\" class=\"question\">Ihre Antwort <span class=\"green\">".$_POST['answer']." ist richtig</span></td>\n";
          echo "    </tr>\n";
          echo "    <tr>\n";
          echo "      <td><button type=\"submit\" class=\"answer\" name=\"nextQuestion\">Nächste Frage</button></td>\n";
          echo "    </tr>\n";
          echo "</table>";
          echo "</form>";
          //Score UP Funktion erhöht den Punktestand um den Wert der in der Config Datei eingestellt ist
          scoreup($_COOKIE['UserID'], $ScoreMiddle);
        }
        //Wenn die Frage nicht richtig beantwortet wurde
        else {
          echo "<h2>Antwort</h2>";
          echo "<hr>";
          echo "<form class=\"question\" action=\"index.php\" method=\"post\">\n";
          echo "  <table>\n";
          echo "    <tr>\n";
          echo "      <td colspan=\"4\" class=\"question\">Ihre Antwort <span class=\"red\">".$_POST['answer']." ist leider falsch</span>, <span class=\"green\">richtig wäre ".$_POST['rightanswer']."</span> gewesen.</td>\n";
          echo "    </tr>\n";
          echo "    <tr>\n";
          echo "      <td><button type=\"submit\" class=\"answer\" name=\"nextQuestion\">Nächste Frage</button></td>\n";
          echo "    </tr>\n";
          echo "</table>";
          echo "</form>";
          //Falsche Frage in Datenbank speichern
          wrongAnswer($_COOKIE['UserID']);
          //Button für nächste Frage herbeirufen
        }
      }
      //Wenn beides eingestellt ist, das Quiz start
      else {
        //Kategorie als Variable
        $Category = $_COOKIE['category'];
        randomQuestion();
        switch ($_COOKIE['Schwerikeitsgrad']) {
            case "leicht":
              quizleicht ();
              break;
            case "mittel":
              quizmittel ();
              break;
            case "hoch":
              quizschwer ();
              break;
        }
      }


?>
