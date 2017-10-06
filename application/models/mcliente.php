<?php 

class Mcliente extends MY_Model{

public function __construct(){

parent:: __construct();

$this->id='id_cliente';
$this->table='arte_clientes';

}

}//Fin Modelo