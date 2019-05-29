<?php
///////////////////////////////////////////////
// Semesterproject - ECIN                     //
// Fachbereich Medien FH-Kiel - 4. Semester   //
// Beschreibung : Quiz Logic                  //
// Ersteller    : Sven Krumbeck              //
// Stand        : 27.05.19                   //
// Version      : 1.0                        //
///////////////////////////////////////////////

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
        schwerikeitsgrad();
      }
      //Wenn der Nächste Frage Knopf gedrückt wurde
      elseif (isset($_POST['nextQuestion'])) {
        $Category = $_COOKIE['category'];
        randomQuestion();
        quizleicht ();
      }
      //Wenn die Frage beantwortet wurde
      elseif (isset($_POST['answer'])) {
        //wenn die Frage Richtig Beantwortet wurde
        if ($_POST['answer'] == $_POST['rightanswer']) {
          echo "Ihre Antwort ".$_POST['answer']." ist richtig";
          scoreup($_COOKIE['UserID'], $ScoreMiddle);
          nextQuestion();
        }
        //Wenn die Frage nicht richtig beantwortet wurde
        else {
          echo "Ihre Antwort ".$_POST['answer']." ist leider falsch, richtig wäre ".$_POST['rightanswer']." gewesen.";
          wrongAnser($user);
          nextQuestion();
        }
      }
      //Wenn beides eingestellt ist, das Quiz start
      else {
        //Kategorie als Variable
        $Category = $_COOKIE['category'];
        randomQuestion();
        quizleicht ();
      }


?>
