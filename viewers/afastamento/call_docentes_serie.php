<?php
require_once('../../engine/config.php');
$SelCurso = $_POST ['selcurso'];
//var_dump($SelCurso);
$Docente = new Docente();
$Docente = $Docente->ReadAllCurso($SelCurso);
$Docentesize = sizeof($Docente);
foreach ( $Docente as $docenteRow ){
  if (is_null ( $docenteRow ['dt_fim_exercicio'] )) {
	echo '<tr class="nome_docente_serie">';
	echo '<td class="text-left nomeSerie">'.$docenteRow['nome_docente'].'</td>';
	echo '<td class="text-left">'.$docenteRow['siape_docente'].'</td>';
	echo '</tr>';
	echo '<input type="hidden" class="cada_docente" value="'.$docenteRow['id_docente'].'">';
  }
  else{
	  $Docentesize = $Docentesize-1;
  }
}
echo '<input type="hidden" id="docente_count" value="'.$Docentesize.'">';


?>

