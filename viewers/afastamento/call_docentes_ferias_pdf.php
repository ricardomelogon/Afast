<?php
require_once('../../engine/config.php');
$SelCurso = $_GET['selcurso'];
$SelAno = $_GET['selano'];

$Curso = new Curso();
$Curso = $Curso->Read($SelCurso);
$Curso = $Curso['nome_curso'];

$Docente = new Docente();
$Docente = $Docente->ReadAllCurso($SelCurso);

$AllData = array();
$count = 0;
foreach ( $Docente as $docenteRow ){
  if (is_null ( $docenteRow ['dt_fim_exercicio'] )) {
	$Ferias = new Ferias();
	$Ferias = $Ferias->ReadAllDocenteAno($SelAno, $docenteRow['id_docente']);
	$AllData[$count] = array_unique(array_merge($docenteRow, $Ferias), SORT_REGULAR);
	$count++;
  }
}
foreach($AllData as &$allKey){ //traveling docentes
	$firstArray = array();
	array_push($firstArray,$allKey['nome_docente'],$allKey['siape_docente']);
	unset($allKey['id_docente']);
	unset($allKey['email_docente']);
	unset($allKey['efetivo_docente']);
	unset($allKey['dt_inicio_exercicio']);
	unset($allKey['dt_fim_exercicio']);
	unset($allKey['id_exercicio']);
	unset($allKey['nome_docente']);
	unset($allKey['siape_docente']);
	array_unshift($allKey,$firstArray);
	foreach($allKey as &$singleKey){ //Traveling each docente's data
		if(is_array($singleKey)){ //If Ferias
			unset($singleKey['ano_ferias']);
			unset($singleKey['id_afastamento']);
			unset($singleKey['observ_afastamento']);
			unset($singleKey['id_ocorrencia']);
			unset($singleKey['id_docente']);		
		}
		unset($singleKey);
	}
	unset($allKey);
}

//var_dump($AllData);
@header("Last-Modified: " . @gmdate("D, d M Y H:i:s",$_GET['timestamp']) . " GMT");
@header("Content-type: text/x-csv");
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    header("Content-Disposition: attachment; filename=search_results.csv");
}
$output = fopen("php://output",'w') or die("Can't open php://output");
fputcsv($output, array($Curso,$SelAno));
fputcsv($output, array("\r\n"));
foreach($AllData as $allKey){
	fputcsv($output, array('Nome','SIAPE'));
	for($i = 0; $i < sizeof($allKey); $i++){
		if($i > 0){
			fputcsv($output, array('Intervalo '.$i));
			fputcsv($output, array('Inicio', 'Fim'));
			fputcsv($output, $allKey[$i]);	
		}
		else{
			fputcsv($output, $allKey[$i]);
		}
	}
	fputcsv($output, array("\r\n"));
}
echo $output;
exit();

?>
































