<?php
// Declaracao da classe
// Nome da classe devera ser o nome da tabela respectiva no banco de dados
class Ferias {
	
	// Variaveis da classe
	// Nome das variaveis devem ser de acordo com as colunas da tabela respectiva no bd
	private $id_ferias;
	private $ano_ferias;
	private $id_afastamento;
	private $dt_inicio_afastamento;
	private $dt_fim_afastamento;
	private $observ_afastamento;
	private $id_ocorrencia;
	private $id_docente;
	
	// setters
	
	// Funcao que seta uma instancia da classe
	public function SetValues($id_ferias, $ano_ferias, $id_afastamento, $dt_inicio_afastamento, $dt_fim_afastamento, $observ_afastamento, $id_ocorrencia, $id_docente) {
		$this->id_ferias = $id_ferias;
		$this->ano_ferias = $ano_ferias;
		$this->id_afastamento = $id_afastamento;
		$this->dt_inicio_afastamento = $dt_inicio_afastamento;
		$this->dt_fim_afastamento = $dt_fim_afastamento;
		$this->observ_afastamento = $observ_afastamento;
		$this->id_ocorrencia = $id_ocorrencia;
		$this->id_docente = $id_docente;
	}
	
	// Methods
	
	// Funcao que salva a instancia no BD
	public function Create() {
		$sql1 = "
				INSERT INTO afastamento 
				(
					id_afastamento,
					dt_inicio_afastamento,
					dt_fim_afastamento,
					observ_afastamento,
					id_ocorrencia,
					id_docente
				)
				VALUES 
				(
					'$this->id_afastamento',
					'$this->dt_inicio_afastamento',
					'$this->dt_fim_afastamento',
					'$this->observ_afastamento',
					'$this->id_ocorrencia',
					'$this->id_docente'
				);
			";
		
		$sql2 = "	
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
					LASTID
				);
			";
		$DB = new DB ();
		$DB->open ();
		$result = $DB->trquery ( $sql1, $sql2 );
		$DB->close ();
		// var_dump($result);
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
	
	public function ReadAllDocenteAno($ano, $id) {
		$sql = "
				SELECT
					t1.ano_ferias AS ano_ferias,
					t2.id_afastamento AS id_afastamento, 
					t2.dt_inicio_afastamento AS dt_inicio_afastamento, 
					t2.dt_fim_afastamento AS dt_fim_afastamento, 
					t2.observ_afastamento AS observ_afastamento, 
					t2.id_ocorrencia AS id_ocorrencia, 
					t2.id_docente AS id_docente
				FROM
				  ferias t1 
				
				  INNER JOIN afastamento t2 
					  ON
					  t1.id_afastamento = t2.id_afastamento
				
				WHERE
					t1.ano_ferias = '$ano'
				AND
					t2.id_docente = '$id'
				ORDER BY t2.dt_inicio_afastamento
				

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
		$this->dt_inicio_afastamento;
		$this->dt_fim_afastamento;
		$this->observ_afastamento;
		$this->id_ocorrencia;
		$this->id_docente;
	}
	
	// destructor
	function __destruct() {
		$this->id_ferias;
		$this->ano_ferias;
		$this->id_afastamento;
		$this->dt_inicio_afastamento;
		$this->dt_fim_afastamento;
		$this->observ_afastamento;
		$this->id_ocorrencia;
		$this->id_docente;
	}
}
;

?>
