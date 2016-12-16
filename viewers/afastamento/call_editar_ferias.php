<?php
require_once('../../engine/config.php');
$SelCurso = $_POST ['selcurso'];
//var_dump($SelCurso);
$Afastamento = new Afastamento();
$Afastamento = $Afastamento->ReadAllOcorrenciaFerias($SelCurso);
$Count = 0;
foreach ( $Afastamento as $afastamentoRow ){
	echo '<tr id="linhaDocente-'.$Count.'">';
	echo '<td class="text-left nomeDocente">'.$afastamentoRow['nome_docente'].'</td>';
	echo '<td class="text-left dataInicio">'.ExibeData($afastamentoRow['dt_inicio_afastamento']).'</td>';
	echo '<td class="text-left dataFim">'.ExibeData($afastamentoRow['dt_fim_afastamento']).'</td>';
	echo '<td class="form-group has-feedback has-feedback-right editarFeriasTd">';
	echo 	'<i class="form-control-feedback glyphicon glyphicon-calendar editarFeriasGlyph"></i>';
	echo 	'<input name="filtra_ano" class="input-mini form-control filtra_ano" id="DataAno-'.$Count.'"></input> ';
	echo '</td>';
	echo '<td class="text-left buttonSalvar">';
	echo 	'<button type="button" class="btn btn-success Salvarferias" id="btnSave-'.$Count.'">';
	echo 		'<span class="glyphicon glyphicon-save" aria-hidden="true"></span>Salvar';
	echo 	'</button>';
	echo '</td>';
	
	echo '<input type="hidden" id="idAfastamento-'.$Count.'" value="'.$afastamentoRow['id_afastamento'].'">';
	echo '</tr>';
	
}
$Count++;
?>

