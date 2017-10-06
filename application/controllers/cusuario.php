<?php

class Cusuario extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('musuario');
	}

	public function index()
	{
		$usuario=$this->musuario->selectAll();
		print_r($usuario);
	}

	public function insertar_usuario(){

		$usuario=array(
			'nombre_usuario'=>$this->input->post('txtNombreU'),
			'usuario'=>$this->input->post('txtUsuario'),
			'password'=>password_hash($this->input->post('txtPassword'),PASSWORD_DEFAULT),
			'fecha_creacion'=>date('Y-m-d')
		);

		$id=$this->musuario->create($usuario);
		
		echo $id;

	}

	public function editar_usuarios($id=''){
		$output=array();

		$usuario=array(
			'nombre_usuario'=>$this->input->post('txtNombreU'),
			'usuario'=>$this->input->post('txtUsuario'),
			'password'=>password_hash($this->input->post('txtPassword'),PASSWORD_DEFAULT)
		 );
         $isUpdate=$this->musuario->update($id,$usuario);
        if ($isUpdate) {
        	//array asociativo
        $output['status']=TRUE;	
        }else{
		$output['status']=FALSE;
        }
		echo json_encode($output);
	}

    //$admin enviado a la vista para extraer los datos de la tabla mantto_admins.
	public function view_editar_usuario($id=''){
		if (is_numeric($id)) {
		$data['usuarios']=$this->musuario->select($id);
		$this->load->view('editar_usuarios',$data);
		}else{
		show_404();
		}
		
	}

	public function eliminar_usuarios($id=''){
	if (is_numeric($id)) {
		$this->musuario->delete($id);
		}else{
	
		}

redirect('cusuario/lista_usuarios');

	}
	public function lista_usuarios(){
		$this->load->model('musuario');
		$data['usuarios']=$this->musuario->selectAll();
		$this->load->view('listar_usuarios',$data);
	}

	public function view_usuarios(){
	$this->load->model('musuario');
	$data['usuarios']=$this->musuario->selectAll();
	$this->load->view('view_usuarios',$data);
	}

	public function getUsuarios($id=''){
	 $output=array(
	 	'data'=>null
	 );
	 $usuario=$this->musuario->select($id);
	 if (is_object($usuario) && !empty($usuario)) {
	 	$output['msg']='usuario existen';
	 	$output['status']=true;
	 	$output['data']=$usuario;
	 }else{
	 	$output['msg']='usuario no existe';
	 	$output['status']=false;
	 }
	 echo json_encode($output);
	}


}