<?php
require_once "../config.php";

// parte1

$id_administrador = $_POST ['id_administrador'];
$login_administrador = $_POST ['login_administrador'];
$senha_administrador = $_POST ['senha_administrador'];
$nome_administrador = $_POST ['nome_administrador'];

// parte2
$action = $_POST ['action'];

// parte3
$Item = new Administrador ();
$Item->SetValues ( $id_administrador, $login_administrador, $senha_administrador, $nome_administrador );

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
