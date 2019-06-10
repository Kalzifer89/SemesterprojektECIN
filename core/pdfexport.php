<?php

///////////////////////////////////////////////
// Semesterproject - ECIN                     //
// Fachbereich Medien FH-Kiel - 4. Semester  //
// Beschreibung : PDF Export                 //
// Ersteller    : Sven Krumbeck              //
// Stand        : 23.05.19                   //
// Version      : 1.0                        //
///////////////////////////////////////////////

//Abwandlung des Codes von https://www.php-einfach.de/experte/php-codebeispiele/pdf-per-php-erstellen-pdf-rechnung/

//Versucht sonst einen Fehler mit TCPDF
error_reporting(0); //hide php errors

include '../config/config.php';

//Abfrage der Daten für die Usern

$userID = $_COOKIE['UserID'];
$DatenbankAbfrageScore = "SELECT * FROM score WHERE userID LIKE '$userID'";
$ScoreArray = mysqli_query ($db_link, $DatenbankAbfrageScore);

// Wenn mehr als 0 Tupel vorhanden sind -------------------------------
    if (mysqli_num_rows ($ScoreArray) > 0)
        {
// aktuelles Tupel ausgeben --------------------------------------------------
            while ($zeile = mysqli_fetch_array($ScoreArray))
             {
               $questionsRight = $zeile['questionsRight'];
               $questionsWrong = $zeile['questionsWrong'];
               $score = $zeile['score'];
             }
           }

$Gesamtwert = $questionsRight + $questionsWrong;

//Beginn Highscore
//Abfrage der Score jeden User beginnend mit dem Höhsten Score
$DatenbankAbfrageHighScore = "SELECT * FROM users,score WHERE users.userID = score.userID ORDER BY `score`.`score` DESC";
$HighScoreArray = mysqli_query ($db_link, $DatenbankAbfrageHighScore);
$Platz = 0;


$rechnungs_datum = date("d.m.Y");
$pdfAuthor = "Svens Quiz";

$rechnungs_header = '
Sven Quiz
Sven Krumbeck
www.svens-blog.de';

$rechnungs_empfaenger = ''.$_COOKIE['UserName'].'
'.$_COOKIE['UserMail'].'';

$rechnungs_footer = "Vielen dank für das Spielen des Quizes, wenn sie ihren Highscore verbessern möchten, spielen sie nochmal. Oder wählen sie einen höhen Schwerikeitsgrad.";

$pdfName = "SvensQuiz_".$_COOKIE['UserName'].".pdf";


//////////////////////////// Inhalt des PDFs als HTML-Code \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


// Erstellung des HTML-Codes. Dieser HTML-Code definiert das Aussehen eures PDFs.
// tcpdf unterstützt recht viele HTML-Befehle. Die Nutzung von CSS ist allerdings
// stark eingeschränkt.

$html = '
<table cellpadding="5" cellspacing="0" style="width: 100%; ">
	<tr>
		<td>'.nl2br(trim($rechnungs_header)).'</td>
	   <td style="text-align: right">
 '.$rechnungs_datum.'<br>
		</td>
	</tr>

	<tr>
		 <td style="font-size:1.3em; font-weight: bold;">
<br><br>
Statistik
<br>
		 </td>
	</tr>


	<tr>
		<td colspan="2">'.nl2br(trim($rechnungs_empfaenger)).'</td>
	</tr>
</table>
<br><br><br>
<b style="text-align: center;">Sie haben '.$questionsRight.' Fragen von '.$Gesamtwert.' richtig beantwortet. Leider waren '.$questionsWrong.' Fragen falsch.</b> <br>
<img src="../img/statistikkreis.png" width="800px;">

<h2 style="text-align: center;">Highscore</h2>

<table cellpadding="5" cellspacing="0" style="width: 100%;" border="0">
	<tr style="background-color: #cccccc; padding:5px;">
		<td style="text-align: center;"><b>Platz</b></td>
		<td style="text-align: center;"><b>Name</b></td>
		<td style="text-align: center;"><b>Score</b></td>
	</tr>';

	if (mysqli_num_rows ($ScoreArray) > 0)
	    {
	// aktuelles Tupel ausgeben --------------------------------------------------
	        while ($zeile = mysqli_fetch_array($HighScoreArray))
	         {
	          $Platz = $Platz + 1;
						$html .='
	          <tr>
	          <td style="text-align: center;">'.$Platz.'</td>
	          <td style="text-align: center;">'.$zeile['userName'].'</td>
	          <td style="text-align: center;">'.$zeile['score'].'</td>
	         	</tr>';
	        }
	}

$html .="</table><br><br><br>";

$html .= nl2br($rechnungs_footer);



//////////////////////////// Erzeugung eures PDF Dokuments \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

// TCPDF Library laden
require_once('../libraries/tcpdf/tcpdf.php');

// Erstellung des PDF Dokuments
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Dokumenteninformationen
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($pdfAuthor);
$pdf->SetTitle('Statistik '.$_COOKIE['UserName']);
$pdf->SetSubject('Statistik '.$_COOKIE['UserName']);


// Header und Footer Informationen
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Auswahl des Font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Auswahl der MArgins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Automatisches Autobreak der Seiten
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Image Scale
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Schriftart
$pdf->SetFont('dejavusans', '', 10);

// Neue Seite
$pdf->AddPage();

// Fügt den HTML Code in das PDF Dokument ein
$pdf->writeHTML($html, true, false, true, false, '');

//Ausgabe der PDF

//Variante 1: PDF direkt an den Benutzer senden:
$pdf->Output($pdfName, 'I');

//Variante 2: PDF im Verzeichnis abspeichern:
// $pdf->Output(dirname(__FILE__).'/'.$pdfName, 'F');
// echo 'PDF herunterladen: <a href="'.$pdfName.'">'.$pdfName.'</a>';

?>
