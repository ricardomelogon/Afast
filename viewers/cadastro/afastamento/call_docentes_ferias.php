<?php
require_once('../../../engine/config.php');
$SelCurso = $_POST ['selcurso'];
$SelAno = $_POST['selano'];

$Docente = new Docente();
$Docente = $Docente->ReadAllCurso($SelCurso);
$Docentesize = sizeof($Docente);
$count = 0;
foreach ( $Docente as $docenteRow ){
  if (is_null ( $docenteRow ['dt_fim_exercicio'] )) {
	$Ferias = new Ferias();
	$Ferias = $Ferias->ReadAllDocenteAno($SelAno, $docenteRow['id_docente']);
	$Feriassize = sizeof($Ferias);
	$count++;
echo  '<div class="containter well cada_docente"> <!-- Well -->';
echo    '<section class="row primeiralinha"> <!-- Primeira Linha-->';
echo        '<section class="col-md-10"> <!-- Nome -->';
echo          '<label class="control-label">Nome</label>';
echo          '<p id="DocenteNome-'.$count.'">'.$docenteRow['nome_docente'].'</p>';
echo        '</section> <!-- Nome -->';
echo        '<section class="col-md-2"> <!-- Siape -->';
echo          '<label class="control-label">Siape</label>';
echo          '<p>'.$docenteRow['siape_docente'].'</p>';
echo        '</section> <!-- Siape -->';
echo        '<input type="hidden" id="docenteid-'.$count.'" value="'.$docenteRow['id_docente'].'">';
echo    '</section> <!-- Primeira Linha-->';
echo    '<hr class="hrferias"> <!-- Divisor -->';
echo    '<section class="row segundalinha"><!-- Segunda Linha -->';
echo     '<section class="col-md-11"> <!-- Datas -->';
echo      '<section class="col-md-3" id="docentedata-1-'.$count.'"> <!-- Selecionar Datas-->';
echo        '<div class="form-group has-feedback has-feedback-right">';
echo          '<label class="control-label">Intervalo 1</label>';
echo          '<i class="form-control-feedback glyphicon glyphicon-calendar"></i>';
echo          '<input type="hidden" class="whichdateid-1" value="1">';
echo          '<input name="escolhe_data" class="input-mini form-control escolhe_data whichdateid-1" type="text" value="'.($Feriassize >= 1 ? ExibeData($Ferias[0]['dt_inicio_afastamento']).' - '.ExibeData($Ferias[0]['dt_fim_afastamento']): "").'">';
echo          '<input type="hidden" id="dt_inicio_afastamento-1-'.$count.'" value="'.($Feriassize >= 1 ? $Ferias[0]['dt_inicio_afastamento']: "").'">';
echo          '<input type="hidden" id="dt_fim_afastamento-1-'.$count.'" value="'.($Feriassize >= 1 ? $Ferias[0]['dt_fim_afastamento']: "").'">';
echo          '<input type="hidden" id="id_afastamento-1-'.$count.'" value="'.($Feriassize >= 1 ? $Ferias[0]['id_afastamento']: "").'">';
echo        '</div>';
echo      '</section><!-- Selecionar Datas-->';
echo      '<section class="col-md-1"> <!-- Numero de Dias -->';
echo        '<label class="control-label">Dias</label>';
echo        '<button type="button" class="btn btn-default underbutton" aria-label="Left Align">'. $d1 = ($Feriassize >= 1 ? date_diff(date_create($Ferias[0]['dt_inicio_afastamento']),date_create($Ferias[0]['dt_fim_afastamento']))->format('%a')+1: "0").'</button>';
echo        '<input type="hidden" id="btnvalor-1-'.$count.'" value="'.$d1.'">';
echo      '</section> <!-- Numero de Dias -->';
echo      '<section class="col-md-3" id="docentedata-2-'.$count.'"> <!-- Selecionar Datas-->';
echo        '<div class="form-group has-feedback has-feedback-right">';
echo          '<label class="control-label">Intervalo 2</label>';
echo          '<i class="form-control-feedback glyphicon glyphicon-calendar"></i>';
echo          '<input type="hidden" class="whichdateid-2" value="2">';
echo          '<input name="escolhe_data" class="input-mini form-control escolhe_data whichdateid-2" type="text" value="'.($Feriassize >= 2 ? ExibeData($Ferias[1]['dt_inicio_afastamento']).' - '.ExibeData($Ferias[1]['dt_fim_afastamento']): "").'">';
echo          '<input type="hidden" id="dt_inicio_afastamento-2-'.$count.'" value="'.($Feriassize >= 2 ? $Ferias[1]['dt_inicio_afastamento']: "").'">';
echo          '<input type="hidden" id="dt_fim_afastamento-2-'.$count.'" value="'.($Feriassize >= 2 ? $Ferias[1]['dt_fim_afastamento']: "").'">';
echo          '<input type="hidden" id="id_afastamento-2-'.$count.'" value="'.($Feriassize >= 2 ? $Ferias[1]['id_afastamento']: "").'">';
echo        '</div>';
echo      '</section><!-- Selecionar Datas-->';
echo      '<section class="col-md-1"> <!-- Numero de Dias -->';
echo        '<label class="control-label">Dias</label>';
echo        '<button type="button" class="btn btn-default underbutton" aria-label="Left Align">'.$d2 = ($Feriassize >= 2 ? date_diff(date_create($Ferias[1]['dt_inicio_afastamento']),date_create($Ferias[1]['dt_fim_afastamento']))->format('%a')+1: "0").'</button>';
echo        '<input type="hidden" id="btnvalor-2-'.$count.'" value="'.$d2.'">';
echo      '</section> <!-- Numero de Dias -->';
echo      '<section class="col-md-3" id="docentedata-3-'.$count.'"> <!-- Selecionar Datas-->';
echo        '<div class="form-group has-feedback has-feedback-right">';
echo          '<label class="control-label">Intervalo 3</label>';
echo          '<i class="form-control-feedback glyphicon glyphicon-calendar"></i>';
echo          '<input type="hidden" class="whichdateid-3" value="3">';
echo          '<input name="escolhe_data" class="input-mini form-control escolhe_data whichdateid-3" type="text" value="'.($Feriassize >= 3 ? $Ferias[2]['dt_inicio_afastamento'].' - '.$Ferias[2]['dt_fim_afastamento']: "").'">';
echo          '<input type="hidden" id="dt_inicio_afastamento-3-'.$count.'" value="'.($Feriassize >= 3 ? $Ferias[2]['dt_inicio_afastamento']: "").'">';
echo          '<input type="hidden" id="dt_fim_afastamento-3-'.$count.'" value="'.($Feriassize >= 3 ? $Ferias[2]['dt_fim_afastamento']: "").'">';
echo          '<input type="hidden" id="id_afastamento-3-'.$count.'" value="'.($Feriassize >= 3 ? $Ferias[2]['id_afastamento']: "").'">';
echo        '</div>';
echo      '</section><!-- Selecionar Datas-->';
echo      '<section class="col-md-1"> <!-- Numero de Dias -->';
echo        '<label class="control-label">Dias</label>';
echo        '<button type="button" class="btn btn-default underbutton" aria-label="Left Align">'.$d3 = ($Feriassize >= 3 ? date_diff(date_create($Ferias[2]['dt_inicio_afastamento']),date_create($Ferias[2]['dt_fim_afastamento']))->format('%a')+1: "0").'</button>';
echo        '<input type="hidden" id="btnvalor-3-'.$count.'" value="'.$d3.'">';
echo      '</section> <!-- Numero de Dias -->';
echo      '<input type="hidden" class="feriasid" value="'.$count.'"> <!-- ID -->';
echo     '</section> <!-- Datas -->';
echo     '<section class="col-md-1"> <!-- Numero de Dias Total -->';
echo        '<label class="control-label">Total</label>';
echo        '<button type="button" class="btn btn-default underbutton" id="btntotal-'.$count.'" aria-label="Left Align">'.($dt = ((int)$d1+(int)$d2+(int)$d3)).'</button>';
echo        '<input type="hidden" class="feriastotal" id="valorferiastotal-'.$count.'" value="'.$dt.'">';
echo     '</section> <!-- Numero de Dias Total -->';
echo    '</section> <!-- Segunda Linha -->';
echo  '</div> <!-- Well -->';	
  
  }
  else{
	  $Docentesize = $Docentesize-1;
  }
}
echo '<input type="hidden" id="docente_count" value="'.$Docentesize.'">';


?>

