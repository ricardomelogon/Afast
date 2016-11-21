<script>
	$(document).ready(function(e) {
		
		$('#datepicker').datepicker({
			format: "yyyy-mm-dd",
			todayBtn: "linked",
			language: "pt-BR"			
		});	
		$('#datepicker').on("changeDate", function() {
    		$('#datafinal').val(
        		$('#datepicker').datepicker('getFormattedDate')
    		);
			var data= $('#datafinal').attr('value');
			$('#docenteloader').load('cadastro/docentes/docentes.lista.data.php',{ data: data});
		});
		
		$('#bread_home').click(function(e) {
			e.preventDefault();
			//alert("breadhome");
			$('#afast_sistema').click();
    	});
		
		$('.CarregaDocentesCurso').click(function(e) {
			e.preventDefault();
			var id= $(this).attr('id');
			//alert(id);
			$('#docenteloader').load('cadastro/docentes/docentes.lista.curso.php',{ id: id});
		});
		
		$('#CarregaTodosDocentes').click(function(e) {
			e.preventDefault();
			$('#docenteloader').load('cadastro/docentes/docentes.lista.todos.php');
			
			
		});
		
		$('#CadastrarDocente').click(function(e) {
			e.preventDefault();
			$('#docenteloader').load('cadastro/docentes/docentes.cadastrar.php');
		});
		
		$('#GerenciarCursos').click(function(e) {
			e.preventDefault();
			$('#docenteloader').load('cadastro/docentes/docentes.curso.lista.php');
		});

		$('#GerenciarAfastamentos').click(function(e) {
			e.preventDefault();
			$('#docenteloader').load('cadastro/afastamento/afastamento.listar.php');
		});

		$('#InserirAfastamento').click(function(e) {
			e.preventDefault();
			$('#docenteloader').load('cadastro/afastamento/afastamento.cadastrar.embutido.php');
		});
		
		
		//Collapse Control

		  $('#Data-bar').on('show.bs.collapse', function (e) {
			  if ($(this).is(e.target)) 
			  {
				$('.sidebar-content').css({'width':'72%', 'margin-left':'18vw'});
				$('.sidebar-btn').css({'margin-left':'24vw'}); 
			  }   
		  });
		  
		  $('#Data-bar').on('hidden.bs.collapse', function (e) {
			  if ($(this).is(e.target)) 
			  {
				$('.sidebar-content').css({'width':'99%', 'margin-left':'-8vw'});
				$('.sidebar-btn').css({'margin-left':'-3vw'}); 
			  } 
		  });
	});
</script>

<?php
require_once "../../../engine/config.php";
?>

<section>
	<section class="col-md-3 sidebar-pad collapse in" id="Data-bar">
		<section class="col-md-12">
			<button class="btn btn-primary col-md-12" id="CarregaTodosDocentes"
				type="button"
				title="Exibe todos os docentes ativos e inativos já cadastrados no sistema.">
				Todos</button>
		</section>

		<section class="col-md-12">
			<button class="btn btn-primary col-md-12" type="button"
				data-toggle="collapse" data-target="#Cursos" aria-expanded="false"
				aria-controls="Cursos" id="Cursopadding">

				<span class="glyphicon glyphicon-filter"></span> Ativos por Curso
			</button>
			<br>
			<section class="collapse" id="Cursos">
            
            <?php
												$Item = new Curso ();
												$Item = $Item->ReadAll ();
												
												if (empty ( $Item )) {
													
													?>
                        <h4 class="well text-center">Nenhum dado
					encontrado.</h4>
            <?php
												} else {
													
													foreach ( $Item as $itemRow ) {
														// var_dump($itemRow);
														?>
                                    <button type="button"
					class="btn btn-default col-md-12 CarregaDocentesCurso"
					id=<?php echo $itemRow['id_curso']; ?>> 
                                            <?php echo $itemRow['nome_curso']; ?>
                                    </button>	 
                                <?php
													}
												}
												?>
            </section>
		</section>

		<section class="col-md-12">
			<button class="btn btn-primary col-md-12" type="button"
				data-toggle="collapse" data-target="#Data" aria-expanded="false"
				aria-controls="Data" id="Datapadding">

				<span class="glyphicon glyphicon-filter"></span> Ativos em uma Data
			</button>

			<br>

			<section class="collapse datepicker-center" id="Data">
                  <?php
																		
$Data = getdate ();
																		$Dia = $Data ['mday'];
																		$Mes = $Data ['mon'];
																		$Ano = $Data ['year'];
																		$Dataform = $Ano . '-' . $Mes . '-' . $Dia;
																		?>
                  <div id="datepicker"
					data-date=<?php echo $Dataform; ?>></div>
				<input type="hidden" id="datafinal">
			</section>

		</section>

		<section class="col-md-12">
			<button class="btn btn-success col-md-12" id="GerenciarCursos"
				type="button">Gerenciar Cursos</button>
		</section>

		<section class="col-md-12">
			<button class="btn btn-success col-md-12" id="CadastrarDocente"
				type="button">Cadastrar Novo Docente</button>
		</section>
		
		<section class="col-md-12">
			<button class="btn btn-warning col-md-12" id="GerenciarAfastamentos"
				type="button">Gerenciar Afastamentos</button>
		</section>
		
		<section class="col-md-12">
			<button class="btn btn-warning col-md-12" id="InserirAfastamento"
				type="button">Inserir Afastamentos</button>
		</section>
		
		<div id="sidebar-pad-scroll"></div>
	</section>
	<section class="col-md-1">
		<button class="btn btn-default sidebar-btn" type="button"
			data-toggle="collapse" data-target="#Data-bar" aria-expanded="false"
			aria-controls="Data-bar" id="Sidebarpadding"
			title="Clique para recolher ou expandir esta guia">
			<span class="glyphicon glyphicon-menu-right"></span>
		</button>
	</section>
	<!-- Paginas carregadas aqui -->
	<section class="col-md-8 sidebar-content" id="docenteloader">
		<br>
		<ol class="breadcrumb">
			<li><a href="#" id="bread_home">Home</a></li>
			<li><a href="#">Gerenciar Docentes</a></li>
			<li class="active">Menu</li>
		</ol>
		<div class="col-md-12">
			<h1>Gerenciar Docentes Cadastrados</h1>
            
            <section class="well"><h3>Selecione uma opção ao lado</h3></section>
		</div>
	</section>
	<!-- Paginas carregadas aqui -->
</section>

