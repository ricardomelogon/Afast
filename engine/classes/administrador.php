<?php
// Declaracao da classe
// Nome da classe devera ser o nome da tabela respectiva no banco de dados
class Administrador {
	
	// Variaveis da classe
	// Nome das variaveis devem ser de acordo com as colunas da tabela respectiva no bd
	private $id_administrador;
	private $login_administrador;
	private $senha_administrador;
	private $nome_administrador;
	
	// setters
	
	// Funcao que seta uma instancia da classe
	public function SetValues($id_administrador, $login_administrador, $senha_administrador, $nome_administrador) {
		$this->id_administrador = $id_administrador;
		$this->login_administrador = $login_administrador;
		$this->senha_administrador = sha1($senha_administrador);
		$this->nome_administrador = $nome_administrador;
	}
	
	// Methods
	
	// Funcao que salva a instancia no BD
	public function Create() {
		$sql = "
				INSERT INTO administrador 
						  (
				 			id_administrador,
				 			login_administrador,
				 			senha_administrador,
				 			nome_administrador
						  )  
				VALUES 
					(
				 			'$this->id_administrador',
				 			'$this->login_administrador',
				 			'$this->senha_administrador',
				 			'$this->nome_administrador'
					);
			";
		
		$DB = new DB ();
		$DB->open ();
		$result = $DB->query ( $sql );
		$DB->close ();
		return $result;
	}
	
	// Funcao que retorna uma Instancia especifica da classe no bd
	public function Read($id) {
		$sql = "
				SELECT
					 t1.id_administrador,
					 t1.login_administrador,
					 t1.senha_administrador,
					 t1.nome_administrador
				FROM
					administrador AS t1
				WHERE
					t1.id_administrador  = '$id'

			";
		
		$DB = new DB ();
		$DB->open ();
		$Data = $DB->fetchData ( $sql );
		
		$DB->close ();
		return $Data [0];
	}
	
	// Funcao que retorna um vetor com todos as instancias da classe no BD
	public function ReadAll() {
		$sql = "
				SELECT
					 t1.id_administrador,
					 t1.login_administrador,
					 t1.senha_administrador,
					 t1.nome_administrador
				FROM
					administrador AS t1
				ORDER BY t1.nome_administrador
				

			";
		
		$DB = new DB ();
		$DB->open ();
		$Data = $DB->fetchData ( $sql );
		$realData;
		if ($Data == NULL) {
			$realData = $Data;
		} else {
			
			foreach ( $Data as $itemData ) {
				if (is_bool ( $itemData ))
					continue;
				else {
					$realData [] = $itemData;
				}
			}
		}
		$DB->close ();
		return $realData;
	}
	
	// Funcao que retorna um vetor com todos as instancias da classe no BD com paginacao
	public function ReadAll_Paginacao($inicio, $registros) {
		$sql = "
				SELECT
					 t1.id_administrador,
					 t1.login_administrador,
					 t1.senha_administrador,
					 t1.nome_administrador
				FROM
					administrador AS t1
					
					
				LIMIT $inicio, $registros;
			";
		
		$DB = new DB ();
		$DB->open ();
		$Data = $DB->fetchData ( $sql );
		
		$DB->close ();
		return $Data;
	}
	
	// Funcao que atualiza uma instancia no BD
	public function Update() {
		$sql = "
				UPDATE administrador SET
				
				  login_administrador = '$this->login_administrador',
				  senha_administrador = '$this->senha_administrador',
				  nome_administrador = '$this->nome_administrador'
				
				WHERE id_administrador = '$this->id_administrador';
				
			";
		
		$DB = new DB ();
		$DB->open ();
		$result = $DB->query ( $sql );
		$DB->close ();
		return $result;
	}
	
	// Funcao que deleta uma instancia no BD
	public function Delete() {
		$sql = "
				DELETE FROM administrador
				WHERE id_administrador = '$this->id_administrador';
			";
		$DB = new DB ();
		
		$DB->open ();
		$result = $DB->query ( $sql );
		$DB->close ();
		return $result;
	}
	
	/*
	 * --------------------------------------------------
	 * Viewer SPecific methods -- begin
	 * --------------------------------------------------
	 *
	 */
	public function ReadByEmail($email) {
		$sql = "
				SELECT t1.id_administrador,					 
					 t1.login_administrador,
					 t1.senha_administrador,					 
					 t1.nome_administrador
				FROM
					administrador AS t1
				WHERE
					t1.login_administrador = '$email'

			";
		
		$DB = new DB ();
		$DB->open ();
		$Data = $DB->fetchData ( $sql );
		
		$DB->close ();
		return $Data [0];
	}
	
	/*
	 * --------------------------------------------------
	 * Viewer SPecific methods -- end
	 * --------------------------------------------------
	 *
	 */
	
	// constructor
	function __construct() {
		$this->id_administrador;
		$this->login_administrador;
		$this->senha_administrador;
		$this->nome_administrador;
	}
	
	// destructor
	function __destruct() {
		$this->id_administrador;
		$this->login_administrador;
		$this->senha_administrador;
		$this->nome_administrador;
	}
}
;

?>
