<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
 <?php 
 $this->load->view('template/css');
 ?>
	<title>Mantenimiento Usuarios</title>
</head>
<body>

<?php 
$this->load->view('template/header');
 ?>
<div>
<center><h2>Listado de Usuarios</h2></center>
<p>
<center>

<div id="NuevoUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Nuevo Usuario</h3>
            </div>
            <div class="modal-body form">
  <form id="frmUsuario" class="form-horizontal" action="" method="post">
    <div class="form-body">
      <div class="form-group">
    <label class="control-label col-md-3">Nombre Usuario:</label>
    <div class="col-md-9">
    <input class="form-control" type="text"  data-parsley-length="[8, 30]" name="txtNombreU" required="" data-parsley-required-message="Nombre esta Vacio" placeholder="Nombre Usuario">
    </div>
      </div>
    <div class="form-group">
    <label class="control-label col-md-3">Usuario: </label>
    <div class="col-md-9">
      <input class="form-control" type="text" name="txtUsuario"  data-parsley-length="[5, 12]"required="" data-parsley-required-message="Usuario esta Vacio" placeholder="Usuario">
        </div>
      </div>
    <div class="form-group">
    <label class="control-label col-md-3">Password:</label>
    <div class="col-md-9">
    <input id="txtPassword" class="form-control" type="password"  data-parsley-length="[6, 10]" name="txtPassword" required="" data-parsley-required-message="Password esta Vacio" placeholder="Password">
    </div>
      </div>
    <div class="form-group">
    <label class="control-label col-md-3">Verificar Password: </label> 
    <div class="col-md-9">
    <input id="txtPasswordV" class="form-control" type="password"  data-parsley-length="[6, 10]" name="txtPasswordV" required="" data-parsley-required-message="Password esta Vacio" placeholder="Verificar Password" data-parsley-equalto="#txtPassword"></p>
      </div>
    </div>

    <div class="modal-footer">
    <button id="btnadd" type="submit" class="btn btn-primary" name="guardar" value="guardar">Guardar</button>
    
    <a href="<?php echo base_url('cusuario/lista_usuarios')?>" id="btnrmv" type="button" class="btn btn-default" name="cancelar" value="cancelar">Cancelar</a>
    </div>
  </form>
</div>
    </div><!-- /.container -->
    </div><!-- /.modal-body -->
 </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal-fade-->

<div class="container">
 <button class="btn btn-success" data-toggle="modal" data-target="#NuevoUsuario"> <i class="glyphicon glyphicon-plus"></i> Agregar Usuario</button></p>

		<table id="lstUsuarios" class="display responsive no-wrap table table-bordered" width="100%" >
			<thead>
				<tr>
					<th>Usuario</th>
					<!--<th>Password</th>-->
					<th>Nombre</th>
          <th>Fecha Creacion</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php
				//valor del array asociativo del controller de listar_admins 'admins'
       if (isset ($usuarios)) {
       	foreach ($usuarios as $usuario) {
       		       	?>
       	<tr>
       		<td>
       			<?php
       			echo $usuario->usuario; 
       			 ?>
       		</td>
       		<!-- <td>
       			<?php 
       			echo $admin->pass_admin;
       			 ?>
       		</td> -->
       		<td>
       			<?php 
       			echo $usuario->nombre_usuario;
       			 ?>
       		</td>
       		    <td>
                        <?php 
                        echo $usuario->fecha_creacion;
                         ?>
                  </td>
          	<td>
          <!--Boton Editar-->
            <button class="btn btnedt btn-sm btn-warning glyphicon glyphicon-pencil" data-id="<?php echo $usuario->id_usuario  ?>" data-nombre=""></button>
             <!--Boton Eeliminar-->
       			<a href="<?php
       			echo base_url('cusuario/eliminar_usuarios/'.$usuario->id_usuario); ?>" class="btn btn-sm btn-danger glyphicon glyphicon-trash"></a>
       		</td>
       	</tr>
       	<?php
       	}
       }
    	 ?>
			</tbody> 
      <tfoot>
        <tr>
          <th>Usuario</th>
          <!--<th>Password</th>-->
          <th>Nombre</th>
          <th>Fecha Creacion</th>
          <th>Acciones</th> 
      </tr>
      </tfoot>   
		</table>
	</div>

<div id="EdtUsuario" class="modal fade" role="dialog">
 <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Editar Usuario</h3>
            </div>
            <div class="modal-body form">
  <form id="frmUsuarioE" class="form-horizontal" action="#" method="post">
    <div class="form-body"> 
<div class="form-group">
    <label class="control-label col-md-3">Nombre Usuario:</label> 
