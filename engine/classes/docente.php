<?php
// Declaracao da classe
// Nome da classe devera ser o nome da tabela respectiva no banco de dados
class Docente {
	
	// Variaveis da classe
	// Nome das variaveis devem ser de acordo com as colunas da tabela respectiva no bd
	private $id_docente;
	private $nome_docente;
	private $siape_docente;
	private $email_docente;
	private $efetivo_docente;
	
	// setters
	
	// Funcao que seta uma instancia da classe
	public function SetValues($id_docente, $nome_docente, $siape_docente, $email_docente, $efetivo_docente) {
		$this->id_docente = $id_docente;
		$this->nome_docente = $nome_docente;
		$this->siape_docente = $siape_docente;
		$this->email_docente = $email_docente;
		$this->efetivo_docente = $efetivo_docente;
	}
	
	// Methods
	
	// Funcao que salva a instancia no BD
	public function Create() {
		$sql = "
				INSERT INTO docente 
						  (
				 			id_docente,
				 			nome_docente,
				 			siape_docente,
				 			email_docente,
				 			efetivo_docente
						  )  
				VALUES 
					(
				 			'$this->id_docente',
				 			'$this->nome_docente',
				 			'$this->siape_docente',
				 			'$this->email_docente',
				 			'$this->efetivo_docente'
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
					 t1.id_docente,
					 t1.nome_docente,
					 t1.siape_docente,
					 t1.email_docente,
					 t1.efetivo_docente
				FROM
					docente AS t1
				WHERE
					t1.id_docente  = '$id'

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
					 t1.id_docente,
					 t1.nome_docente,
					 t1.siape_docente,
					 t1.email_docente,
					 t1.efetivo_docente
				FROM
					docente AS t1
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
	
	// Funcao que retorna um vetor com todos as instancias da classe no BD com paginacao
	public function ReadAll_Paginacao($inicio, $registros) {
		$sql = "
				SELECT
					 t1.id_docente,
					 t1.nome_docente,
					 t1.siape_docente,
					 t1.email_docente,
					 t1.efetivo_docente
				FROM
					docente AS t1
					
					
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
				UPDATE docente SET
				
				  nome_docente = '$this->nome_docente',
				  siape_docente = '$this->siape_docente',
				  email_docente = '$this->email_docente',
				  efetivo_docente = '$this->efetivo_docente'
				
				WHERE id_docente = '$this->id_docente';
				
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
				DELETE FROM docente
				WHERE id_docente = '$this->id_docente';
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
	
	// Funcao que retorna um vetor com todas as instancias da classe no BD que tem um mesmo curso
	public function ReadAllCurso($id) {
		$sql = "
					SELECT
						t1.id_docente,
						t1.nome_docente,
						t1.siape_docente,
						t1.email_docente,
						t1.efetivo_docente,
						t2.dt_inicio_exercicio,
						t2.dt_fim_exercicio,
						t2.id_exercicio
					FROM
						docente AS t1,
						exercicio AS t2
					WHERE
						t2.id_curso = '$id'
					AND
						t1.id_docente = t2.id_docente
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
	
	// Funcao que retorna um vetor com todas as instancias da classe no BD ativas em uma data
	public function ReadAllOnDate($data) {
		$sql = "
					SELECT
						t1.id_docente,
						t1.nome_docente,
						t1.siape_docente,
						t1.email_docente,
						t1.efetivo_docente,
						t2.dt_inicio_exercicio,
						t2.dt_fim_exercicio,
						t2.id_exercicio
					FROM
						docente AS t1,
						exercicio AS t2
					WHERE
						t2.dt_inicio_exercicio <= '$data'
					AND
						(t2.dt_fim_exercicio >= '$data' OR t2.dt_fim_exercicio IS NULL)
					AND
						t1.id_docente = t2.id_docente
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
	
	public function ReadAllReport($anomes,$id_curso,$efetivo) {
		$sql = "
				  SELECT
					  t1.id_docente,
					  t1.nome_docente,
					  t1.siape_docente,
					  t1.email_docente,
					  t1.efetivo_docente,
					  t2.dt_inicio_exercicio,
					  t2.dt_fim_exercicio,
					  t2.id_exercicio
				  FROM
					  docente AS t1,
					  exercicio AS t2
				  WHERE
					  DATE_FORMAT(STR_TO_DATE('$anomes', '%Y-%m'), '%Y-%m') BETWEEN DATE_FORMAT(t2.dt_inicio_exercicio, '%Y-%m')
				  AND
					  IFNULL(DATE_FORMAT(t2.dt_fim_exercicio, '%Y-%m'),DATE_FORMAT(STR_TO_DATE('$anomes', '%Y-%m'), '%Y-%m'))
					  
				  AND
					  t1.id_docente = t2.id_docente
				  AND
					  t2.id_curso = '$id_curso'
				  AND
					  t1.efetivo_docente = '$efetivo'
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
	/*
	 * --------------------------------------------------
	 * Viewer SPecific methods -- end
	 * --------------------------------------------------
	 *
	 */
	
	// constructor
	function __construct() {
		$this->id_docente;
		$this->nome_docente;
		$this->siape_docente;
		$this->email_docente;
		$this->efetivo_docente;
	}
	
	// destructor
	function __destruct() {
		$this->id_docente;
		$this->nome_docente;
		$this->siape_docente;
		$this->email_docente;
		$this->efetivo_docente;
	}
}
;

?>
