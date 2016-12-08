<?php
// Declaracao da classe
// Nome da classe devera ser o nome da tabela respectiva no banco de dados
class Ferias {
	
	// Variaveis da classe
	// Nome das variaveis devem ser de acordo com as colunas da tabela respectiva no bd
	private $id_ferias;
	private $ano_ferias;
	private $id_afastamento;
	
	// setters
	
	// Funcao que seta uma instancia da classe
	public function SetValues($id_ferias, $ano_ferias, $id_afastamento) {
		$this->id_ferias = $id_ferias;
		$this->ano_ferias = $ano_ferias;
		$this->id_afastamento = $id_afastamento;
	}
	
	// Methods
	
	// Funcao que salva a instancia no BD
	public function Create() {
		$sql = "
				INSERT INTO ferias 
						  (
				 			id_ferias,
				 			ano_ferias,
				 			id_afastamento
						  )  
				VALUES 
					(
				 			'$this->id_ferias',
				 			'$this->ano_ferias',
				 			'$this->id_afastamento'
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
					 t1.id_ferias,
					 t1.ano_ferias,
					 t1.id_afastamento
				FROM
					ferias AS t1
				WHERE
					t1.id_ferias  = '$id'

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
					 t1.id_ferias,
					 t1.ano_ferias,
					 t1.id_afastamento
				FROM
					ferias AS t1
				ORDER BY t1.ano_ferias	
				

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
					 t1.id_ferias,
					 t1.ano_ferias,
					 t1.id_afastamento
				FROM
					ferias AS t1
					
					
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
				UPDATE ferias SET
				
				  ano_ferias = '$this->ano_ferias',
				  id_afastamento = '$this->id_afastamento'
				
				WHERE id_ferias = '$this->id_ferias';
				
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
				DELETE FROM ferias
				WHERE id_ferias = '$this->id_ferias';
			";
		$DB = new DB ();
		
		$DB->open ();
		$result = $DB->query ( $sql );
		$DB->close ();
		// var_dump($result);
		return $result;
	}
	
	/*
	 * --------------------------------------------------
	 * Viewer SPecific methods -- begin
	 * --------------------------------------------------
	 *
	 */
	
	public function ReadAfast($id) {
		$sql = "
				SELECT
					 t1.id_ferias,
					 t1.ano_ferias,
					 t1.id_afastamento
				FROM
					ferias AS t1
				WHERE
					t1.id_afastamento  = '$id'

			";
		
		$DB = new DB ();
		$DB->open ();
		$Data = $DB->fetchData ( $sql );
		
		$DB->close ();
		return $Data [0];
	}
	
	
	
	public function ReadAllAno($ano) {
		$sql = "
				SELECT
					 t1.id_ferias,
					 t1.ano_ferias,
					 t1.id_afastamento
				FROM
					ferias AS t1
				WHERE
					t1.ano_ferias = '$ano'
				ORDER BY t1.ano_ferias	
				

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

	/*
	 * --------------------------------------------------
	 * Viewer SPecific methods -- end
	 * --------------------------------------------------
	 *
	 */
	
	// constructor
	function __construct() {
		$this->id_ferias;
		$this->ano_ferias;
		$this->id_afastamento;
	}
	
	// destructor
	function __destruct() {
		$this->id_ferias;
		$this->ano_ferias;
		$this->id_afastamento;
	}
}
;

?>
