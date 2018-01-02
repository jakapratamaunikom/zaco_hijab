$(document).ready(function(){
	$("#username").change(function(){
		$('.field-username').removeClass('has-error');
		$('.field-username').find('.help-block').text('');
	});

	$("#password").change(function(){
		$('.field-password').removeClass('has-error');
		$('.field-password').find('.help-block').text('');
	});

	$("#form_login").submit(function(e){
		e.preventDefault();
		login();

		return false;
	});
});

function login(){
	$.ajax({
		url: base_url+"app/controllers/Login.php",
		type: "post",
		dataType: "json",
		data:{
			"username": $("#username").val().trim(),
			"password": $("#password").val().trim(),
			"action": $("#btn_login").val().trim(),
		},
		success: function(hasil){
			console.log(hasil);
			if(hasil.status) document.location=base_url;
			else{
				// set error
				set_error(hasil.pesanError);
				// set value
				set_value(hasil.set_value);
			}
		},
		error: function (jqXHR, textStatus, errorThrown) { // error handling
            swal("Pesan Error", "Operasi Gagal, Silahkan Coba Lagi", "error");
            console.log(jqXHR, textStatus, errorThrown);
        }
	})
}

function set_value(data){
	$("#username").val(data.username);
	$("#password").val(data.password);
}

function set_error(data){
	if(!jQuery.isEmptyObject(data.username)){
		$('.field-username').addClass('has-error');
		$('.field-username').find('.help-block').text(data.username);
	}
	else{
		$('.field-username').removeClass('has-error');
		$('.field-username').find('.help-block').text('');
	}

	if(!jQuery.isEmptyObject(data.password)){
		$('.field-password').addClass('has-error');
		$('.field-password').find('.help-block').text(data.password);
	}
	else{
		$('.field-password').removeClass('has-error');
		$('.field-password').find('.help-block').text('');
	}
}