<?php
// Declaracao da classe
// Nome da classe devera ser o nome da tabela respectiva no banco de dados
class Afastamento {
	
	// Variaveis da classe
	// Nome das variaveis devem ser de acordo com as colunas da tabela respectiva no bd
	private $id_afastamento;
	private $dt_inicio_afastamento;
	private $dt_fim_afastamento;
	private $observ_afastamento;
	private $id_ocorrencia;
	private $id_docente;
	
	// setters
	
	// Funcao que seta uma instancia da classe
	public function SetValues($id_afastamento, $dt_inicio_afastamento, $dt_fim_afastamento, $observ_afastamento, $id_ocorrencia, $id_docente) {
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
		$sql = "
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
					 t1.id_afastamento,
					 t1.dt_inicio_afastamento,
					 t1.dt_fim_afastamento,
					 t1.observ_afastamento,
					 t1.id_ocorrencia,
					 t1.id_docente
				FROM
					afastamento AS t1
				WHERE
					t1.id_afastamento  = '$id'

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
					 t1.id_afastamento,
					 t1.dt_inicio_afastamento,
					 t1.dt_fim_afastamento,
					 t1.observ_afastamento,
					 t1.id_ocorrencia,
					 t1.id_docente
				FROM
					afastamento AS t1
				ORDER BY t1.dt_inicio_afastamento
				

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
					 t1.id_afastamento,
					 t1.dt_inicio_afastamento,
					 t1.dt_fim_afastamento,
					 t1.observ_afastamento,
					 t1.id_ocorrencia,
					 t1.id_docente
				FROM
					afastamento AS t1
					
					
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
				UPDATE afastamento SET
				
				  dt_inicio_afastamento = '$this->dt_inicio_afastamento',
				  dt_fim_afastamento = '$this->dt_fim_afastamento',
				  observ_afastamento = '$this->observ_afastamento',
				  id_ocorrencia = '$this->id_ocorrencia',
				  id_docente = '$this->id_docente'
				
				WHERE id_afastamento = '$this->id_afastamento';
				
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
				DELETE FROM afastamento
				WHERE id_afastamento = '$this->id_afastamento';
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
	// Funcao que retorna um vetor com as instancias da classe no BD relacionados ao $id do Docente
	public function ReadAllDocente($id) {
		$sql = "
		SELECT
			t1.id_afastamento,
			t1.dt_inicio_afastamento,
			t1.dt_fim_afastamento,
			t1.observ_afastamento,
			t1.id_ocorrencia,
			t1.id_docente,
			t2.tipo_ocorrencia,
			t2.codigo_ocorrencia
		FROM
			afastamento AS t1
		INNER JOIN ocorrencia AS t2 ON t1.id_ocorrencia = t2.id_ocorrencia
		WHERE
			t1.id_docente = '$id'
		ORDER BY t1.dt_inicio_afastamento
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
	
	public function ReadAllOverlaps($id, $startdate, $enddate) {
		$sql = "
			  SELECT
				  t1.id_afastamento,
				  t1.dt_inicio_afastamento,
				  t1.dt_fim_afastamento,
				  t1.observ_afastamento,
				  t1.id_ocorrencia,
				  t1.id_docente,
				  t2.tipo_ocorrencia,
				  t2.codigo_ocorrencia
			  FROM
				  afastamento AS t1
			  INNER JOIN ocorrencia AS t2 ON t1.id_ocorrencia = t2.id_ocorrencia
			  WHERE
				  t1.id_docente = '$id'
			  AND
				  '$startdate' <= t1.dt_fim_afastamento
			  AND 
				  '$enddate' >= t1.dt_inicio_afastamento
			  ORDER BY t1.dt_inicio_afastamento
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
	
	public function ReadAllOverlapsUpdate($id, $startdate, $enddate) {
		$sql = "
			  SELECT
				  t1.id_afastamento,
				  t1.dt_inicio_afastamento,
				  t1.dt_fim_afastamento,
				  t1.observ_afastamento,
				  t1.id_ocorrencia,
				  t1.id_docente,
				  t2.tipo_ocorrencia,
				  t2.codigo_ocorrencia
			  FROM
				  afastamento AS t1
			  INNER JOIN ocorrencia AS t2 ON t1.id_ocorrencia = t2.id_ocorrencia
			  WHERE
				  t1.id_docente = '$id'
			  AND
				  '$startdate' <= t1.dt_fim_afastamento
			  AND 
				  '$enddate' >= t1.dt_inicio_afastamento
			  AND
				  '$this->id_afastamento' != t1.id_afastamento
			  ORDER BY t1.dt_inicio_afastamento
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
	
	public function ReadAllDocenteMes($id, $mes, $ano) {
		$sql = "
		SELECT
		t1.id_afastamento,
		t1.dt_inicio_afastamento,
		t1.dt_fim_afastamento,
		t1.observ_afastamento,
		t1.id_ocorrencia,
		t1.id_docente,
		t2.tipo_ocorrencia,
		t2.codigo_ocorrencia
		FROM
		afastamento AS t1
		INNER JOIN ocorrencia AS t2 ON t1.id_ocorrencia = t2.id_ocorrencia
		WHERE
		t1.id_docente = '$id'
		AND 
		'$mes'	
			BETWEEN 
				MONTH(t1.dt_inicio_afastamento) 
				AND 
				MONTH(t1.dt_fim_afastamento) 
		AND '$ano' 
			BETWEEN 
				YEAR(t1.dt_inicio_afastamento) 
				AND 
				YEAR(t1.dt_fim_afastamento)
		ORDER BY t1.dt_inicio_afastamento
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
	
	
	
		public function ReadAllReport($anomes,$id_curso) {
		$sql = "
				SELECT
				  t1.nome_docente AS nome_docente,
				  t1.siape_docente AS siape_docente,
				  t2.dt_inicio_afastamento AS dt_inicio_afastamento,
				  t2.dt_fim_afastamento AS dt_fim_afastamento,
				  t2.observ_afastamento AS observ_afastamento,
				  t3.tipo_ocorrencia AS tipo_ocorrencia,
				  t3.codigo_ocorrencia AS codigo_ocorrencia
				  FROM
					  docente t1 
				  
					  LEFT JOIN afastamento t2 
						  ON
						  t1.id_docente = t2.id_docente
								  
					  LEFT JOIN ocorrencia t3 
						  ON
						  t2.id_ocorrencia = t3.id_ocorrencia
				  
					  LEFT JOIN exercicio t4 
						  ON
						  t1.id_docente = t4.id_docente
				  
				  WHERE
						DATE_FORMAT(STR_TO_DATE('$anomes', '%Y-%m'), '%Y-%m') 
					BETWEEN 
						DATE_FORMAT(t2.dt_inicio_afastamento, '%Y-%m')
					AND
						IFNULL(DATE_FORMAT(t2.dt_fim_afastamento, '%Y-%m'),DATE_FORMAT(STR_TO_DATE('$anomes', '%Y-%m'), '%Y-%m'))  
				  AND
					  
					t4.id_curso = '$id_curso'
					  
				  ORDER BY t1.nome_docente
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
	
	public function ReadAllOcorrenciaFerias($id) {
		$sql = "
		SELECT
			t1.id_afastamento,
			t1.dt_inicio_afastamento,
			t1.dt_fim_afastamento,
			t1.id_docente,
			t2.nome_docente
		FROM
			afastamento AS t1
		INNER JOIN docente AS t2 ON t1.id_docente = t2.id_docente
			INNER JOIN exercicio AS t3 ON t2.id_docente = t3.id_docente
				LEFT JOIN ferias AS t4 ON t1.id_afastamento = t4.id_afastamento 
		WHERE
			t1.id_ocorrencia = 37
		AND
			t3.id_curso = '$id'
		AND
			t4.id_afastamento IS NULL
		ORDER BY t2.nome_docente
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
	
	public function ReadAllOcorrenciaFeriasDocente($curso, $docente) {
		$sql = "
		SELECT
			t1.id_afastamento,
			t1.dt_inicio_afastamento,
			t1.dt_fim_afastamento,
			t1.id_docente,
			t2.nome_docente,
			t4.ano_ferias,
			t4.id_ferias
		FROM
			afastamento AS t1
		INNER JOIN docente AS t2 ON t1.id_docente = t2.id_docente
			INNER JOIN exercicio AS t3 ON t2.id_docente = t3.id_docente
				INNER JOIN ferias AS t4 ON t1.id_afastamento = t4.id_afastamento 
		WHERE
			t1.id_ocorrencia = 37
		AND
			t3.id_curso = '$curso'
		AND
			t1.id_docente = '$docente'
		ORDER BY t1.dt_inicio_afastamento
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
		$this->id_afastamento;
		$this->dt_inicio_afastamento;
		$this->dt_fim_afastamento;
		$this->observ_afastamento;
		$this->id_ocorrencia;
		$this->id_docente;
	}
	
	// destructor
	function __destruct() {
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
