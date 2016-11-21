<?php
require_once "../config.php";

// parte1

$id_curso = $_POST ['id_curso'];
$nome_curso = $_POST ['nome_curso'];

// parte2
$action = $_POST ['action'];

// parte3
$Item = new Curso ();
$Item->SetValues ( $id_curso, $nome_curso );

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
}
?>
