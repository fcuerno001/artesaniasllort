<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
    
 <?php 
 $this->load->view('template/css');
 ?>
	<title>Listado Clientes</title>
  
</head>
<body>

<?php 
$this->load->view('template/header');
 ?>
<div>
<center><h2>Listado de Clientes</h2></center>
<p>
<center>


<div class="modal fade" id="NuevoCliente" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Nuevo Cliente</h3>
            </div>
            <div class="modal-body form">
        <form id="frmCliente" class="form-horizontal" action="#" method="post">
    <div class="form-body"> 
<div class="form-group">
<label class="control-label col-md-3">Nombre Cliente:</label> 
<div class="col-md-9">
  <input class="form-control" type="text" data-parsley-length="[6, 30]" name="txtNombreC" required="" data-parsley-required-message="Nombre esta Vacio" placeholder="Nombre Cliente">
      </div>
      </div>
    <div class="form-group">
    <label class="control-label col-md-3">Empresa Cliente: </label>
    <div class="col-md-9">
    <input class="form-control" type="text" name="txtEmpresaC"  data-parsley-length="[3, 40]"required="" data-parsley-required-message="Empresa esta Vacio" placeholder="Empresa" value="Independiente">
    </div>
      </div>
    <div class="form-group">
    <label class="control-label col-md-3">Telefono Fijo:</label> 
    <div class="col-md-9">
    <input class="form-control" type="tel" data-mask="0000-0000" name="txtTelefonoC"  data-parsley-length="[6, 9]" required="" data-parsley-required-message="Telefono esta Vacio" placeholder="0000-0000">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3">Celular:</label>
      <div class="col-md-9">
      <input class="form-control" type="tel" data-mask="0000-0000" name="txtCelularC"  data-parsley-length="[6, 9]" required="" data-parsley-required-message="Celular esta Vacio" placeholder="0000-0000">   
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3">Correo:</label>
      <div class="col-md-9">
      <input class="form-control" type="email" name="txtCorreoC"  required="" data-parsley-required-message="Correo esta Vacio" data-parsley-type="email" placeholder="ejemplo@ejemplo.com">   
      </div>
    </div>
  
  <div class="modal-footer">
    <!--Nuevo usuario-->
    <button id="btnadd" type="submit" class="btn btn-primary" name="guardar" value="guardar">Guardar</button>
    
    <a href="<?php echo base_url('ccliente/lista_clientes')?>" id="btnrmv" type="button" class="btn btn-danger" name="cancelar" value="cancelar">Cancelar</a></p>
    </div>
  </form>
  </div>
    </div><!-- /.container -->
    </div><!-- /.modal-body -->
 </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal-fade-->

<div class="container">
 <button class="btn btn-success" data-toggle="modal" data-target="#NuevoCliente"><i class="glyphicon glyphicon-plus"></i> Agregar Cliente</button></p>

		<table id="lstClientes" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Cliente</th>
					<th>Empresa</th>
					<th>Telefono</th>
          <th>Celular</th>
          <th>Correo</th>
          <th>Registro</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php
				//valor del array asociativo del controller de listar_admins 'admins'
       if (isset ($clientes)) {
       	foreach ($clientes as $cliente) {
       		       	?>
       	<tr>
       		<td>
       			<?php
       			echo $cliente->nombre_cliente; 
       			 ?>
       		</td>
       		<td>
       			<?php 
       			echo $cliente->empresa_cliente;
       			 ?>
       		</td>
       		<td>
       			<?php 
       			echo $cliente->tel_cliente;
       			 ?>
       		</td>
       		 <td>
            <?php 
            echo $cliente->celular_cliente;
            ?>
          </td>
          <td>
            <?php 
            echo $cliente->correo_cliente;
            ?>
          </td>
          <td>
            <?php 
            echo $cliente->fecha_registro;
            ?>
          </td>

          	<td>
          <!--Boton Editar-->
            <button class="btn btnedt btn-sm btn-warning glyphicon glyphicon-pencil" data-id="<?php echo $cliente->id_cliente ?>" data-nombre=""></button>
             <!--Boton Eeliminar-->
       			<a href="<?php
       			echo base_url('ccliente/eliminar_clientes/'.$cliente->id_cliente); ?>" class="btn btn-sm btn-danger glyphicon glyphicon-trash"></a>
       		</td>
       	</tr>
       	<?php
       	}
       }
    	 ?>
			</tbody>  
      <tfoot>
        <tr>
          <th>Cliente</th>
          <th>Empresa</th>
          <th>Telefono</th>
          <th>Celular</th>
          <th>Correo</th>
          <th>Registro</th>
          <th>Acciones</th>
        </tr>
      </tfoot>    
		</table>
</div>

<div class="modal fade" id="EdtCliente" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Editar Cliente</h3>
            </div>
            <div class="modal-body form">
        <form id="frmClienteE" class="form-horizontal" action="#" method="post">
    <div class="form-body"> 
