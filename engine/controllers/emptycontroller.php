<?php
require_once "../config.inc";

// parte1

$CAMPOTABELA1 = $_POST ['CAMPOTABELA1'];
$CAMPOTABELA2 = $_POST ['CAMPOTABELA2'];
$CAMPOTABELA3 = $_POST ['CAMPOTABELA3'];

// parte2
$action = $_POST ['action'];

// parte3
$Item = new NOME_DA_CLASSE ();
$Item->SetValues ( $CAMPOTABELA1, $CAMPOTABELA2, $CAMPOTABELA3 );

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