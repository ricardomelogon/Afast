<option> Selecione um Docente...</option>
<?php
require_once('../../engine/config.php');
$SelCurso = $_POST ['selcurso'];
//var_dump($SelCurso);
$Docente = new Docente();
$Docente = $Docente->ReadAllCurso($SelCurso);
foreach ( $Docente as $docenteRow ){
	echo '<option value="'.$docenteRow['id_docente'].'" class="sel_docente">'.$docenteRow['nome_docente'].' </option>';
}
?>