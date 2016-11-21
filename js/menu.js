$(document).ready(function(e) {
	
	if ($('#loader').is(':empty')){
		$('#loader').load('../viewers/gerenciamento/sistema.buttons.php');
	}
	
	$('#gerenciar_admin').click(function(e) {
		e.preventDefault();
		//alert("admin");
		$('#printloader').empty();
		$('#loader').load('../viewers/gerenciamento/administrador/administrador.lista.php');
    });	
	
	$('#afast_sistema').click(function(e) {
		e.preventDefault();
    	//alert("home");
		$('#printloader').empty();
		$('#loader').load('../viewers/gerenciamento/sistema.buttons.php');
    });
	
	
	$('#getout').click(function(e) {
		e.preventDefault();
        //loader
		$.ajax({
		   url: '../engine/controllers/logout.php',
		   data: {
				
		   },
		   error: function() {
				alert('Erro na conexão com o servidor. Tente novamente em alguns segundos.');
		   },
		   success: function(data) {
				console.log(data);
				if(data === 'kickme'){
					document.location.href = '../';
				}
				
				
				else{
					alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');	
				}
		   },
		   
		   type: 'POST'
		});		
    });
	
});