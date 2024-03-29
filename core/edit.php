<?php
///////////////////////////////////////////////
// Semesterproject - ECIN                     //
// Fachbereich Medien FH-Kiel - 4. Semester  //
// Beschreibung : Admin Bereich                //
// Ersteller    : Sven Krumbeck              //
// Stand        : 29.05.19                   //
// Version      : 2.0                        //
///////////////////////////////////////////////


//Login Überprüfen Elemente nur Anzeigen wenn Eingelogt
if ($_COOKIE['LoggedIn'] == true && $_COOKIE['isAdmin'] == 1)
{


//Anfang Fragen ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

  //Wenn das Fragen hinzufügen Formular ausgefüllt wurde
  if (isset($_POST['questionentry'])) {
    //Überprüen ob alle Felder ausgefüllt worden sind, sonsten fehlermeldungen
    if(empty ($_POST['questionCategory']) or empty ($_POST['questionContent']) or empty ($_POST['questionAnswer1']) or empty ($_POST['questionAnswer2']) or empty ($_POST['questionAnswer3']) or empty ($_POST['questionAnswer4']) or empty ($_POST['questionAnswerRight']))
      {
        echo "<h2>Frage erstellen</h2>\n";
        echo "<hr>";
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
        echo "<h2>Frage Erstellen</h2>\n";
        echo "<hr>";
        echo "<h3 class=\"sucess\">Eintrag erfolgreich</h3>";
        weiterbuttonadmin();
      }
  }

//Wenn neue Frage erstellt werden soll
elseif (isset($_POST['newquestion'])) {
  //Kategorien aus der Datenbank Abfragen
  $DatenbankAbfrageKategorien= "SELECT categoryName, categoryID FROM categorys";
  $KategorieArray = mysqli_query ($db_link, $DatenbankAbfrageKategorien);

  echo "<h2>Frage erstellen</h2>\n";
  echo "<hr>";
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
  echo "      <td><button type=\"submit\" name=\"questionentry\"class=\"button\">Frage eintragen</button></td>\n";
  echo "    </tr>\n";
  echo "  </table>\n";
  echo "</form>";
  zurückbuttonadmin();
}

  //Wenn das Fragen Ändern Formular ausgefüllt wurde
  elseif (isset($_POST['questionchange'])) {
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
        $questionID = $_POST['questionID'];
        //Einträge in Datenbank schreiben
        $DatenbankFrageAendern = "UPDATE questions SET questionCategory = '$questionCategory', questionContent = '$questionContent', questionAnswer1 = '$questionAnswer1 ', questionAnswer2 = '$questionAnswer2' , questionAnswer3= '$questionAnswer3' , questionAnswer4 = '$questionAnswer4'  WHERE questionID = '$questionID';";
        $Eintragen = mysqli_query ($db_link, $DatenbankFrageAendern);
        echo "<h2>Frage bearbeiten</h2>\n";
        echo "<hr>";
        echo "<h3 class=\"sucess\">Eintrag erfolgreich geändert</h3>";
        weiterbuttonadmin();
      }
  }

  //Wenn das Frage Lösche Formular bestätigt worden ist
  elseif (isset($_POST['questionDelete'])) {
    $questionID = $_POST['questionID'];
    $DatenbankEintragCategory = "DELETE FROM questions WHERE questionID = '$questionID' ";
    $Eintragen = mysqli_query ($db_link, $DatenbankEintragCategory);

    echo "<h2>Frage löschen</h2>\n";
    echo "<hr>";
    echo "<h3 class=\"sucess\">Eintrag erfolgreich gelöscht</h3>";
    weiterbuttonadmin();
  }


  //Wenn Frage zum Bearbeiten Ausgewählt ist
  elseif (isset($_POST['bearbeiten'])) {
    //Variable Übernehmen
    $questionID = $_POST['bearbeiten'];
    //Abfrage nach einzelner Frage aus der Datenbank
    $DatenbankAbfrageFragen= "SELECT * FROM questions, categorys WHERE questionCategory = categoryID AND questionID = '$questionID'";
    $FragenArray = mysqli_query ($db_link, $DatenbankAbfrageFragen);

    //Kategorien aus der Datenbank Abfragen
    $DatenbankAbfrageKategorien= "SELECT categoryName, categoryID FROM categorys";
    $KategorieArray = mysqli_query ($db_link, $DatenbankAbfrageKategorien);

    echo "<h2>Frage bearbeiten</h2>\n";
    echo "<hr>";
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
          echo"         <option value=\"".$zeile['questionCategory']."\" selected>".$zeile['categoryName']."</option>\n";
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
          echo "      <td><button type=\"submit\" class=\"backbutton\">zurück</button></td>\n";
          echo "      <td colspan=\"2\"><button type=\"submit\" name=\"questionchange\"class=\"backbutton\" >Frage ändern</button></td>\n";
          echo "    </tr>\n";
          echo "  </table>\n";
          echo "<input type=\"hidden\" name=\"questionID\" value=\"".$zeile['questionID']."\">";
          echo "</form>";
        }
  }


  //Wenn Frage zu löschen ausgewählt ist
  elseif (isset($_POST['löschen'])) {
    //Variable Übernehmen
    $questionID = $_POST['löschen'];
    //Abfrage nach einzelner Frage aus der Datenbank
    $DatenbankAbfrageFragen= "SELECT * FROM questions, categorys WHERE questionCategory = categoryID AND questionID = '$questionID'";
    $FragenArray = mysqli_query ($db_link, $DatenbankAbfrageFragen);

    //Kategorien aus der Datenbank Abfragen
    $DatenbankAbfrageKategorien= "SELECT categoryName, categoryID FROM categorys";
    $KategorieArray = mysqli_query ($db_link, $DatenbankAbfrageKategorien);

    echo "<h2>Frage löschen</h2>\n";
    echo "<hr>";
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
        while ($zeile = mysqli_fetch_array($FragenArray))
            {
          echo"         <td>".$zeile['categoryName']."</td>\n";
          echo "    </tr>\n";
          echo "    <tr>\n";
          echo "      <td>Frage</td>\n";
          echo "      <td>:</td>\n";
          echo "      <td>".$zeile['questionContent']."</td>\n";
          echo "    </tr>\n";
          echo "    <tr>\n";
          echo "      <td>Antwort 1</td>\n";
          echo "      <td>:</td>\n";
          echo "      <td>".$zeile['questionAnswer1']."</td>\n";
          echo "    </tr>\n";
          echo "    <tr>\n";
          echo "      <td>Antwort 2</td>\n";
          echo "      <td>:</td>\n";
          echo "      <td>".$zeile['questionAnswer2']."</td>\n";
          echo "    </tr>\n";
          echo "    <tr>\n";
          echo "      <td>Antwort 3</td>\n";
          echo "      <td>:</td>\n";
          echo "      <td>".$zeile['questionAnswer3']."</td>\n";
          echo "    </tr>\n";
          echo "    <tr>\n";
          echo "      <td>Antwort 4</td>\n";
          echo "      <td>:</td>\n";
          echo "      <td>".$zeile['questionAnswer4']."</td>\n";
          echo "    </tr>\n";
          echo "    <tr>\n";
          echo "      <td>Richtig Antwort</td>\n";
          echo "      <td>:</td>\n";
          echo "      <td>".$zeile['questionAnswerRight']."</td>\n";
          echo "    </tr>\n";
          echo "    <tr>\n";
          echo "      <td></td>\n";
          echo "      <td>:</td>\n";
          echo "      <td><button type=\"submit\" name=\"questionDelete\" class=\"backbutton\">Frage Löschen</button></td>\n";
          echo "      <td><button type=\"submit\" name=\"questionAbbort\" class=\"backbutton\">Zurück</button></td>\n";
          echo "    </tr>\n";
          echo "  </table>\n";
          echo "<input type=\"hidden\" name=\"questionID\" value=\"".$zeile['questionID']."\">";
          echo "</form>";
        }
  }

