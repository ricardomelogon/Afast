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
echo          '<input name="escolhe_data" class="input-mini form-control escolhe_data whichdateid-1" type="text">';
echo          '<input type="hidden" id="dt_inicio_afastamento-1-'.$count.'">';
echo          '<input type="hidden" id="dt_fim_afastamento-1-'.$count.'">';
echo        '</div>';
echo      '</section><!-- Selecionar Datas-->';
echo      '<section class="col-md-1"> <!-- Numero de Dias -->';
echo        '<label class="control-label">Dias</label>';
echo        '<button type="button" class="btn btn-default underbutton" aria-label="Left Align">0</button>';
echo        '<input type="hidden" id="btnvalor-1-'.$count.'" value="0">';
echo      '</section> <!-- Numero de Dias -->';
echo      '<section class="col-md-3" id="docentedata-2-'.$count.'"> <!-- Selecionar Datas-->';
echo        '<div class="form-group has-feedback has-feedback-right">';
echo          '<label class="control-label">Intervalo 2</label>';
echo          '<i class="form-control-feedback glyphicon glyphicon-calendar"></i>';
echo          '<input type="hidden" class="whichdateid-2" value="2">';
echo          '<input name="escolhe_data" class="input-mini form-control escolhe_data whichdateid-2" type="text">';
echo          '<input type="hidden" id="dt_inicio_afastamento-2-'.$count.'">';
echo          '<input type="hidden" id="dt_fim_afastamento-2-'.$count.'">';
echo        '</div>';
echo      '</section><!-- Selecionar Datas-->';
echo      '<section class="col-md-1"> <!-- Numero de Dias -->';
echo        '<label class="control-label">Dias</label>';
echo        '<button type="button" class="btn btn-default underbutton" aria-label="Left Align">0</button>';
echo        '<input type="hidden" id="btnvalor-2-'.$count.'" value="0">';
echo      '</section> <!-- Numero de Dias -->';
echo      '<section class="col-md-3" id="docentedata-3-'.$count.'"> <!-- Selecionar Datas-->';
echo        '<div class="form-group has-feedback has-feedback-right">';
echo          '<label class="control-label">Intervalo 3</label>';
echo          '<i class="form-control-feedback glyphicon glyphicon-calendar"></i>';
echo          '<input type="hidden" class="whichdateid-3" value="3">';
echo          '<input name="escolhe_data" class="input-mini form-control escolhe_data" type="text">';
echo          '<input type="hidden" id="dt_inicio_afastamento-3-'.$count.'">';
echo          '<input type="hidden" id="dt_fim_afastamento-3-'.$count.'">';
echo        '</div>';
echo      '</section><!-- Selecionar Datas-->';
echo      '<section class="col-md-1"> <!-- Numero de Dias -->';
echo        '<label class="control-label">Dias</label>';
echo        '<button type="button" class="btn btn-default underbutton" aria-label="Left Align">0</button>';
echo        '<input type="hidden" id="btnvalor-3-'.$count.'" value="0">';
echo      '</section> <!-- Numero de Dias -->';
echo      '<input type="hidden" class="feriasid" value="'.$count.'"> <!-- ID -->';
echo     '</section> <!-- Datas -->';
echo     '<section class="col-md-1"> <!-- Numero de Dias Total -->';
echo        '<label class="control-label">Total</label>';
echo        '<button type="button" class="btn btn-default underbutton" id="btntotal-'.$count.'" aria-label="Left Align">0</button>';
echo        '<input type="hidden" class="feriastotal" id="valorferiastotal-'.$count.'">';
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