<div class="col-md-9">
  <input id="txtNombreU" class="form-control" type="text" name="txtNombreU" minlength="10" maxlength="20" value="<?php echo $usuario->nombre_usuario;?>" required="" data-parsley-required-message="Nombre Esta Vacio"/>
  </div>
      </div>
    <div class="form-group">
    <label class="control-label col-md-3">Usuario:</label>
    <div class="col-md-9">
    <input id="txtUsuario"  class="form-control" type="text" name="txtUsuario" data-parsley-length="[5, 12]" value="<?php echo $usuario->usuario;?>" required="" data-parsley-required-message="Usuario Esta Vacio" readonly />
    </div>
      </div>
    <div class="form-group">
    <label class="control-label col-md-3">Password: </label>
    <div class="col-md-9">
    <input id="txtPasswordU"  class="form-control" type="password" name="txtPassword" data-parsley-length="[6, 12]" value="<?php echo $usuario->password;?>" required="" data-parsley-required-message="Password Esta Vacio" />
    </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3">Verificar Password:</label>
      <div class="col-md-9">
       <input id="txtPasswordV" class="form-control" type="password"  data-parsley-length="[6, 10]" name="txtPasswordV" required="" data-parsley-required-message="Password esta Vacio" placeholder="Verificar Password" data-parsley-equalto="#txtPasswordU">
       </div>
    </div>

    <!--Guardar dentro del modal-->
    <div class="modal-footer">
    <button id="btnedt" class="btn btn-primary" type="submit" name="guardar" value="guardar">Guardar</button>
    
    <a href="<?php echo base_url('cusuario/lista_usuarios')?>" id="btnrmv" type="button" class="btn btn-default" name="cancelar" value="cancelar">Cancelar</a>
  </form>
  </div>      
      </div>
          </div><!-- /.container -->
              </div><!-- /.modal-body -->
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
</div><!-- /.modal-fade-->

<!-- Liberias Jquery-->
 <?php
 $this->load->view('template/jquery');
 ?>
 <!--Jquery DataTable-->
<script type="text/javascript">
  $(document).ready(function() {
    $('#lstUsuarios').DataTable();
    responsive: true;
});
  </script>
<!--Jquery Guardar Claves-->
  <script type="text/javascript">
  $(function(){
    var frmUsuario=$('#frmUsuario');
    var btnadd=$('#btnadd');
   btnadd.click(function(e){
    e.preventDefault();
if(frmUsuario.parsley().validate()){
      jQuery.ajax({
        url: '<?php echo base_url('cusuario/insertar_usuario'); ?>',
        type: 'POST',
        dataType: 'json',
        data: frmUsuario.serialize(),
        complete: function(xhr, textStatus) {
      location=('<?php echo base_url('cusuario/lista_usuarios') ?>');
        },
        success: function(data, textStatus, xhr) {
         
          alert(data.msg='Usuario ha sido Creado'); 
        },
        error: function(xhr, textStatus, errorThrown) {
        alert('Usuario ya existe'); 
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
<!-- Jquery Editar Admins-->
<script type="text/javascript">
  $(function(){
    var frmUsuarioE=$('#frmUsuarioE');
    var btnadd=$('#btnedt');
    var btnedt=$('.btnedt');
    var modalEdit=$('#EdtUsuario');
    btnadd.click(function(){
    // variable para buscar id especifico. 
      //var id = $(this).data('id');

     if(frmUsuarioE.parsley().validate()){
      var id = parseInt($(this).data('id'));  
      jQuery.ajax({
        url: '<?php echo base_url('cusuario/editar_usuarios'); ?>/'+id,
        type: 'POST',
        dataType: 'json',
        data: frmUsuarioE.serialize(),
        complete: function(xhr, textStatus) {
          location= ('<?php echo base_url('cusuario/lista_usuarios'); ?>');
        },
        success: function(data, textStatus, xhr) {
          alert("Usuario ha sido Actualizado");
        },
        error: function(xhr, textStatus, errorThrown) {
          alert("Usuario NO ha sido Actualizado");
        }
      });
      

     } else{
      console.log("No Jala");
     }
     return false;
      

    });

btnedt.click(function(e){
  e.preventDefault();
  var id=$(this).data('id');
  btnadd.attr('data-id', id);
  jQuery.ajax({
        url: '<?php echo base_url('cusuario/getUsuarios'); ?>/'+id,
        type: 'POST',
        dataType: 'json',
        data: frmUsuarioE.serialize(),
        complete: function(xhr, textStatus) {
          //location= ('<?php echo base_url('cusuario/lista_usuarios'); ?>');
        },
        success: function(response, textStatus, xhr) {
          if(response.status){
            //location= ('<?php echo base_url('cusuario/lista_usuarios'); ?>');
              setInto(response.data);
              modalEdit.modal();
          } else{
            alert(response.msg);
          }
        },
        error: function(xhr, textStatus, errorThrown) {
        }
      });
  return false;
});

var txtUsuario=$('#txtUsuario');
var txtPassword=$('#txtPassword');
var txtNombreU=$('#txtNombreU');


function setInto(data){
txtUsuario.val(data.usuario);
txtPassword.val(data.password);
txtNombreU.val(data.nombre_usuario);
}
  });
</script>


<?php 
$this->load->view('template/footer');
?>
</body>
</html>