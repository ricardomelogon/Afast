// JavaScript Document


$(document).ready(function(e) {
    $('#Logar').click(function(e) {
        var email = $('#email_login').val();
		var senha = $('#senha_login').val();
		
		if(email === "" || senha === ""){
			return alert('Todos os campos são obrigatórios!');
		}
		else{
			$.ajax({
			   url: 'engine/controllers/login.php',
			   data: {
					
					email : email,
					senha: senha
			   },
			   error: function() {
					alert('Erro na conexão com o servidor. Tente novamente em alguns segundos.');
			   },
			   success: function(data) {
					console.log(data);
					if(data === 'true'){
						document.location.href = 'viewers/sistema.php';
					}
					else if(data === 'no_user_found'){
						alert('Nenhum usuario encontrado com este email.');
					}
					
					else{
						alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');	
					}
			   },
			   
			   type: 'POST'
			});		
		}
    });
	
	$('#senha_login').keypress(function (e) {
 		var key = e.which;
 		if(key == 13){
    		$('#Logar').click();
    		return false;  
  		}
	});  
	
});