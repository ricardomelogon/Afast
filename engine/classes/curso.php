<?php
// Declaracao da classe
// Nome da classe devera ser o nome da tabela respectiva no banco de dados
class Curso {
	
	// Variaveis da classe
	// Nome das variaveis devem ser de acordo com as colunas da tabela respectiva no bd
	private $id_curso;
	private $nome_curso;
	
	// setters
	
	// Funcao que seta uma instancia da classe
	public function SetValues($id_curso, $nome_curso) {
		$this->id_curso = $id_curso;
		$this->nome_curso = $nome_curso;
	}
	
	// Methods
	
	// Funcao que salva a instancia no BD
	public function Create() {
		$sql = "
				INSERT INTO curso 
						  (
				 			id_curso,
				 			nome_curso
						  )  
				VALUES 
					(
				 			'$this->id_curso',
				 			'$this->nome_curso'
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
					 t1.id_curso,
					 t1.nome_curso
				FROM
					curso AS t1
				WHERE
					t1.id_curso  = '$id'

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
					 t1.id_curso,
					 t1.nome_curso
				FROM
					curso AS t1
				ORDER BY t1.nome_curso		

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
					 t1.id_curso,
					 t1.nome_curso
				FROM
					curso AS t1
					
					
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
				UPDATE curso SET
				
				  nome_curso = '$this->nome_curso'
				
				WHERE id_curso = '$this->id_curso';
				
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
				DELETE FROM curso
				WHERE id_curso = '$this->id_curso';
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
	
	/*
	 * --------------------------------------------------
	 * Viewer SPecific methods -- end
	 * --------------------------------------------------
	 *
	 */
	
	// constructor
	function __construct() {
		$this->id_curso;
		$this->nome_curso;
	}
	
	// destructor
	function __destruct() {
		$this->id_curso;
		$this->nome_curso;
	}
}
;

?>
