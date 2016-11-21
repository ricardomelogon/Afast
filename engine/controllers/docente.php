<?php
require_once "../config.php";

// parte1

$id_docente = $_POST ['id_docente'];
$nome_docente = $_POST ['nome_docente'];
$siape_docente = $_POST ['siape_docente'];
$email_docente = $_POST ['email_docente'];
$efetivo_docente = $_POST ['efetivo_docente'];

// parte2
$action = $_POST ['action'];

// parte3
$Item = new Docente ();
$Item->SetValues ( $id_docente, $nome_docente, $siape_docente, $email_docente, $efetivo_docente );

// var_dump($Item);

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