<div class="form-group">
<label class="control-label col-md-3">Nombre Cliente:</label> 
<div class="col-md-9">
  <input class="form-control" id="txtNombreC" type="text" data-parsley-length="[6, 30]" name="txtNombreC" required="" data-parsley-required-message="Nombre esta Vacio" placeholder="Nombre Cliente">
      </div>
      </div>
    <div class="form-group">
    <label class="control-label col-md-3">Empresa Cliente: </label>
    <div class="col-md-9">
    <input class="form-control" id="txtEmpresaC" type="text" name="txtEmpresaC"  data-parsley-length="[3, 40]"required="" data-parsley-required-message="Empresa esta Vacio" placeholder="Empresa">
    </div>
      </div>
    <div class="form-group">
    <label class="control-label col-md-3">Telefono Fijo:</label> 
    <div class="col-md-9">
    <input class="form-control" id="txtTelefonoC" type="tel" name="txtTelefonoC"  data-parsley-length="[6, 9]" required="" data-parsley-required-message="Telefono esta Vacio" placeholder="0000-0000">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3">Celular:</label>
      <div class="col-md-9">
      <input class="form-control" id="txtCelularC" type="tel" name="txtCelularC"  data-parsley-length="[6, 9]" required="" data-parsley-required-message="Celular esta Vacio" placeholder="0000-0000">   
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3">Correo:</label>
      <div class="col-md-9">
      <input class="form-control" id="txtCorreoC" type="email" name="txtCorreoC"  required="" data-parsley-required-message="Correo esta Vacio" data-parsley-type="email" placeholder="ejemplo@ejemplo.com">   
      </div>
    </div>
    <!--Guardar dentro del modal-->
    <div class="modal-footer">
    <button id="btnedt" class="btn btn-primary" type="submit" name="guardar" value="guardar">Guardar</button>
    
    <a href="<?php echo base_url('ccliente/lista_clientes')?>" id="btnrmv" type="button" class="btn btn-danger" name="cancelar" value="cancelar">Cancelar</a>
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
    $('#lstClientes').DataTable();
    responsive: true;
});
  </script>
  
<!--Jquery Guardar Clientes-->
  <script type="text/javascript">
  $(function(){
    var frmCliente=$('#frmCliente');
    var btnadd=$('#btnadd');
   btnadd.click(function(e){
    e.preventDefault();
if(frmCliente.parsley().validate()){
      jQuery.ajax({
        url: '<?php echo base_url('ccliente/insertar_cliente'); ?>',
        type: 'POST',
        dataType: 'json',
        data: frmCliente.serialize(),
        complete: function(xhr, textStatus) {
      location=('<?php echo base_url('ccliente/lista_clientes') ?>');
        },
        success: function(data, textStatus, xhr) {
         
          alert(data.msg='Cliente ha sido Creado'); 
        },
        error: function(xhr, textStatus, errorThrown) {
        alert('Cliente ya existe'); 
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
    var frmClienteE=$('#frmClienteE');
    var btnadd=$('#btnedt');
    var btnedt=$('.btnedt');
    var modalEdit=$('#EdtCliente');
    btnadd.click(function(){
    // variable para buscar id especifico. 
      //var id = $(this).data('id');

     if(frmClienteE.parsley().validate()){
      var id = parseInt($(this).data('id'));  
      jQuery.ajax({
        url: '<?php echo base_url('ccliente/editar_clientes'); ?>/'+id,
        type: 'POST',
        dataType: 'json',
        data: frmClienteE.serialize(),
        complete: function(xhr, textStatus) {
          location= ('<?php echo base_url('ccliente/lista_clientes'); ?>');
        },
        success: function(data, textStatus, xhr) {
          alert("Cliente ha sido Actualizado");
        },
        error: function(xhr, textStatus, errorThrown) {
          alert("Cliente NO ha sido Actualizado");
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
        url: '<?php echo base_url('ccliente/getClientes'); ?>/'+id,
        type: 'POST',
        dataType: 'json',
        data: frmClienteE.serialize(),
        complete: function(xhr, textStatus) {
          //location= ('<?php echo base_url('ccliente/lista_clientes'); ?>');
        },
        success: function(response, textStatus, xhr) {
          if(response.status){
            //location= ('<?php echo base_url('ccliente/lista_clientes'); ?>');
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

var txtNombre=$('#txtNombreC');
var txtEmpresa=$('#txtEmpresaC');
var txtTelefono=$('#txtTelefonoC');
var txtCelular=$('#txtCelularC');
var txtCorreo=$('#txtCorreoC');


function setInto(data){
txtNombre.val(data.nombre_cliente);
txtEmpresa.val(data.empresa_cliente);
txtTelefono.val(data.tel_cliente);
txtCelular.val(data.celular_cliente);
txtCorreo.val(data.correo_cliente);
}
  });
</script>

<?php 
$this->load->view('template/footer');
?>
</body>
</html>