<?php
require_once "../config.php";

// parte1

$id_exercicio = $_POST ['id_exercicio'];
$id_docente = $_POST ['id_docente'];
$id_curso = $_POST ['id_curso'];
$dt_inicio_exercicio = $_POST ['dt_inicio_exercicio'];
$dt_fim_exercicio = $_POST ['dt_fim_exercicio'];

// parte2
$action = $_POST ['action'];
if ($dt_fim_exercicio == "0000-00-00") {
	$action = "activate-update";
}
// parte3
$Item = new Exercicio ();
$Item->SetValues ( $id_exercicio, $id_docente, $id_curso, $dt_inicio_exercicio, $dt_fim_exercicio );

// parte4
switch ($action) {
	case 'create' :
		
		$res = $Item->Create ();
		if ($res === NULL) {
			$res = "true";
		} else {
			$res = "false";
		}
		
		echo $res;
		
		break;
	
	case 'update' :
		
		$res = $Item->Update ();
		
		if ($res === NULL) {
			$res = 'true';
		} else {
			$res = 'false';
		}
		echo $res;
		
		break;
	
	case 'delete' :
		
		$res = $Item->Delete ();
		if ($res === NULL) {
			$res = 'true';
		} else {
			$res = 'false';
		}
		echo $res;
		
		break;
	
	case 'end' :
		
		$res = $Item->End ();
		if ($res === NULL) {
			$res = 'true';
		} else {
			$res = 'false';
		}
		echo $res;
		
		break;
	
	case 'activate-update' :
		
		$res = $Item->Activate_Update ();
		if ($res === NULL) {
			$res = 'true';
		} else {
			$res = 'false';
		}
		echo $res;
		
		break;
}
?>
