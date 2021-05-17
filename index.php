<?php
// PDF Pages
//
// by Vangelis Zacharioudakis (http://github.com/sugarv)

// include files
use setasign\Fpdi\Fpdi;
require_once('config.php');
require_once('./vendor/autoload.php');

header('Content-type: text/html; charset=utf8'); 
?>
<html>
    <head><title><?= TITLE ?></title></head>
<body>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed&subset=greek,latin' rel='stylesheet' type='text/css'>
<LINK href="style.css" rel="stylesheet" type="text/css">
<?php

if (!isset($_POST['afm']))
{
    ?>
	<center>
	<h2><?= APP_DNSI ?>
		<br><?= TITLE ?></h2>
		<h4><?= SUB_TITLE ?></h4>
		<br>
		<br>
	<?php
	echo "<form name='login' method='post' id='login' action='' autocomplete='off'>
	<table>
	<tr><td><label for='afm'>Α.Μ. Εκπ/κού</label></td>
	<td><input name='am' id='am' type='text' required></td></tr>
	<tr><td><label for='afm'>Α.Φ.Μ. Εκπ/κού</label></td>
	<td><input name='afm' id='afm' type='password' required></td></tr>
	<tr><td colspan=2><center><input name='submit' id='submit' value='Είσοδος' type='submit'></center></td></tr></table>
	</form>";
	echo "<br><br>";
	echo "<small>(c) Δ/νση Π.Ε. Ηρακλείου - Τμήμα Μηχανογράφησης</small>";
	echo "</center>";
}
else
{
	$emptyForm = 0;
	
	// check if files exist...
	if (!file_exists('data/'.EMPLOYEE_FILENAME))
		die('Σφάλμα: Το αρχείο υπαλλήλων δε βρέθηκε.');
	elseif (!file_exists('data/'.VEV_FILENAME))
		die('Σφάλμα: Το αρχείο βεβαιώσεων δε βρέθηκε.');
	
	if (!strlen($_POST['am']) || !strlen($_POST['afm'])){
		$emptyForm = 1;
	}
	else {
		$afm = $_POST['afm'];
		if (substr($afm,0,1) == '0')
			$short_afm = substr($afm,1,8);
		$am = $_POST['am'];
		
		// use ParseCSV to find employee in csv file
		$csvFile = 'data/' . EMPLOYEE_FILENAME;

		$csv = new \ParseCsv\Csv();
		$csv->delimiter = ";";
		// find employee using AFM & AM
		$condition = 'afm is '.$afm.' AND am is '.$am;
		$csv->conditions = $condition;
		$csv->parse($csvFile);
		$parsed = $csv->data;
	}
    // if employee not found or empty form
	if ((isset($parsed) && !count($parsed)) || $emptyForm)
    {
		echo "H είσοδος με ΑΦΜ: $afm & ΑΜ: $am απέτυχε...";
		echo "<br>Δοκιμάστε ξανά με έναν έγκυρο συνδυασμό Α.Φ.Μ. - Α.Μ";
		echo "<FORM><INPUT Type='button' VALUE='Επιστροφή' onClick='history.go(-1);return true;'></FORM>";
	}
	else
	{
		// get all pages (if more than one)
		foreach($parsed as $rec) {
			$pages[] = $rec['page'];
		}

		//override memory limit
		ini_set('memory_limit', '-1');

		// FPDI lib is used. File must be PDF/A (v.1.4)
		//initiate FPDI
		
		$pdf = new Fpdi();
		foreach ($pages as $page)
		{
			//add a page (L for Landscape page orientation)
			$pdf->AddPage(L);
			//set the source file
			$fn = "./data/".VEV_FILENAME;
			$pdf->setSourceFile($fn);
			//import page
			$tplIdx = $pdf->importPage($page);
			//use the imported page 
			$pdf->useTemplate($tplIdx);
		}
		ob_end_clean();
		// output PDF to user's browser
		$pdf->Output();
	}
}
?>
</center>
</body>
</html>