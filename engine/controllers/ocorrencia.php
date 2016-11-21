<?php
require_once "../config.php";

// parte1

$id_ocorrencia = $_POST ['id_ocorrencia'];
$tipo_ocorrencia = $_POST ['tipo_ocorrencia'];
$codigo_ocorrencia = $_POST ['codigo_ocorrencia'];

// parte2
$action = $_POST ['action'];

// parte3
$Item = new Ocorrencia ();
$Item->SetValues ( $id_ocorrencia, $tipo_ocorrencia, $codigo_ocorrencia );

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