//Ende Fragen /////////////////////////////////////////////////////////////////////////////////////////

//Anfgang User /////////////////////////////////////////////////////////////////////////////////////////

  //Wenn die User gemanged werden sollen
  elseif (isset($_POST['manageuser'])) {
    //Datenbankabfrage nach allen Usern
    $DatenbankAbfrageUser= "SELECT * FROM users";
    $UserArray = mysqli_query ($db_link, $DatenbankAbfrageUser);

    echo "<h2>User bearbeiten</h2>\n";
    echo "<hr>";
    echo "<form class=\"edituser\" action=\"admin.php\" method=\"post\">\n";
    echo "  <table class=\"manageuser\">\n";
    echo "    <tr>\n";
    echo "      <th>User Name</th>\n";
    echo "      <th>Email</th>\n";
    echo "      <th>Password</th>\n";
    echo "      <th></th>\n";
    echo "      <th></th>\n";
    echo "    </tr>\n";
    while ($zeile = mysqli_fetch_array($UserArray))
        {
        echo "    <tr>\n";
        echo "      <td>".$zeile['userName']."</td>\n";
        echo "      <td>".$zeile['userMail']."</td>\n";
        echo "      <td>user".$zeile['userPassword']."</td>\n";
        echo "      <td><button type=\"submit\" name=\"userbearbeiten\" value=\"".$zeile['userID']."\" ><img src=\"./img/bearbeiten.png\" alt=\"bearbeiten\"></button></td>\n";
        echo "      <td><button type=\"submit\" name=\"userlöschen\" value=\"".$zeile['userID']."\" ><img src=\"./img/loeschen.png\" alt=\"loeschen\"></button></td>\n";
        echo "    </tr>\n";
        }
    echo "  </table>\n";
    echo "</form>";
    zurückbuttonadmin();
  }

  //Wenn User zum Bearbeiten Ausgewählt ist
  elseif (isset($_POST['userbearbeiten'])) {
    //Variable Übernehmen
    $userID = $_POST['userbearbeiten'];
    //Abfrage nach einzelner Frage aus der Datenbank
    $DatenbankAbfrageUser= "SELECT * FROM users WHERE userID = '$userID'";
    $UserArray = mysqli_query ($db_link, $DatenbankAbfrageUser);
    while ($zeile = mysqli_fetch_array($UserArray))
       {
      echo "<h1>User bearbeiten</h1>\n";
      echo "<form class=\"edituser\" action=\"admin.php\" method=\"post\">\n";
      echo "  <table>\n";
      echo "    <tr>\n";
      echo "      <td>User ID</td>\n";
      echo "      <td>:</td>\n";
      echo "      <td>".$zeile['userID']."</td>\n";
      echo "    </tr>\n";
      echo "    <tr>\n";
      echo "      <td>User Name</td>\n";
      echo "      <td>:</td>\n";
      echo "      <td><input type=\"text\" name=\"userName\" value=\"".$zeile['userName']."\"></td>\n";
      echo "    </tr>\n";
      echo "      <td>User Mail</td>\n";
      echo "      <td>:</td>\n";
      echo "      <td><input type=\"text\" name=\"userMail\" value=\"".$zeile['userMail']."\"></td>\n";
      echo "    </tr>\n";
      echo "    </tr>\n";
      echo "      <td>User Admin</td>\n";
      echo "      <td>:</td>\n";
      //Überprüfen ob User Admin ist, wenn ja Checkbox checken
      if ($zeile['userAdmin'] == 1) {
        echo "      <td><input type=\"checkbox\" name=\"admin\" value=\"1\"checked></td>\n";
      }
      else {
        echo "      <td><input type=\"checkbox\" name=\"admin\" value=\"1\"></td>\n";
      }
      echo "    </tr>\n";
      echo "      <td>User Passwort</td>\n";
      echo "      <td>:</td>\n";
      echo "      <td>".$zeile['userPassword']."</td>\n";
      echo "    </tr>\n";
      echo "  </table>\n";
      echo "<input type=\"hidden\" name=\"userID\" value=\"".$zeile['userID']."\">";
      echo "    <tr>\n";
      echo "      <td><button type=\"submit\" name=\"userchange\" class=\"backbutton\">User bearbeiten</button></td>\n";
      echo "      <td><button type=\"submit\" class=\"backbutton\">Zurück</button></td>\n";
      echo "    </tr>\n";
      echo "</form>";
    }
  }


  //Wenn User zum löschen Ausgewählt ist
  elseif (isset($_POST['userlöschen'])) {
    //Variable Übernehmen
    $userID = $_POST['userlöschen'];
    //Abfrage nach einzelner Frage aus der Datenbank
    $DatenbankAbfrageUser= "SELECT * FROM users WHERE userID = '$userID'";
    $UserArray = mysqli_query ($db_link, $DatenbankAbfrageUser);
    while ($zeile = mysqli_fetch_array($UserArray))
       {
      echo "<h2>User Löschen</h2>\n";
      echo "<hr>";
      echo "<form class=\"edituser\" action=\"admin.php\" method=\"post\">\n";
      echo "  <table>\n";
      echo "    <tr>\n";
      echo "      <td>User ID</td>\n";
      echo "      <td>:</td>\n";
      echo "      <td>".$zeile['userID']."</td>\n";
      echo "    </tr>\n";
      echo "    <tr>\n";
      echo "      <td>User Name</td>\n";
      echo "      <td>:</td>\n";
      echo "      <td>".$zeile['userName']."</td>\n";
      echo "    </tr>\n";
      echo "      <td>User Mail</td>\n";
      echo "      <td>:</td>\n";
      echo "      <td>".$zeile['userMail']."</td>\n";
      echo "    </tr>\n";
      echo "    </tr>\n";
      echo "      <td>User Admin</td>\n";
      echo "      <td>:</td>\n";
      echo "      <td>".$zeile['userAdmin']."</td>";
      echo "    </tr>\n";
      echo "      <td>User Passwort</td>\n";
      echo "      <td>:</td>\n";
      echo "      <td>".$zeile['userPassword']."</td>\n";
      echo "    </tr>\n";
      echo "  </table>\n";
      echo "<input type=\"hidden\" name=\"userID\" value=\"".$zeile['userID']."\">";
      echo "    <tr>\n";
      echo "      <td><button type=\"submit\" name=\"userdelite\" class=\"backbutton\">User löschen</button></td>\n";
      echo "    </tr>\n";
      echo "</form>";
    }
  }

  //Wenn das User Löschen Formular ausgefüllt wurde
  elseif (isset($_POST['userdelite'])) {
    //Überprüen ob alle Felder ausgefüllt worden sind, sonsten fehlermeldungen
        //Post an Variablen Übergeben
        $userID = $_POST['userID'];
        //Einträge in Datenbank schreiben
        $DatenbankUserLöschen = "DELETE FROM users WHERE userID = '$userID'";
        $Eintragen = mysqli_query ($db_link, $DatenbankUserLöschen);
        echo "<h3 class=\"sucess\">User erfolgreich gelöscht</h3>";
        weiterbuttonadmin();
      }



  //Wenn das User Ändern Formular ausgefüllt wurde
  elseif (isset($_POST['userchange'])) {
    //Überprüen ob alle Felder ausgefüllt worden sind, sonsten fehlermeldungen
    if(empty ($_POST['userName']) or empty ($_POST['userMail']))
      {
        echo "<h3 class =\"erorr\">Sie haben nicht alle Notwenigen Felder ausgefüllt, es wurde kein Eintrag geändert<h3>";
      }
      else {
        //Post an Variablen Übergeben
        $userName = $_POST['userName'];
        $userMail = $_POST['userMail'];
        $userID = $_POST['userID'];
        //User ID auf 1 oder 0 setzen
        if (isset($_POST['admin'])) {
          $admin = 1;
        }
        else {
          $admin = 0;
        }
        //Einträge in Datenbank schreiben
        $DatenbankUserAendern = "UPDATE users SET userName = '$userName', userMail = '$userMail', userAdmin = '$admin' WHERE userID = '$userID';";
        $Eintragen = mysqli_query ($db_link, $DatenbankUserAendern);
        echo "<h2>User bearbeiten</h2>\n";
        echo "<hr>";
        echo "<h3 class=\"sucess\">Eintrag erfolgreich geändert</h3>";
        weiterbuttonadmin();
      }
  }

