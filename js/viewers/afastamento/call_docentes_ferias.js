$('.escolhe_data').focus(function() {
		$(this).daterangepicker
		({
		showDropdowns: true,
		"timePicker": true,
		"drops": "down",
		"linkedCalendars": false,
		autoUpdateInput: false,
		locale: {
			"format": "DD/MM/YYYY",
			"separator": " - ",
			"applyLabel": "Aplicar",
			"cancelLabel": "Cancelar",
			"fromLabel": "De",
			"toLabel": "Até",
			"customRangeLabel": "Outro",
			"weekLabel": "S",
			"daysOfWeek": ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
			"monthNames": ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro" ],
			"firstDay": 1
				},
		alwaysShowCalendars: true
		  },
		function(start, end, label) 
		{
	  //console.log($('#escolhe_data').data());

		}).on('apply.daterangepicker', function(ev, picker) {
		  var travelpicker = $(this).attr('id').split("-"); //get intervalo and ferias ID
		  var intervalo = travelpicker[1];
		  var ferias = travelpicker[2];
		  $('#showdata-'+intervalo+'-'+ferias).val(picker.startDate.format('DD/MM/YYYY') + " - " + picker.endDate.format('DD/MM/YYYY')); //show date to user
		  var datainicio = $('#dt_inicio_afastamento-'+intervalo+'-'+ferias).val(picker.startDate.format('YYYY-MM-DD')); //add new start date to hidden input
		  var datafim = $('#dt_fim_afastamento-'+intervalo+'-'+ferias).val(picker.endDate.format('YYYY-MM-DD')); //add new end date to hidden input
		  var from = datainicio.val().split("-"); //aux variable
		  var a = new Date(from[0], from[1] - 1, from[2]); //get fixed start date A
		  var from = datafim.val().split("-");//aux variable
		  var b = new Date(from[0], from[1] - 1, from[2]); //get fiex end date B
		  var msday = 1000 * 60 * 60 * 24;// get numer of milliseconds in a day
		  var utc1 = Date.UTC(a.getFullYear(), a.getMonth(), a.getDate()); //Get the UTC standard date of start date
		  var utc2 = Date.UTC(b.getFullYear(), b.getMonth(), b.getDate()); //Get the UTC standard date of end date
		  var dias = (Math.floor((utc2-utc1)/msday))+1;
		  $('#btnvalor'+'-'+intervalo+'-'+ferias).val(dias); //Add difference of days to hidden input
		  $('#showrangetotal-'+intervalo+'-'+ferias).text(dias); //show difference of days to user
		  var btn1val = parseInt($('#btnvalor-1-'+ferias).val()); //Get current difference value of range 1
		  var btn2val = parseInt($('#btnvalor-2-'+ferias).val()); //Get current difference value of range 2
		  var btn3val = parseInt($('#btnvalor-3-'+ferias).val()); //Get current difference value of range 3
		  var total = $('#valorferiastotal-'+ferias).val(btn1val+btn2val+btn3val); //Add current differences of all ranges
		  $('#btntotal-'+ferias).text(total.val()); //Show current difference of all ranges to user
		});
});

$('.clearinterval').click(function(e) {
	e.preventDefault();
	var ferias = $(this).attr('id').split('-');
	var intervalo = ferias[1];
	ferias = ferias[2];	
	var id_afastamento = $('#id_afastamento-'+intervalo+'-'+ferias).val();
	if(id_afastamento != ""){
		if(confirm("Deseja apagar as férias salvas neste intervalo?\nEssa ação é permanente.")){
			(function(ferias, intervalo, id_afastamento){	
				$.ajax({
					url: '../engine/controllers/ferias.php',
					data: {
						id_ferias : null,
						ano_ferias : null,				  
						id_afastamento  : id_afastamento,
						dt_inicio_afastamento : null,
						dt_fim_afastamento : null,
						observ_afastamento : null,
						id_ocorrencia : null,
						id_docente : null,
						action: 'delete'
					},
					error: function() {
						alert('Erro na conexão com o servidor. Tente novamente em alguns segundos.');
					},
					success: function(data) {
						(function(ferias, intervalo, id_afastamento){	
							$.ajax({
								url: '../engine/controllers/afastamento.php',
								data: {
									id_afastamento  : id_afastamento,
									dt_inicio_afastamento : null,
									dt_fim_afastamento : null,
									observ_afastamento : null,
									id_ocorrencia : null,
									id_docente : null,
									action: 'delete'
								},
								error: function() {
									alert('Erro na conexão com o servidor. Tente novamente em alguns segundos.');
								},
								success: function(data) {
									if(data === 'true'){
										$('#showdata-'+intervalo+'-'+ferias).val("");
										$('#dt_inicio_afastamento-'+intervalo+'-'+ferias).val("");
										$('#dt_fim_afastamento-'+intervalo+'-'+ferias).val("");
										$('#btnvalor'+'-'+intervalo+'-'+ferias).val(0);
										$('#showrangetotal-'+intervalo+'-'+ferias).text(0);
										var btn1val = parseInt($('#btnvalor-1-'+ferias).val());
										var btn2val = parseInt($('#btnvalor-2-'+ferias).val());
										var btn3val = parseInt($('#btnvalor-3-'+ferias).val());
										var total = $('#valorferiastotal-'+ferias).val(btn1val+btn2val+btn3val);
										$('#btntotal-'+ferias).text(total.val());
										$('#id_afastamento-'+intervalo+'-'+ferias).val("");
									}
									else{
										alert('Houve um problema.');	
									}
								},
								type: 'POST'
							}); //Ajax 2
						})(ferias, intervalo, id_afastamento);
					},
					type: 'POST'
				});	//Ajax 1
			})(ferias, intervalo, id_afastamento);	
		}
	}
	else{
		$('#showdata-'+intervalo+'-'+ferias).val("");
		$('#dt_inicio_afastamento-'+intervalo+'-'+ferias).val("");
		$('#dt_fim_afastamento-'+intervalo+'-'+ferias).val("");
		$('#btnvalor'+'-'+intervalo+'-'+ferias).val(0);
		$('#showrangetotal-'+intervalo+'-'+ferias).text(0);
		var btn1val = parseInt($('#btnvalor-1-'+ferias).val());
		var btn2val = parseInt($('#btnvalor-2-'+ferias).val());
		var btn3val = parseInt($('#btnvalor-3-'+ferias).val());
		var total = $('#valorferiastotal-'+ferias).val(btn1val+btn2val+btn3val);
		$('#btntotal-'+ferias).text(total.val());
		$('#id_afastamento-'+intervalo+'-'+ferias).val("");	
	}
});