
<script>
	$(document).ready(function(e) {
        
    });

	$('#Atualizar').click(function(e) {
		e.preventDefault();
		//loader
		$('#loader').load('gerenciamento/administrador/administrador.lista.php');
		});
		
	$('#Adicionar').click(function(e) {
		e.preventDefault();
		//loader
		$('#loader').load('gerenciamento/administrador/administrador.adicionar.php');
	});	

	$('.EditarItem').click(function(e) {
		e.preventDefault();
		//loader
		
		var id = $(this).attr('id');
		//alert(id);
		$('#loader').load('gerenciamento/administrador/administrador.editar.php', { id: id});
	});
		
	$('.ExcluirItem').click(function(e) {
		e.preventDefault();
		//loader
		
		var id = $(this).attr('id');
		//alert(id);
		if(confirm("Tem certeza que deseja excluir este dado?")){
			$.ajax({
			   url: '../engine/controllers/administrador.php',
			   data: {
					login_administrador : null,
					nome_administrador : null,
					senha_administrador : null,
					id_administrador : id,
					action: 'delete'
			   },
			   error: function() {
					alert('Erro na conexão com o servidor. Tente novamente em alguns segundos.');
			   },
			   success: function(data) {
					console.log(data);
					if(data === 'true'){
						alert('Item deletado com sucesso!');
						$('#loader').load('gerenciamento/administrador/administrador.lista.php');
					}
					else{
						alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');	
					}
			   },
			   
			   type: 'POST'
			});	
		}
		
	});
</script>

<?php
require_once "../../../engine/config.php";
?>

<br>
<ol class="breadcrumb">
	<li><a href="../viewers/sistema.php">Home</a></li>
	<li><a href="#">Administradores</a></li>
	<li class="active">Lista de Dados</li>
</ol>


<h1>Lista de Administradores Cadastrados</h1>
<br>
<div class="btn-group" role="group" aria-label="...">
	<button type="button" class="btn btn-primary" id="Atualizar">
		<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
		Atualizar
	</button>
	<button type="button" class="btn btn-success" id="Adicionar">
		<span class="glyphicon glyphicon-plus"  aria-hidden="true"></span>
		Adicionar Administrador
	</button>

</div>

<br>
<br>

<?php
$Item = new Administrador ();
$Item = $Item->ReadAll ();

if (empty ( $Item )) {
	?>
<h4 class="well">Nenhum dado encontrado.</h4>
<?php
} else {
	?>

<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Login</th>
			<th>Nome Completo</th>
			<th class="text-center">Editar</th>
			<th class="text-center">Excluir</th>
		</tr>
	</thead>
	<tbody>
	  <?php
	foreach ( $Item as $itemRow ) {
		?>
        		
      	<tr>
			<td><?php echo $itemRow['login_administrador']; ?></td>
			<td><?php echo $itemRow ['nome_administrador'];	?></td>
			<td class="text-center EditarItem"
				id="<?php echo $itemRow['id_administrador']; ?>"><span
				class="glyphicon glyphicon-edit" aria-hidden="true"></span></td>
			<td class="text-center ExcluirItem"
				id="<?php echo $itemRow['id_administrador']; ?>"><span
				class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
		</tr>
    	<?php
	}
	?> 	
      </tbody>
</table>
<?php
}
?>
  
  