//Ende Bereich User /////////////////////////////////////////////////////////////////////////////////////////

//Anfang Bereich Kategorien /////////////////////////////////////////////////////////////////////////////////////////

  //Wenn das neue Kategory Formular Ausgefüllt ist
  elseif (isset($_POST['createcategory'])) {
    //Wenn keine Kategory eingetragen wurde, fehlermeldung ausgeben
      if(empty ($_POST['newcategory'])) {
        echo "Sie müssen einen Category namen eingeben. Ihre Kategegory wurde nicht gespeichert.";
      }
      else {
        $category = $_POST['newcategory'];
        //Überprüfen ob Kategory schon existiert
        $DatenbankKategoryCheck = "SELECT categoryName FROM categorys WHERE categoryName = '$category'";
        $Prüfung = mysqli_query ($db_link, $DatenbankKategoryCheck);
        if (mysqli_num_rows ($Prüfung ) > 0)
            {
              echo "<h2>Kategorie erstellen</h2>\n";
              echo "<hr>";
              echo "<h3 class=\"error\">Leider gibt es schon eine Kategorie mit gleichem Namen, wählen sie bitte einen anderen.</h3>";
              weiterbuttonadmin();
            }
            else {
                      $DatenbankEintragCategory = "INSERT INTO categorys (categoryName) VALUES ('$category')";
                      $Eintragen = mysqli_query ($db_link, $DatenbankEintragCategory);
                      echo "<h2>Kategorie erstellen</h2>\n";
                      echo "<hr>";
                      echo "<h3 class=\"sucess\">Kategorie erfolgreich erstellt</h3>";
                      weiterbuttonadmin();
            }
      }
  }

  //Wenn neue Kategorie erstelle werden soll
  elseif (isset($_POST['newcategory'])) {
    echo "<h2>Neue Kategorie erstellen</h2>";
    echo "<hr>";
    echo "<form class=\"newcategory\" action=\"admin.php\" method=\"post\">\n";
    echo "  <input type=\"text\" name=\"newcategory\" value=\"Kategoryname\">\n";
    echo "  <button type=\"submit\" name=\"createcategory\" class=\"button\">Absenden</button>\n";
    echo "</form>";
    zurückbuttonadmin();
  }




  //Wenn Kategorien bearbeitet werden sollen

  //Wenn die Kategorie gemanged werden sollen
  elseif (isset($_POST['managecategory'])) {
    //Datenbankabfrage nach allen Kategorien
    $DatenbankAbfrageCategorys= "SELECT * FROM categorys";
    $CategoryArray = mysqli_query ($db_link, $DatenbankAbfrageCategorys);

    echo "<h2>Kategorien bearbeiten</h2>\n";
    echo "<hr>";
    echo "<form class=\"edituser\" action=\"admin.php\" method=\"post\">\n";
    echo "  <table class=\"manageuser\">\n";
    echo "    <tr>\n";
    echo "      <th>Kategorie ID</th>\n";
    echo "      <th>Kategorie Name</th>\n";
    echo "      <th></th>\n";
    echo "      <th></th>\n";
    echo "    </tr>\n";
    while ($zeile = mysqli_fetch_array($CategoryArray))
        {
        echo "    <tr>\n";
        echo "      <td>".$zeile['categoryID']."</td>\n";
        echo "      <td>".$zeile['categoryName']."</td>\n";
        echo "      <td><button type=\"submit\" name=\"categorybearbeiten\" value=\"".$zeile['categoryID']."\" ><img src=\"./img/bearbeiten.png\" alt=\"bearbeiten\"></button></td>\n";
        echo "    </tr>\n";
        }
    echo "  </table>\n";
    echo "</form>";
    zurückbuttonadmin();
  }

  //Wenn Kategory zum Bearbeiten Ausgewählt ist
  elseif (isset($_POST['categorybearbeiten'])) {
    //Variable Übernehmen
    $KategorieID = $_POST['categorybearbeiten'];
    //Abfrage nach einzelner Frage aus der Datenbank
    $DatenbankAbfrageKategorie= "SELECT * FROM categorys WHERE categoryID = '$KategorieID'";
    $KategorieArray = mysqli_query ($db_link, $DatenbankAbfrageKategorie);
    echo "<h2>Kategorien bearbeiten</h2>\n";
    echo "<hr>";
    echo "<form class=\"edituser\" action=\"admin.php\" method=\"post\">\n";
    echo "  <table class=\"manageuser\">\n";
    echo "    <tr>\n";
    echo "      <th>Kategorie ID</th>\n";
    echo "      <th>Kategorie Name</th>\n";
    echo "      <th></th>\n";
    echo "      <th></th>\n";
    echo "    </tr>\n";
    while ($zeile = mysqli_fetch_array($KategorieArray))
        {
        echo "    <tr>\n";
        echo "      <td>".$zeile['categoryID']."</td>\n";
        echo "      <td><input type=\"text\" name=\"categoryname\"value=\"".$zeile['categoryName']."\"></td>\n";
        echo "      <td><button type=\"submit\" name=\"changecategory\" class=\"button\">Absenden</button>\n</td>";
        echo "      <input type=\"hidden\" name=\"categoryID\" value=\"".$zeile['categoryID']."\">";
        echo "    </tr>\n";
        }
    echo "  </table>\n";
    echo "</form>";
    zurückbuttonadmin();
  }

  //Wenn das Kategory ändern Formular Ausgefüllt ist
  elseif (isset($_POST['changecategory'])) {
    //Wenn keine Kategory eingetragen wurde, fehlermeldung ausgeben
      if(empty ($_POST['categoryname'])) {
        echo "Sie müssen einen Category namen eingeben. Ihre Kategegory wurde nicht geändert.";
      }
      else {
        $category = $_POST['categoryname'];
        $categoryID = $_POST['categoryID'];
        //Überprüfen ob Kategory schon existiert
        $DatenbankKategoryCheck = "SELECT categoryName FROM categorys WHERE categoryName = '$category'";
        $Prüfung = mysqli_query ($db_link, $DatenbankKategoryCheck);
        if (mysqli_num_rows ($Prüfung ) > 0)
            {
              echo "<h2>Kategorie ändern</h2>\n";
              echo "<hr>";
              echo "<h3 class=\"error\">Leider gibt es schon eine Kategorie mit gleichem Namen, wählen sie bitte einen anderen.</h3>";
              weiterbuttonadmin();
            }
            else {
              //Eintrag in Datenbank Updaten und Erfolgsmeldung ausgeben
                      $DatenbankEintragCategory = "UPDATE categorys SET categoryName = '$category' WHERE categoryID = '$categoryID'";
                      $Eintragen = mysqli_query ($db_link, $DatenbankEintragCategory);
                      echo "<h2>Kategorie ändern</h2>\n";
                      echo "<hr>";
                      echo "<h3 class=\"sucess\">Kategorie erfolgreich geändert</h3>";
                      weiterbuttonadmin();
            }
      }
  }

