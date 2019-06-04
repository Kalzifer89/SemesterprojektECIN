<?php
///////////////////////////////////////////////
// Semesterproject - ECIN                     //
// Fachbereich Medien FH-Kiel - 4. Semester   //
// Beschreibung : Footer                     //
// Ersteller    : Sven Krumbeck              //
// Stand        : 22.05.19                   //
// Version      : 1.0                        //
///////////////////////////////////////////////

echo "Variablen Check <br>";
echo "<b>Session</b><br>";
echo print_r($_SESSION);
echo "<br>";
echo "<b>Post</b><br>";
echo print_r($_POST);
echo "<br>";
echo "<b>Coockies</b><br>";
echo print_r($_COOKIE);
echo "<hr>";
//Score anzeigen
//User ID an Variable Übergeben wenn gesetzt
if (isset($_COOKIE['UserID'])) {

  $userID = $_COOKIE['UserID'];
  $DatenbankAbfrageScore = "SELECT * FROM score WHERE userID LIKE '$userID'";
  $ScoreArray = mysqli_query ($db_link, $DatenbankAbfrageScore);

// Wenn mehr als 0 Tupel vorhanden sind -------------------------------
    if (mysqli_num_rows ($ScoreArray) > 0)
        {
// aktuelles Tupel ausgeben --------------------------------------------------
            while ($zeile = mysqli_fetch_array($ScoreArray))
             {
               echo "Punktestand: ".$zeile['score']." Punkte<br>";
               echo "Anzahl richtig beantworter Fragen: ".$zeile['questionsRight']."<br>";
               echo "Anzahl falsch beantworter Fragen: ".$zeile['questionsWrong']."<br>";
             }
        }
        else {
          if (isset($_COOKIE['UserID'])) {
            // Dem neuen User einen Score Eintrag erstellen
            $DatenbankRegistierungScore = "INSERT INTO score (userID, questionsRight, questionsWrong, score) VALUES ('$userID',0,0,0)";
            $UserArray = mysqli_query ($db_link, $DatenbankRegistierungScore);
          }
        }
  }
  statsbutton();
?>
