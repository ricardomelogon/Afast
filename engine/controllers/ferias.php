<?php
require_once "../config.php";

// parte1

$id_ferias = $_POST ['id_ferias'];
$ano_ferias = $_POST ['ano_ferias'];
$id_afastamento = $_POST ['id_afastamento'];

// parte2
$action = $_POST ['action'];

// parte3
$Item = new Ferias ();
$Item->SetValues ( $id_ferias, $ano_ferias, $id_afastamento );

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
