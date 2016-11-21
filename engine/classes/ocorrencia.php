<?php
// Declaracao da classe
// Nome da classe devera ser o nome da tabela respectiva no banco de dados
class Ocorrencia {
	
	// Variaveis da classe
	// Nome das variaveis devem ser de acordo com as colunas da tabela respectiva no bd
	private $id_ocorrencia;
	private $tipo_ocorrencia;
	private $codigo_ocorrencia;
	
	// setters
	
	// Funcao que seta uma instancia da classe
	public function SetValues($id_ocorrencia, $tipo_ocorrencia, $codigo_ocorrencia) {
		$this->id_ocorrencia = $id_ocorrencia;
		$this->tipo_ocorrencia = $tipo_ocorrencia;
		$this->codigo_ocorrencia = $codigo_ocorrencia;
	}
	
	// Methods
	
	// Funcao que salva a instancia no BD
	public function Create() {
		$sql = "
				INSERT INTO ocorrencia 
						  (
				 			id_ocorrencia,
				 			tipo_ocorrencia,
				 			codigo_ocorrencia
						  )  
				VALUES 
					(
				 			'$this->id_ocorrencia',
				 			'$this->tipo_ocorrencia',
				 			'$this->codigo_ocorrencia'
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
					 t1.id_ocorrencia,
					 t1.tipo_ocorrencia,
					 t1.codigo_ocorrencia
				FROM
					ocorrencia AS t1
				WHERE
					t1.id_ocorrencia  = '$id'

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
					 t1.id_ocorrencia,
					 t1.tipo_ocorrencia,
					 t1.codigo_ocorrencia
				FROM
					ocorrencia AS t1
					
				ORDER BY t1.tipo_ocorrencia
				

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
					 t1.id_ocorrencia,
					 t1.tipo_ocorrencia,
					 t1.codigo_ocorrencia
				FROM
					ocorrencia AS t1
					
					
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
				UPDATE ocorrencia SET
				
				  tipo_ocorrencia = '$this->tipo_ocorrencia',
				  codigo_ocorrencia = '$this->codigo_ocorrencia'
				
				WHERE id_ocorrencia = '$this->id_ocorrencia';
				
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
				DELETE FROM ocorrencia
				WHERE id_ocorrencia = '$this->id_ocorrencia';
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
		$this->id_ocorrencia;
		$this->tipo_ocorrencia;
		$this->codigo_ocorrencia;
	}
	
	// destructor
	function __destruct() {
		$this->id_ocorrencia;
		$this->tipo_ocorrencia;
		$this->codigo_ocorrencia;
	}
}
;

?>
