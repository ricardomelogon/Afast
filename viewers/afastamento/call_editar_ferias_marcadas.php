<?php
require_once('../../engine/config.php');
$IdCurso = $_POST ['id_curso'];
$IdDocente = $_POST ['id_docente'];
$Afastamento = new Afastamento();
$Afastamento = $Afastamento->ReadAllOcorrenciaFeriasDocente($IdCurso, $IdDocente);

$Count = 0;
foreach ( $Afastamento as $afastamentoRow ){
	echo '<tr id="linhaDocente-'.$Count.'">';
	echo '<td class="text-left nomeDocente">'.$afastamentoRow['nome_docente'].'</td>';
	echo '<td class="text-left dataInicio">'.ExibeData($afastamentoRow['dt_inicio_afastamento']).'</td>';
	echo '<td class="text-left dataFim">'.ExibeData($afastamentoRow['dt_fim_afastamento']).'</td>';
	echo '<td class="form-group has-feedback has-feedback-right editarFeriasTd">';
	echo 	'<i class="form-control-feedback glyphicon glyphicon-calendar editarFeriasGlyph"></i>';
	echo 	'<input name="filtra_ano" class="input-mini form-control filtra_ano" id="DataAno-'.$Count.'" value="'.$afastamentoRow['ano_ferias'].'"></input> ';
	echo '</td>';
	echo '<td class="text-left buttonSalvar">';
	echo 	'<button type="button" class="btn btn-success Salvarferias" id="btnSave-'.$Count.'">';
	echo 		'<span class="glyphicon glyphicon-save" aria-hidden="true"></span>Salvar';
	echo 	'</button>';
	echo '</td>';
	
	echo '<input type="hidden" id="idAfastamento-'.$Count.'" value="'.$afastamentoRow['id_afastamento'].'">';
	echo '<input type="hidden" id="idFerias-'.$Count.'" value="'.$afastamentoRow['id_ferias'].'">';
	echo '</tr>';
	$Count++;
	
}
$Count++;
?>

<script type="text/javascript" src="../js/viewers/afastamento/afastamento.editar.anoferias.marcadas.save.js?v=1.15"></script>