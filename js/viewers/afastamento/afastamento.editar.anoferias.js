$(document).ready(function(e) {
	$(".Salvarferias").click(function(){
		var workId = $(this).attr('id').split('-');
		workId = workId[1];
		var ano_ferias = $('#DataAno-'+workId).val();
		var id_afastamento = $('#idAfastamento-'+workId).val();
		//alert(workId);
		//alert(ano_ferias);
		//alert(id_afastamento);
		(function(ano_ferias, id_afastamento, workId){  
			$.ajax({
				url: '../engine/controllers/ferias.php',
				data: {
					id_ferias : null,
					ano_ferias : ano_ferias,
					id_afastamento : id_afastamento,
					dt_inicio_afastamento : null,
					dt_fim_afastamento : null,
					observ_afastamento : null,
					id_ocorrencia : null,
					id_docente : null,
					action: 'createsingle'
				},
				error: function() {
					alert('Erro na conexão com o servidor. Tente novamente em alguns segundos.');
				},
				success: function(data) {
					console.log(data);
					if(data === 'true'){
						alert('Ano adicionado com sucesso.');
						$('#linhaDocente-'+workId).hide();
					}
					else{
						$('#linhaDocente-'+workId).css( "background-color", "lightcoral" );
					}
				}, //Sucesso Ajax2
				type: 'POST'
			}); //Ajax2
		})(ano_ferias, id_afastamento, workId); //Ajax2 Função
	});
});	



















