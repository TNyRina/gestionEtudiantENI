<?php 
	use Dompdf\Dompdf;
	require "../../dompdf/autoload.inc.php";
	require '../connectBDD.php';
	ob_start();
	require "page_generation.php";
	$html=ob_get_contents();
	ob_end_clean();
	
	$dompdf = new Dompdf();
	$dompdf->loadHTML($html);
	$dompdf->setPaper("A4","portrait");
	$dompdf->render();
	$nom_f = "soutenance-".$_POST['matricule']."-".$_POST['nom'];
	$dompdf->stream($nom_f);
 ?>