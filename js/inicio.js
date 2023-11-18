
function iniciar(){

 	var usuario = $('#txtUsuario').val();
	var pwd = 	$('#txtClave').val();
    
	if(usuario===undefined || usuario==''){
        toastr.error('INGRESAR USUARIO');
        $('#txtUsuario').focus();
        return false;
    }

    if(pwd===undefined || pwd==''){
        toastr.error('INGRESAR CONTRASEÑA');
        $('#txtClave').focus();
        return false;
    }

    indexDAO.checkUser();
}

function changePassword(){

  var clave = $.trim($('#txtNuevaClave').val());
  var confirmarClave = $.trim($('#txtConfirmarClave').val());
    
  if(clave===undefined || clave==''){
      $('#txtNuevaClave').focus();
      toastr.warning('Por favor ingrese contraseña');
      return false;
  }

  if(confirmarClave===undefined || confirmarClave==''){
      $('#txtConfirmarClave').focus();
      toastr.warning('Por favor ingrese confirmación de contraseña');
      return false;
  }

  if(confirmarClave!==clave){
      $('#txtConfirmarClave').focus();
      $('#txtConfirmarClave').val('');
      toastr.error('Contraseñas no coinciden');
      return false;
  }

  indexDAO.changePassword();

}

function verFichaRegistro(){
  $('.loginUsuario').css('display', 'none');
  $('.registrarUsuario').css('display', 'block');
}

function verLoginRegistro(){
  $('.loginUsuario').css('display', 'block');
  $('.registrarUsuario').css('display', 'none');
}