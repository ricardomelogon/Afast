<?php
require_once "../config.php";

// parte1

$id_afastamento = $_POST ['id_afastamento'];
$dt_inicio_afastamento = $_POST ['dt_inicio_afastamento'];
$dt_fim_afastamento = $_POST ['dt_fim_afastamento'];
$observ_afastamento = $_POST ['observ_afastamento'];
$id_ocorrencia = $_POST ['id_ocorrencia'];
$id_docente = $_POST ['id_docente'];

// parte2
$action = $_POST ['action'];

// parte3
$Item = new Afastamento ();
$Item->SetValues ( $id_afastamento, $dt_inicio_afastamento, $dt_fim_afastamento, $observ_afastamento, $id_ocorrencia, $id_docente );

// parte4
switch ($action) {
	case 'create' :
		
		$res = $Item->ReadAllOverlaps($id_docente, $dt_inicio_afastamento, $dt_fim_afastamento);
		//var_dump($res);
		if(empty($res))
		{
			//var_dump($res);
		  $res = $Item->Create ();
		  if ($res === NULL) {
			  $res = "true";
		  } else {
			  $res = "false";
		  }
		}
		else
		{
			$res = "false";
		}
		  echo $res;
		
		break;
	
	case 'update' :
		$res = $Item->ReadAllOverlapsUpdate($id_docente, $dt_inicio_afastamento, $dt_fim_afastamento);
		//var_dump($res);
		if(empty($res))
		{
			//var_dump($res);
		  $res = $Item->Update ();
		  if ($res === NULL) {
			  $res = 'true';
		  } else {
			  $res = 'false';
		  }
		}
		else
		{
			$res = "false";
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
