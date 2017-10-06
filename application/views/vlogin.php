<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah" rel="stylesheet">
<?php 
 $this->load->view('template/login');
 ?>
    <meta charset="utf-8">
    <title>Fernando Llort</title>
</head>
<body>
<div class="main-login main-center">
<center>
	<form id="loginForm" class="form-signin form-horizontal" method="POST" action="" data-parsley-validate="">
		<h2 class="textlogin">Arbol de Dios</h2><h5>v1.0</h5>

 <div class="form-group">
 <label class="col-xs-3 control-label"></label>

		<div class="col-xs-7">
		<input id="txtUsuario" class="form-control" type="text" name="txtUsuario" placeholder="Usuario" pattern="[A-Za-z]{4,}" data-parsley-length="[5, 12]" required="" data-parsley-required-message="Usuario vacio"/>
		</div>
    </div>

    <div class="form-group">
		<label class="col-xs-3 control-label"></label>
		<div class="col-xs-7">
		<input id="txtPassword" class="form-control" type="password" name="txtPassword" placeholder="Contraseña" minlength="5" maxlength="10" required="" data-parsley-required-message="Contraseña Vacia"/><br>
		</div>
    </div>

<div class="form-group">
        <div class="col-xs-9 col-xs-offset-2">
		<button id="btnlogin" class="btn btn-primary btn-block" type="submit" >Entrar</button>
		  </div>
    </div>
	</form>

	<?php
 	$this->load->view('template/jquery');
	?>

<script>
$(document).ready(function() {
	var btnlogin = $("#btnlogin");
	var formLogin = $("#loginForm");

	btnlogin.click(function(e){
		e.preventDefault();

   if(formLogin.parsley().validate()){
      jQuery.ajax({
        url: '<?php echo base_url('Welcome/login_user'); ?>',
        type: 'POST',
        dataType: 'json',
        data: formLogin.serialize(),
        complete: function(xhr, textStatus) {
            
        },
        success: function(data, textStatus, xhr) {
         if (data.status) {
         	window.location=('<?php echo base_url();?>');
         }else{
         alert(data.msg);

         }
         
        },
        error: function(xhr, textStatus, errorThrown) {
          
        }
      });
			console.log("aca esta validando");
		} else{
			console.log("no funciona");
		}
		return false;
	});
});
</script>


<script type="text/javascript">
$(function () {
  $('#loginForm').parsley().on('field:validated', function() {
    var ok = $('.parsley-error').length === 0;
    $('.bs-callout-info').toggleClass('hidden', !ok);
    $('.bs-callout-warning').toggleClass('hidden', ok);
  })
  .on('form:submit', function() {
    return false; // Don't submit form for this demo
  });
});
</script>

</center>
</div>
</body>
</html>





























