<?php
require_once('../../engine/config.php');
$SelCurso = $_GET['selcurso'];
$SelAno = $_GET['selano'];

function flatten(array $array) {
    $return = array();
    array_walk_recursive($array, function($a) use (&$return) { $return[] = $a; });
    return $return;
}

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
	unset($allKey['id_docente']);
	unset($allKey['email_docente']);
	unset($allKey['efetivo_docente']);
	unset($allKey['dt_inicio_exercicio']);
	unset($allKey['dt_fim_exercicio']);
	unset($allKey['id_exercicio']);
	foreach($allKey as &$singleKey){ //Traveling each docente's data
		if(is_array($singleKey)){ //If Ferias
			unset($singleKey['ano_ferias']);
			unset($singleKey['id_afastamento']);
			unset($singleKey['observ_afastamento']);
			unset($singleKey['id_ocorrencia']);
			unset($singleKey['id_docente']);			
			array_push($singleKey, date_diff(date_create($singleKey['dt_inicio_afastamento']),date_create($singleKey['dt_fim_afastamento']))->format('%a')+1);		
		}
		unset($singleKey);
	}
	$allKey = flatten($allKey);
	unset($allKey);
}

//var_dump($AllData);
header('Content-Encoding: UTF-8');
@header("Last-Modified: " . @gmdate("D, d M Y H:i:s",$_GET['timestamp']) . " GMT");
@header("Content-type: text/x-csv; charset=UTF-8");
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    header("Content-Disposition: attachment; filename=relatorio".$SelAno.".csv");
}
echo "\xEF\xBB\xBF";
$output = fopen("php://output",'w') or die("Can't open php://output");
fputcsv($output, array($Curso,'Exércicio de '.$SelAno));
fputcsv($output, array("\r\n"));
foreach($AllData as $allKey){
	//fputcsv($output, array('Nome','SIAPE'));
	fputcsv($output, $allKey);
	//fputcsv($output, array("\r\n"));
}

fclose($output);


?>
































