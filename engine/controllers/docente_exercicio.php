<?php
require_once "../config.php";

// parte1

$id_docente = '';
$nome_docente = $_POST ['nome_docente'];
$siape_docente = $_POST ['siape_docente'];
$email_docente = $_POST ['email_docente'];
$efetivo_docente = $_POST ['efetivo_docente'];
$id_exercicio = '';
$id_curso = $_POST ['id_curso'];
$dt_inicio_exercicio = $_POST ['dt_inicio_exercicio'];
$dt_fim_exercicio = '';

// parte2
$action = $_POST ['action'];

// parte3
$Item = new Docente_Exercicio ();
$Item->SetValues ( $id_docente, $nome_docente, $siape_docente, $email_docente, $efetivo_docente, $id_exercicio, $id_curso, $dt_inicio_exercicio, $dt_fim_exercicio );

// var_dump($Item);

// parte4
switch ($action) {
	case 'create' :
		
		$res = $Item->Create ();
		// var_dump($res);
		if ($res === NULL) {
			$res = "true";
		} else {
			$res = "false";
		}
		
		echo $res;
		
		break;
}
?>
