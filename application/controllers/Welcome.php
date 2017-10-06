<?php

class Welcome extends CI_Controller {

	public function index()
	{
		if ($this->session->valid) {
	$this->load->view('vprincipal');
		}else{
	$this->load->view('vlogin');	
		}
	}

	public function __construct(){
		parent::__construct();
		$this->load->model('mlogin');
		$this->load->library('encryption');
	}

	public function login_user(){
 
 	$Usuario=$this->input->post('txtUsuario');

 	$Password=$this->input->post('txtPassword');
 	
 	$Usu=$this->mlogin->login($Usuario);
 	$output=array();

 	if (is_object($Usu) && !empty($Usu)){
  //verificando el password cifrado con el password en claro.
   	if (password_verify($Password,$Usu->password)){
  	  //if(password_verify($Password,$usu->password)){
  	  $this->create_session($Usu);
      //$this->load->view('vprincipal');
       $output['status']=TRUE;
  	}else{
  	 $output['status']=FALSE;
  	 $output['msg']='Password Invalido';
  	} 
		}else{
    $output['status']=FALSE;
  	$output['msg']='Usuario No existe';
	}

	echo json_encode($output);

    }//Fin login_user

 	public function logout_user(){
 	$this->session->sess_destroy();
 	redirect();

 }//Fin logout_user

 	private function create_session($Usu){
    $this->session->valid=TRUE;
      
 }//Fin Create_Session


}
