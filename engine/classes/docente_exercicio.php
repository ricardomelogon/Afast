<?php
// Declaracao da classe
// Nome da classe devera ser o nome da tabela respectiva no banco de dados
class Docente_Exercicio {
	
	// Variaveis da classe
	// Nome das variaveis devem ser de acordo com as colunas da tabela respectiva no bd
	private $id_docente;
	private $nome_docente;
	private $siape_docente;
	private $email_docente;
	private $efetivo_docente;
	private $id_exercicio;
	private $id_curso;
	private $dt_inicio_exercicio;
	private $dt_fim_exercicio;
	
	// setters
	
	// Funcao que seta uma instancia da classe
	public function SetValues($id_docente, $nome_docente, $siape_docente, $email_docente, $efetivo_docente, $id_exercicio, $id_curso, $dt_inicio_exercicio, $dt_fim_exercicio) {
		$this->id_docente = $id_docente;
		$this->nome_docente = $nome_docente;
		$this->siape_docente = $siape_docente;
		$this->email_docente = $email_docente;
		$this->efetivo_docente = $efetivo_docente;
		$this->id_exercicio = $id_exercicio;
		$this->id_curso = $id_curso;
		$this->dt_inicio_exercicio = $dt_inicio_exercicio;
		$this->dt_fim_exercicio = $dt_fim_exercicio;
	}
	
	// Methods
	
	// Funcao que salva a instancia no BD
	public function Create() {
		$sql1 = "
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
		
		$sql2 = "	
				INSERT INTO exercicio 
				(
					
					id_docente,
					id_curso,
					dt_inicio_exercicio,
					dt_fim_exercicio,
					id_exercicio
				)  
				VALUES 
				(
					LASTID,
					'$this->id_curso',
					'$this->dt_inicio_exercicio',
					null,
					'$this->id_exercicio'
				);
			";
		$DB = new DB ();
		$DB->open ();
		$result = $DB->trquery ( $sql1, $sql2 );
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
		$this->id_exercicio;
		$this->id_curso;
		$this->dt_inicio_exercicio;
		$this->dt_fim_exercicio;
	}
	
	// destructor
	function __destruct() {
		$this->id_docente;
		$this->nome_docente;
		$this->siape_docente;
		$this->email_docente;
		$this->efetivo_docente;
		$this->id_exercicio;
		$this->id_curso;
		$this->dt_inicio_exercicio;
		$this->dt_fim_exercicio;
	}
}
;

?>
