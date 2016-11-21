<?php

session_start ();

require_once "../config.php";

// 1. Receber os dados do form
$email = $_POST ['email'];
$senha = sha1($_POST['senha']);

$res;

// 2. Validar os dados

$Usuario = new Administrador ();
$Usuario = $Usuario->ReadByEmail ( $email );

if ($Usuario === NULL) {
	$res = 'no_user_found';
	session_destroy ();
} else {
	$verificaEmail = strcmp ( $email, $Usuario ['login_administrador'] );
	if ($verificaEmail === 0) {
		$verificaSenha = strcmp ( $senha, $Usuario ['senha_administrador'] );
		if ($verificaSenha === 0) {
			
			$_SESSION ['id_user'] = $Usuario ['id_administrador'];
			$_SESSION ['name_user'] = $Usuario ['login_administrador'];
			
			$res = 'true';
		} else {
			$res = 'wrong_password';
			session_destroy ();
		}
	} else {
		$res = 'wrong_user_found';
		session_destroy ();
	}
}

echo $res;

?>