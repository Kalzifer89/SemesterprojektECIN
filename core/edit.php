<?php
///////////////////////////////////////////////
// Semesterproject - ECIN                     //
// Fachbereich Medien FH-Kiel - 4. Semester  //
// Beschreibung : Admin Bereich                //
// Ersteller    : Sven Krumbeck              //
// Stand        : 29.05.19                   //
// Version      : 1.0                        //
///////////////////////////////////////////////


//Login Überprüfen Liste nur Anzeigen wenn Eingelogt
if ($_COOKIE['LoggedIn'] == true)
{
  //Wenn das Fragen hinzufügen Formular ausgefüllt wurde
  if (isset($_POST['questionentry'])) {
    //Überprüen ob alle Felder ausgefüllt worden sind, sonsten fehlermeldungen
    if(empty ($_POST['questionCategory']) or empty ($_POST['questionContent']) or empty ($_POST['questionAnswer1']) or empty ($_POST['questionAnswer2']) or empty ($_POST['questionAnswer3']) or empty ($_POST['questionAnswer4']) or empty ($_POST['questionAnswerRight']))
      {
        echo "<h3 class =\"erorr\">Sie haben nicht alle Notwenigen Felder ausgefüllt, es wurde kein Eintrag gespeichert<h3>";
      }
      else {
        //Post an Variablen Übergeben
        $questionCategory = $_POST['questionCategory'];
        $questionContent = $_POST['questionContent'];
        $questionAnswer1 = $_POST['questionAnswer1'];
        $questionAnswer2 = $_POST['questionAnswer2'];
        $questionAnswer3 = $_POST['questionAnswer3'];
        $questionAnswer4 = $_POST['questionAnswer4'];
        $questionAnswerRight = $_POST['questionAnswerRight'];
        //Einträge in Datenbank schreiben
        $DatenbankEintragFrage = "INSERT INTO questions (questionCategory, questionContent, questionAnswer1, questionAnswer2, questionAnswer3, questionAnswer4, questionAnswerRight) VALUES ('$questionCategory','$questionContent', '$questionAnswer1','$questionAnswer2','$questionAnswer3','$questionAnswer4','$questionAnswerRight')";
        $Eintragen = mysqli_query ($db_link, $DatenbankEintragFrage);
        echo "<h3 class=\"sucess\">Eintrag erfolgreich</h3>";
      }
  }

  //Wenn Frage zum Bearbeiten Ausgewählt ist
  if (isset($_POST['bearbeiten'])) {
    //Variable Übernehmen
    $questionID = $_POST['bearbeiten'];
    //Abfrage nach einzelner Frage aus der Datenbank
    $DatenbankAbfrageFragen= "SELECT * FROM questions, categorys WHERE questionCategory = categoryID AND questionID = '$questionID'";
    $FragenArray = mysqli_query ($db_link, $DatenbankAbfrageFragen);

    //Kategorien aus der Datenbank Abfragen
    $DatenbankAbfrageKategorien= "SELECT categoryName, categoryID FROM categorys";
    $KategorieArray = mysqli_query ($db_link, $DatenbankAbfrageKategorien);

    echo "<h1>Frage bearbeiten</h1>\n";
    echo "<form class=\"createquestion\" action=\"admin.php\" method=\"post\">\n";
    echo "  <table>\n";
    echo "    <tr>\n";
    echo "      <td>Fragen ID</td>\n";
    echo "      <td>:</td>\n";
    echo "      <td>Wird Automatisch vergeben</td>\n";
    echo "    </tr>\n";
    echo "    <tr>\n";
    echo "      <td>Fragen Kategorie</td>\n";
    echo "      <td>:</td>\n";
    echo "      <td><select class=\"questionCategory\" name=\"questionCategory\">\n";
    if (mysqli_num_rows ($KategorieArray) > 0)
        {
            // aktuelles Tupel ausgeben --------------------------------------------------
            while ($zeile = mysqli_fetch_array($KategorieArray))
             {
               echo "        <option value=\"".$zeile['categoryID']."\">".$zeile['categoryName']."</option>\n";
             }
        }
    while ($zeile = mysqli_fetch_array($FragenArray))
        {
          echo "      </select></td>\n";
          echo "    </tr>\n";
          echo "    <tr>\n";
          echo "      <td>Frage</td>\n";
          echo "      <td>:</td>\n";
          echo "      <td><textarea rows=\"4\" cols=\"50\" name=\"questionContent\">".$zeile['questionContent']."</textarea></td>\n";
          echo "    </tr>\n";
          echo "    <tr>\n";
          echo "      <td>Antwort 1</td>\n";
          echo "      <td>:</td>\n";
          echo "      <td><input type=\"text\" name=\"questionAnswer1\" value=\"".$zeile['questionAnswer1']."\"></td>\n";
          echo "    </tr>\n";
          echo "    <tr>\n";
          echo "      <td>Antwort 2</td>\n";
          echo "      <td>:</td>\n";
          echo "      <td><input type=\"text\" name=\"questionAnswer2\"value=\"".$zeile['questionAnswer2']."\"></td>\n";
          echo "    </tr>\n";
          echo "    <tr>\n";
          echo "      <td>Antwort 3</td>\n";
          echo "      <td>:</td>\n";
          echo "      <td><input type=\"text\" name=\"questionAnswer3\"value=\"".$zeile['questionAnswer3']."\"></td>\n";
          echo "    </tr>\n";
          echo "    <tr>\n";
          echo "      <td>Antwort 4</td>\n";
          echo "      <td>:</td>\n";
          echo "      <td><input type=\"text\" name=\"questionAnswer4\"value=\"".$zeile['questionAnswer4']."\"></td>\n";
          echo "    </tr>\n";
          echo "    <tr>\n";
          echo "      <td>Richtig Antwort</td>\n";
          echo "      <td>:</td>\n";
          echo "      <td><input type=\"text\" name=\"questionAnswerRight\"value=\"".$zeile['questionAnswerRight']."\"></td>\n";
          echo "    </tr>\n";
          echo "    <tr>\n";
          echo "      <td></td>\n";
          echo "      <td>:</td>\n";
          echo "      <td><button type=\"submit\" name=\"questiochange\">Frage ändern</button></td>\n";
          echo "    </tr>\n";
          echo "  </table>\n";
          echo "</form>";
        }
  }


  //Wenn Frage zu löschen ausgewählt ist
  elseif (isset($_POST['löschen'])) {
    // code...
  }

  //Wenn neue Kategorie erstelle werden soll
  elseif (isset($_POST['newcategory'])) {
    // code...
  }

  //Wenn neue Frage erstellt werden soll
  elseif (isset($_POST['newquestion'])) {
    //Kategorien aus der Datenbank Abfragen
    $DatenbankAbfrageKategorien= "SELECT categoryName, categoryID FROM categorys";
    $KategorieArray = mysqli_query ($db_link, $DatenbankAbfrageKategorien);

    echo "<h1>Frage erstellen</h1>\n";
    echo "<form class=\"createquestion\" action=\"admin.php\" method=\"post\">\n";
    echo "  <table>\n";
    echo "    <tr>\n";
    echo "      <td>Fragen ID</td>\n";
    echo "      <td>:</td>\n";
    echo "      <td>Wird Automatisch vergeben</td>\n";
    echo "    </tr>\n";
    echo "    <tr>\n";
    echo "      <td>Fragen Kategorie</td>\n";
    echo "      <td>:</td>\n";
    echo "      <td><select class=\"questionCategory\" name=\"questionCategory\">\n";
    if (mysqli_num_rows ($KategorieArray) > 0)
        {
            // aktuelles Tupel ausgeben --------------------------------------------------
            while ($zeile = mysqli_fetch_array($KategorieArray))
             {
               echo "        <option value=\"".$zeile['categoryID']."\">".$zeile['categoryName']."</option>\n";
             }
        }
    echo "      </select></td>\n";
    echo "    </tr>\n";
    echo "    <tr>\n";
    echo "      <td>Frage</td>\n";
    echo "      <td>:</td>\n";
    echo "      <td><textarea rows=\"4\" cols=\"50\" name=\"questionContent\" value=\"\"></textarea></td>\n";
    echo "    </tr>\n";
    echo "    <tr>\n";
    echo "      <td>Antwort 1</td>\n";
    echo "      <td>:</td>\n";
    echo "      <td><input type=\"text\" name=\"questionAnswer1\"></td>\n";
    echo "    </tr>\n";
    echo "    <tr>\n";
    echo "      <td>Antwort 2</td>\n";
    echo "      <td>:</td>\n";
    echo "      <td><input type=\"text\" name=\"questionAnswer2\"></td>\n";
    echo "    </tr>\n";
    echo "    <tr>\n";
    echo "      <td>Antwort 3</td>\n";
    echo "      <td>:</td>\n";
    echo "      <td><input type=\"text\" name=\"questionAnswer3\"></td>\n";
    echo "    </tr>\n";
    echo "    <tr>\n";
    echo "      <td>Antwort 4</td>\n";
    echo "      <td>:</td>\n";
    echo "      <td><input type=\"text\" name=\"questionAnswer4\"></td>\n";
    echo "    </tr>\n";
    echo "    <tr>\n";
    echo "      <td>Richtig Antwort</td>\n";
    echo "      <td>:</td>\n";
    echo "      <td><input type=\"text\" name=\"questionAnswerRight\"></td>\n";
    echo "    </tr>\n";
    echo "    <tr>\n";
    echo "      <td></td>\n";
    echo "      <td>:</td>\n";
    echo "      <td><button type=\"submit\" name=\"questionentry\">Frage eintragen</button></td>\n";
    echo "    </tr>\n";
    echo "  </table>\n";
    echo "</form>";

  }

  //Wenn die User gemanged werden sollen
  elseif (isset($_POST['manageuser'])) {
    // code...
  }

  else {
    //Auflistung der Fragen
    //Datenbankabfrage nach Fragen
    $DatenbankAbfrageFragen= "SELECT * FROM questions, categorys WHERE questionCategory = categoryID";
    $FragenArray = mysqli_query ($db_link, $DatenbankAbfrageFragen);
      echo "<h1>User Bearbeiten</h1>\n";
      echo "<form class=\"manageuser\" action=\"admin.php\" method=\"post\">\n";
      echo "<button type=\"submit\" name=\"mangeuser\">User bearbeiten</button>  \n";
      echo "</form>\n";
      echo "<hr>\n";
      echo "<h1>Kategorie erstellen</h1>\n";
      echo "<form class=\"newcategory\" action=\"admin.php\" method=\"post\">\n";
      echo "<button type=\"submit\" name=\"newcategory\">Neue Kategorie ersellen</button>  \n";
      echo "</form>\n";
      echo "<hr>\n";
      echo "<h1>Fragen</h1>\n";
      echo "<form class=\"newquestion\" action=\"admin.php\" method=\"post\">\n";
      echo "<button type=\"submit\" name=\"newquestion\">Neue Frage ersellen</button>  \n";
      echo "</form>\n";
      echo "<table>\n";
      echo "<tr>";
      echo "  <th>Nr</th>\n";
      echo "  <th>Kategory</th>\n";
      echo "  <th>Inhalt</th>\n";
      echo "  <th>Antwort 1</th>\n";
      echo "  <th>Antwort 2</th>\n";
      echo "  <th>Antwort 3</th>\n";
      echo "  <th>Antwort 4</th>\n";
      echo "  <th>Richtige Antwort</th>\n";
      echo "  <th></th>\n";
      echo "  <th></th>\n";
      while ($zeile = mysqli_fetch_array($FragenArray))
       {
        echo "</tr>";
        echo "  <tr>\n";
        echo "    <td>".$zeile['questionID']."</td>\n";
        echo "    <td>".$zeile['categoryName']."</td>\n";
        echo "    <td>".$zeile['questionContent']."</td>\n";
        echo "    <td>".$zeile['questionAnswer1']."</td>\n";
        echo "    <td>".$zeile['questionAnswer2']."</td>\n";
        echo "    <td>".$zeile['questionAnswer3']."</td>\n";
        echo "    <td>".$zeile['questionAnswer4']."</td>\n";
        echo "    <td>".$zeile['questionAnswerRight']."</td>\n";
        echo "    <form class=\"newcategory\" action=\"admin.php\" method=\"post\">\n";
        echo "    <td><button type=\"submit\" name=\"bearbeiten\" value=\"".$zeile['questionID']."\" ><img src=\"./img/bearbeiten.png\" alt=\"bearbeiten\"></button></td>\n";
        echo "    <td><button type=\"submit\" name=\"löschen\" value=\"".$zeile['questionID']."\" ><img src=\"./img/loeschen.png\" alt=\"loeschen\"></button></td>\n";
      echo "  </tr>\n";
      }
      echo "</table>";
    }
  }


else {
  echo "Sie sind leider nicht eingelogt";
}


?>
