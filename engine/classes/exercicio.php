<?php
// Declaracao da classe
// Nome da classe devera ser o nome da tabela respectiva no banco de dados
class Exercicio {
	
	// Variaveis da classe
	// Nome das variaveis devem ser de acordo com as colunas da tabela respectiva no bd
	private $id_exercicio;
	private $id_docente;
	private $id_curso;
	private $dt_inicio_exercicio;
	private $dt_fim_exercicio;
	
	// setters
	
	// Funcao que seta uma instancia da classe
	public function SetValues($id_exercicio, $id_docente, $id_curso, $dt_inicio_exercicio, $dt_fim_exercicio) {
		$this->id_exercicio = $id_exercicio;
		$this->id_docente = $id_docente;
		$this->id_curso = $id_curso;
		$this->dt_inicio_exercicio = $dt_inicio_exercicio;
		$this->dt_fim_exercicio = $dt_fim_exercicio;
	}
	
	// Methods
	
	// Funcao que salva a instancia no BD
	public function Create() {
		$sql = "
				INSERT INTO exercicio 
						  (
				 			id_exercicio,
				 			id_docente,
				 			id_curso,
				 			dt_inicio_exercicio,
				 			dt_fim_exercicio
						  )  
				VALUES 
					(
				 			'$this->id_exercicio',
				 			'$this->id_docente',
				 			'$this->id_curso',
				 			'$this->dt_inicio_exercicio',
				 			NULL
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
					 t1.id_exercicio,
					 t1.id_docente,
					 t1.id_curso,
					 t1.dt_inicio_exercicio,
					 t1.dt_fim_exercicio
				FROM
					exercicio AS t1
				WHERE
					t1.id_exercicio  = '$id'

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
					 t1.id_exercicio,
					 t1.id_docente,
					 t1.id_curso,
					 t1.dt_inicio_exercicio,
					 t1.dt_fim_exercicio
				FROM
					exercicio AS t1
				ORDER BY t1.dt_inicio_exercicio
				

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
					 t1.id_exercicio,
					 t1.id_docente,
					 t1.id_curso,
					 t1.dt_inicio_exercicio,
					 t1.dt_fim_exercicio
				FROM
					exercicio AS t1
					
					
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
				UPDATE exercicio SET
				
				  id_docente = '$this->id_docente',
				  id_curso = '$this->id_curso',
				  dt_inicio_exercicio = '$this->dt_inicio_exercicio',
				  dt_fim_exercicio = '$this->dt_fim_exercicio'
				
				WHERE id_exercicio = '$this->id_exercicio';
				
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
				DELETE FROM exercicio
				WHERE id_exercicio = '$this->id_exercicio';
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
	public function ReadbyDocente($id) {
		$sql = "
				SELECT
					 t1.id_exercicio,
					 t1.id_docente,
					 t1.id_curso,
					 t1.dt_inicio_exercicio,
					 t1.dt_fim_exercicio
				FROM
					exercicio AS t1
				WHERE
					t1.id_docente  = '$id'
				ORDER BY t1.dt_inicio_exercicio

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
	
	public function ReadAtivos() {
		$sql = "
		SELECT
		t1.id_exercicio,
		t1.id_docente,
		t1.id_curso,
		t1.dt_inicio_exercicio,
		t1.dt_fim_exercicio
		FROM
		exercicio AS t1
		WHERE
		t1.dt_fim_exercicio IS NULL
		OR
		t1.dt_fim_exercicio <= NOW();
		ORDER BY t1.dt_inicio_exercicio
	
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
	
	public function End() {
		$sql = "
				UPDATE exercicio SET
				
				  dt_fim_exercicio = '$this->dt_fim_exercicio'
				
				WHERE id_exercicio = '$this->id_exercicio';
				
			";
		
		$DB = new DB ();
		$DB->open ();
		$result = $DB->query ( $sql );
		$DB->close ();
		return $result;
	}
	public function Activate_Update() {
		$sql = "
				UPDATE exercicio SET
				
				  id_docente = '$this->id_docente',
				  id_curso = '$this->id_curso',
				  dt_inicio_exercicio = '$this->dt_inicio_exercicio',
				  dt_fim_exercicio = NULL
				
				WHERE id_exercicio = '$this->id_exercicio';
				
			";
		
		$DB = new DB ();
		$DB->open ();
		$result = $DB->query ( $sql );
		$DB->close ();
		return $result;
	}
	
	/*
	 * --------------------------------------------------
	 * Viewer SPecific methods -- end
	 * --------------------------------------------------
	 *
	 */
	
	// constructor
	function __construct() {
		$this->id_exercicio;
		$this->id_docente;
		$this->id_curso;
		$this->dt_inicio_exercicio;
		$this->dt_fim_exercicio;
	}
	
	// destructor
	function __destruct() {
		$this->id_exercicio;
		$this->id_docente;
		$this->id_curso;
		$this->dt_inicio_exercicio;
		$this->dt_fim_exercicio;
	}
}
;

?>
