<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ccliente extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mcliente');
	}

	public function index()
	{
		$cliente=$this->cliente->selectAll();
		print_r($cliente);
	}

	public function insertar_cliente(){

		$cliente=array(
			'nombre_cliente'=>$this->input->post('txtNombreC'),
			'empresa_cliente'=>$this->input->post('txtEmpresaC'),
			'tel_cliente'=>$this->input->post('txtTelefonoC'),
			'celular_cliente'=>$this->input->post('txtCelularC'),
			'correo_cliente'=>$this->input->post('txtCorreoC'),
			'fecha_registro'=>date('Y-m-d')
		);

		$id=$this->mcliente->create($cliente);
		
		echo $id;

	}

	public function editar_clientes($id=''){
		
		$output=array();

		$cliente=array(
			'nombre_cliente'=>$this->input->post('txtNombreC'),
			'empresa_cliente'=>$this->input->post('txtEmpresaC'),
			'tel_cliente'=>$this->input->post('txtTelefonoC'),
			'celular_cliente'=>$this->input->post('txtCelularC'),
			'correo_cliente'=>$this->input->post('txtCorreoC')
		 );
         $isUpdate=$this->mcliente->update($id,$cliente);
        if ($isUpdate) {
        	//array asociativo
        $output['status']=TRUE;	
        }else{
		$output['status']=FALSE;
        }
		echo json_encode($output);
	}

    //$admin enviado a la vista para extraer los datos de la tabla mantto_admins.
	public function view_editar_cliente($id=''){
		if (is_numeric($id)) {
		$data['clientes']=$this->mcliente->select($id);
		$this->load->view('editar_clientes',$data);
		}else{
		show_404();
		}
		

	}

	public function eliminar_clientes($id=''){
	if (is_numeric($id)) {
		$this->mcliente->delete($id);
		}else{
	
		}

	redirect('ccliente/lista_clientes');

	}
	public function lista_clientes(){
		$this->load->model('mcliente');
		$data['clientes']=$this->mcliente->selectAll();
		$this->load->view('listar_clientes',$data);
	}

	public function view_clientes(){
	$this->load->model('mcliente');
	$data['clientes']=$this->mcliente->selectAll();
	$this->load->view('view_clientes',$data);
	}

	public function getClientes($id=''){
	 $output=array(
	 	'data'=>null
	 );
	 $cliente=$this->mcliente->select($id);
	 if (is_object($cliente) && !empty($cliente)) {
	 	$output['msg']='Cliente existen';
	 	$output['status']=true;
	 	$output['data']=$cliente;
	 }else{
	 	$output['msg']='Cliente no existe';
	 	$output['status']=false;
	 }
	 echo json_encode($output);
	}


}//Fin Controller