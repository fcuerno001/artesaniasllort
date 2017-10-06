<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/main.css'); ?>">

<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header navbar-inverse">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="<?php echo base_url(); ?>" class="navbar-brand">Fernando Llort</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
          <li><a href="<?php echo base_url('ccliente/lista_clientes'); ?>">Clientes</a>
          <li><a href="<?php echo base_url('cusuario/lista_usuarios'); ?>">Usuario</a>
          <li><a href="<?php echo base_url('catalogo'); ?>">Catalogo Artesanias</a>
          <li><a class="glyphicon glyphicon-off" href="<?php echo base_url('welcome/logout_user'); ?>"> Salir
          </a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