//Ende Bereiche Kategorien /////////////////////////////////////////////////////////////////////////////////////////

//Anfang Bereiche Default /////////////////////////////////////////////////////////////////////////////////////////

  else {
    //Auflistung der Fragen
    //Datenbankabfrage nach Fragen
    $DatenbankAbfrageFragen= "SELECT * FROM questions, categorys WHERE questionCategory = categoryID ORDER BY questionID";
    $FragenArray = mysqli_query ($db_link, $DatenbankAbfrageFragen);
      echo "<h2>User Bearbeiten</h2>\n";
      echo "<hr>";
      echo "<form class=\"manageuser\" action=\"admin.php\" method=\"post\">\n";
      echo "<button type=\"submit\" name=\"manageuser\" class=\"answer\">User bearbeiten</button>  \n";
      echo "</form>\n";
      echo "<hr>\n";
      echo "<h2>Kategorien</h2>\n";
      echo "<hr>\n";
      echo "<form class=\"newcategory\" action=\"admin.php\" method=\"post\">\n";
      echo "<button type=\"submit\" name=\"managecategory\" class=\"answer\">Kategorien bearbeiten</button>  \n";
      echo "<button type=\"submit\" name=\"newcategory\" class=\"answer\">Kategorien erstellen</button>  \n";
      echo "</form>\n";
      echo "<hr>\n";
      echo "<h2>Fragen</h2>\n";
      echo "<hr>";
      echo "<form class=\"newquestion\" action=\"admin.php\" method=\"post\">\n";
      echo "<button type=\"submit\" name=\"newquestion\" class=\"answer\">Neue Frage ersellen</button>  \n";
      echo "</form>\n";
      echo "<hr>";
      echo "<table class=\"questiontable\">\n";
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


//ende Bereich Defailt /////////////////////////////////////////////////////////////////////////////////////////

}
else {
  echo "<h2>Admin Bereich</h2>\n";
  echo "<hr>";
  echo "Sie sind leider nicht eingelogt oder verfügen nicht über die Nötigen Rechte um diese Seite zu sehen.";
}

?>
