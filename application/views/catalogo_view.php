<!DOCTYPE html>
<html>
    <head> 
    
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.min.css')?>" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css" />  
       

</head>
    <title>Catalogo de Artes</title>
    </head> 
<body>

<?php 
$this->load->view('template/header');
 ?>

 <div class="container">
        <center>
        <h2 >Listado Artesanias</h2>
    </center>
    
        <button class="btn btn-success" onclick="add_arte()"> <i class="glyphicon glyphicon-plus"></i> Agregar Catalogo</button>
        <button class="btn btn-primary" onclick="reload_table()"> <i class="glyphicon glyphicon-refresh"></i> Actualizar</button>
        
        <a style="float:right" href="<?php echo base_url(); ?>excel_export/action" id="btnrmv" type="button" class="btn btn-success" name="export" value="cancelar"><i class="glyphicon glyphicon-save"></i> Export</a></p>
        

        <br/>
        <br/>
        <table id="tbCatalogo" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
            <tr>
                <th>Codigo</th>
                <th>Nombre Arte</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
    



</div>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Nuevo Arte</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Codigo Arte:</label>
                            <div class="col-md-9">
                                <input name="codigo" placeholder="Codigo" class="form-control" type="text" required="" maxlength="5" data-parsley-required-message="codigo esta Vacio" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nombre Arte:</label>
                            <div class="col-md-9">
                                <input name="nombre" placeholder="nombre" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Descripcion:</label>
                            <div class="col-md-9">
                                <textarea name="descripcion" placeholder="descripcion" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Precio:</label>
                            <div class="col-md-9">
                                <input name="precio" placeholder="precio" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group" id="photo-preview">
                            <label class="control-label col-md-3">Imagen:</label>
                            <div class="col-md-9">
                                (No photo)
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" id="label-photo">Cargar Imagen</label>
                            <div class="col-md-9">
                                <input name="imagen" type="file">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->


<!--Librerias de Jquery-->

<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.min.js')?>"></script>

<script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>

<script type="text/javascript">
var save_method; //for save method string
var table;
var base_url = '<?php echo base_url();?>';

$(function(){

// $("#modal_form").modal();


table = $('#tbCatalogo').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('catalogo/ajax_list')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
            { 
                "targets": [ -1 ], //last column
                "orderable": false, //set not orderable
            },
            { 
                "targets": [ -2 ], //2 last column (photo)
                "orderable": false, //set not orderable
            },
        ],
    });

    

       //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });//Fin Input
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    }); //Fin Textarea
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });//Fin Select

});


function add_arte()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Agregar Arte'); // Set Title to Bootstrap modal title

    $('#photo-preview').hide(); // hide photo preview modal

    $('#label-photo').text('Cargar Imagen'); // label photo upload
}//Fin Funcion add

function edit_arte(id)
{
   if(confirm('Desea actualizar este registro?'))
    { 
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('catalogo/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id_catalogo);
            $('[name="codigo"]').val(data.codigo_arte);
            $('[name="nombre"]').val(data.nombre_arte);
            $('[name="descripcion"]').val(data.descripcion_arte);
            $('[name="precio"]').val(data.precio_arte);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Actualizar Arte'); // Set title to Bootstrap modal title

            $('#photo-preview').show(); // show photo preview modal

            if(data.imagen_arte)
            {
                $('#label-photo').text('Cambiar Imagen'); // label photo upload
                $('#photo-preview div').html('<img src="'+base_url+'upload/'+data.imagen_arte+'" class="img-responsive">'); // show photo
                $('#photo-preview div').append('<input type="checkbox" name="remove_photo" value="'+data.imagen_arte+'"/> Eliminar imagen actual'); // remove photo
            }
            else
            {
                $('#label-photo').text('Cargar Imagen'); // label photo upload
                $('#photo-preview div').text('(No hay foto)');
            }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error al extraer datos por ajax');
        }
    });

    }
}//Fin funcion edit

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function save()
{
    $('#btnSave').text('Guardando...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('catalogo/ajax_add')?>";
    } else {
        url = "<?php echo site_url('catalogo/ajax_update')?>";
    }

    // ajax adding data to database

    var formData = new FormData($('#form')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('Guardar'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error al Agregar / Actualizar datos');
            $('#btnSave').text('Guardar'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
        }
    });
}//Funcion Save

function delete_arte(id)
{
    if(confirm('Esta seguro que desea eliminarlo?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('catalogo/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error de eliminacion');
            }
        });

    }
}//Fin delete_arte

</script>

<?php 
$this->load->view('template/footer');
?>
</body>
</html>